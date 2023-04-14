<?php

namespace App\Http\Controllers\User\Payment\Pay;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use PG\Pay\Entity;
use Exception;

class PayController extends Controller
{
    public function purchase($id)
    {
        $order = UserOrder::find($id);

        if (empty($order)) {
            throw new Exception('Could not find order');
        }

        $backUrl = url('user/payment/pay/complete', $order->id);

        $entity = Entity::instance()
            ->setId($order->id)
            ->setAmount($order->amount)
            ->setBack($backUrl);

        $pay = new \PG\Pay\Purchase\Request( $entity );

        $response = $pay->response();

        if (empty($response)) {
            throw new Exception('Something is wrong');
        }

        $fine = $response->fine();

        if (empty($fine)) {
            throw new Exception('Something is wrong');
        }

        $track = $response->track();

        if (empty($track)) {
            throw new Exception('Something is wrong');
        }

        $data = ['reference' => $track];

        $order->fill($data);
        $order->save();

        $link = $response->link();

        return redirect($link);
    }

    public function complete($id)
    {
        $order = UserOrder::find($id);

        if (empty($order)) {
            throw new Exception('Could not find order');
        }

        $entity = Entity::instance()
            ->setId($order->id)
            ->setAmount($order->amount)
            ->setTrack($order->reference);

        $pay = new \PG\Pay\Complete\Request( $entity );

        $response = $pay->response();

        if (empty($response)) {
            throw new Exception('Something is wrong');
        }

        $fine = $response->fine();

        if (empty($fine)) {
            throw new Exception('Something is wrong');
        }

        $data = ['status' => 'completed'];

        $order->fill($data);
        $order->save();

        $params = ['order' => $order];

        return view('pay.complete', $params);
    }
}

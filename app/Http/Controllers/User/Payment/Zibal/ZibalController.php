<?php

namespace App\Http\Controllers\User\Payment\Zibal;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use PG\Zibal\Entity;
use Exception;

class ZibalController extends Controller
{
    public function purchase($id)
    {
        $order = UserOrder::find($id);

        if (empty($order)) {
            throw new Exception('Could not find order');
        }

        $backUrl = url('user/payment/zibal/complete', $order->id);

        $entity = Entity::instance()
            ->setAmount($order->amount)
            ->setBack($backUrl);

        $zibal = new \PG\Zibal\Purchase\Request( $entity );

        $response = $zibal->response();

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

        $params = ['order' => $order];

        return view('zibal.purchase', $params);
    }

    public function complete($id)
    {
        $order = UserOrder::find($id);

        if (empty($order)) {
            throw new Exception('Could not find order');
        }

        $entity = Entity::instance()
            ->setAmount($order->amount)
            ->setTrack($order->reference);

        $zibal = new \PG\Zibal\Complete\Request( $entity );

        $response = $zibal->response();

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

        return view('zibal.complete', $params);
    }
}

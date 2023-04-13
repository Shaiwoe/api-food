<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\User\Order\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends ApiController
{
    public function index()
    {
        $orders = request()->user()->orders()->get();

        $data = [
            'orders' => OrderResource::collection($orders)
        ];

        return $this->successResponse($data);
    }

    public function create(Request $request)
    {
        $user = request()->user();

        $rules = [
            'total' => 'required|integer',
            'amount' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        $fails = $validator->fails();

        if ($fails) {
            return $this->errorResponse( $validator->messages(), 422 );
        }

        $data = ['total' => $request->total, 'amount' => $request->amount, 'status' => 'pending'];

        $order = $user->orders()
            ->create($data);

        return OrderResource::make($order);
    }
}

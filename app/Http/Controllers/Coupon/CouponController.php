<?php

namespace App\Http\Controllers\Coupon;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Coupon\CouponResource;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(5);

        return $this->successResponse([
            'coupons' => CouponResource::collection($coupons),
            'links' => CouponResource::collection($coupons)->response()->getData()->links,
            'meta' => CouponResource::collection($coupons)->response()->getData()->meta,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:coupons,code',
            'percentage' => 'required|integer',
            'expired_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        DB::beginTransaction();

        $coupon = Coupon::create([
            'code' => $request->code,
            'percentage' => $request->percentage,
            'expired_at' => $request->expired_at
        ]);

        DB::commit();

        return $this->successResponse(new CouponResource($coupon), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return $this->successResponse(new CouponResource($coupon));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'percentage' => 'required|integer',
            'expired_at' => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        DB::beginTransaction();

        $coupon->update([
            'code' => $request->code,
            'percentage' => $request->percentage,
            'expired_at' => $request->expired_at !== null ? $request->expired_at : $coupon->expired_at
        ]);

        DB::commit();

        return $this->successResponse(new CouponResource($coupon), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        DB::beginTransaction();
        $coupon->delete();
        DB::commit();

        return $this->successResponse(new CouponResource($coupon), 200);
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        $coupon = Coupon::where('code', $request->code)->where('expired_at', '>', Carbon::now())->first();

        if ($coupon == null) {
            return $this->errorResponse(['error' => ['کد تخفیف وارد شده وجود ندارد']], 422);
        }
        if (Order::where('user_id', Auth()->id())->where('coupon_id', $coupon->id)->where('payment_status', 1)->exists()) {
            return $this->errorResponse(['error' => ['شما قبلا از این کد تخفیف استفاده کرده اید']], 422);
        }
        return $this->successResponse([
            'percentage' => $coupon->percentage
        ], 200);
    }
}

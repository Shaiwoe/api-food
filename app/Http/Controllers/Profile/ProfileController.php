<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Http\Controllers\ApiController;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;

class ProfileController extends ApiController
{
    public function info()
    {
        $user = User::find(Auth()->id());
        return $this->successResponse(new UserResource($user), 200);
    }

    public function editInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        DB::beginTransaction();

        Auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        DB::commit();

        return $this->successResponse(new UserResource(Auth()->user()), 200);
    }


}

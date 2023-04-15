<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\User\Profile\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class ProfileController extends ApiController
{
    public function show()
    {
        $user = request()->user(); // Current logged in user

        return UserResource::make($user);
    }

    public function create(Request $request)
    {
        $user = request()->user(); // Current logged in user

        // Validate request
        $rules = [
            'name' => 'required|string',
            'national' => 'required|string',
            'cellphone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'shop_name' => 'required|string',
            'shop_type' => 'required|string',
            'shop_phone' => 'required|string',
            'shop_city' => 'required|string',
            'shop_address' => 'required|string',
            'bank_sheba' => 'required|string',
            'bank_name' => 'required|string',
            'documents' => 'required|max:8192'
        ];

        $validator = Validator::make($request->all(), $rules);

        $fails = $validator->fails();

        if ($fails) {
            return $this->errorResponse( $validator->messages(), 422 );
        }

        // Upload file
        $path = $request->file('documents')->store('documents');

        // Create profile
        $data = ['name' => $request->name, 'national' => $request->national, 'cellphone' => $request->cellphone, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'shop_name' => $request->shop_name, 'shop_type' => $request->shop_type, 'shop_phone' => $request->shop_phone, 'shop_city' => $request->shop_city, 'shop_address' => $request->shop_address, 'bank_sheba' => $request->bank_sheba, 'bank_name' => $request->bank_name, 'zip_url' => $path, 'status' => 'pending'];

        $profile = $user->profiles()
            ->create($data);

        return UserResource::make($user);
    }
}

<?php

namespace App\Http\Controllers\User\Member;

use App\Http\Controllers\User\Member\Resources\MemberResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class MemberController extends ApiController
{
    public function index()
    {
        $members = request()->user()->members()->get();

        $data = [
            'members' => MemberResource::collection($members)
        ];

        return $this->successResponse($data);
    }

    public function create(Request $request)
    {
        $user = request()->user();

        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
            'type' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        $fails = $validator->fails();

        if ($fails) {
            return $this->errorResponse( $validator->messages(), 422 );
        }

        $data = ['username' => $request->username, 'password' => $request->password, 'type' => $request->type];

        $member = $user->members()
            ->create($data);

        return MemberResource::make($member);
    }
}

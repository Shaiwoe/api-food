<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryAdvertising;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Category\CategoryAdvertisingResource;

class CategoryAdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryAdvertising::orderBy('created_at', 'desc')->paginate(5);

        return $this->successResponse([
            'categories' => CategoryAdvertisingResource::collection($categories),
            'links' => CategoryAdvertisingResource::collection($categories)->response()->getData()->links,
            'meta' => CategoryAdvertisingResource::collection($categories)->response()->getData()->meta,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        DB::beginTransaction();

        $categoryAdvertising= CategoryAdvertising::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        DB::commit();

        return $this->successResponse(new CategoryAdvertisingResource($categoryAdvertising), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryAdvertising $categoryAdvertising)
    {
        return $this->successResponse(new CategoryAdvertisingResource($categoryAdvertising));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryAdvertising $categoryAdvertising)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        DB::beginTransaction();

        $categoryAdvertising->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        DB::commit();

        return $this->successResponse(new CategoryAdvertisingResource($categoryAdvertising), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryAdvertising $categoryAdvertising)
    {
        DB::beginTransaction();
        $categoryAdvertising->delete();
        DB::commit();

        return $this->successResponse(new CategoryAdvertisingResource($categoryAdvertising), 200);
    }
}

<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Models\CategoryArticle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Category\CategoryArticleResource;

class CategoryArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryArticle::orderBy('created_at', 'desc')->paginate(5);

        return $this->successResponse([
            'categories' => CategoryArticleResource::collection($categories),
            'links' => CategoryArticleResource::collection($categories)->response()->getData()->links,
            'meta' => CategoryArticleResource::collection($categories)->response()->getData()->meta,
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

        $categoryArticle = CategoryArticle::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        DB::commit();

        return $this->successResponse(new CategoryArticleResource($categoryArticle), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryArticle $categoryArticle)
    {
        return $this->successResponse(new CategoryArticleResource($categoryArticle));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryArticle $categoryArticle)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        DB::beginTransaction();

        $categoryArticle->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        DB::commit();

        return $this->successResponse(new CategoryArticleResource($categoryArticle), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryArticle $categoryArticle)
    {
        DB::beginTransaction();
        $categoryArticle->delete();
        DB::commit();

        return $this->successResponse(new CategoryArticleResource($categoryArticle), 200);
    }
}

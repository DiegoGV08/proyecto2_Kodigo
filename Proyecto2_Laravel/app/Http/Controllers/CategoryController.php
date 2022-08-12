<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::paginate(5);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'category_name' => 'required|string',
                'category_description' => 'required|string'
            ]
        );

        if ($request->id) {
            $category = Category::find($request->id);
        } else {
            $category = new Category();
        }

        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;

        $category->save();
        return response()->json(
            [
                'message' => 'category saved correctly',
                'data' => $category
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::find($id);
        if ($category) {
            return response()->json($category);
        }
        return response()->json(['message' => 'category not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::find($id);
        if ($category) {

            $validator = Validator::make($request->all(), [
                'category_name' => 'required|string',
                'category_description' => 'required|string'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'malformed request syntax'], 400);
            } else {
                $category->category_name = $request->category_name;
                $category->category_description = $request->category_description;

                $category->save();
                return response()->json(['message' => 'category edited correctly', 'data' => $category]);
            }
        } else {
            return response()->json(['message' => 'category not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'category delete correctly']);
        }
        return response()->json(['message' => 'category not found'], 404);
    }
}

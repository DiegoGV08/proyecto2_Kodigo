<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::paginate(5);
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

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_description' => 'required|string',
            'product_price' => 'required|numeric',
            'product_state' => 'required|numeric',
            'id_category' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'malformed request syntax'], 400);
        }

        $product = new product();

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->product_state = $request->product_state;
        $product->id_category = $request->id_category;

        $product->save();
        return response()->json(
            [
                'message' => 'product saved correctly',
                'data' => $product
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
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        }
        return response()->json(['message' => 'product not found'], 404);
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
        $product = Product::find($id);
        if ($product) {

            $validator = Validator::make($request->all(), [
                'product_name' => 'required|string',
                'product_description' => 'required|string',
                'product_price' => 'required|numeric',
                'product_state' => 'required|numeric',
                'id_category' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'malformed request syntax'], 400);
            } else {
                $product->product_name = $request->product_name;
                $product->product_description = $request->product_description;
                $product->product_price = $request->product_price;
                $product->product_state = $request->product_state;
                $product->id_category = $request->id_category;

                $product->save();
                return response()->json(['message' => 'product edited correctly', 'data' => $product]);
            }
        } else {
            return response()->json(['message' => 'product not found'], 404);
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
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'product delete correctly']);
        }
        return response()->json(['message' => 'product not found'], 404);
    }
}

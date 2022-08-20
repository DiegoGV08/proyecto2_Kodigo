<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Rules\ValidateOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Order::paginate(5);
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
        $validator = Validator::make(
            $request->all(),
            ['id_client' => 'required|numeric', 'order_state' => 'required|numeric', 'detail' => ['required', new ValidateOrderDetail()]]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $order = new Order();

        $order->id_client = $request->id_client;
        $order->order_state = $request->order_state;

        $order->save();

        foreach ($request->detail as $totalDetail) {
            OrderDetail::updateOrCreate(['id_order' => $order->id, 'id_product' => $totalDetail['id_product']], ['id_order' => $order->id, 'id_product' => $totalDetail['id_product'], 'product_quantity' => $totalDetail['product_quantity']]);
        }
        return response()->json(['message' => 'order saved correctly', 'data' => $order]);
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
        $order = Order::find($id);
        if ($order) {
            return response()->json($order);
        }
        return response()->json(['message' => 'order not found'], 404);
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
        // dd($request->all());



        $validator = Validator::make(
            $request->all(),
            ['id_client' => 'required|numeric', 'order_state' => 'required|numeric', 'detail' => [new ValidateOrderDetail()]]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        // $order = Order::find($request->id);

        $order = Order::find($id);

        if ($order) {
            $order->id_client = $request->id_client;
            $order->order_state = $request->order_state;

            $order->save();

            $detail_id = [];

            if($request->detail){
                foreach ($request->detail as $totalDetail) {
                    // dd(['id_order' => $order->id, 'id_product' => $totalDetail['id_product'], 'product_quantity' => $totalDetail['product_quantity']]);
                    $orderDetail = OrderDetail::updateOrCreate(
                        ['id_order' => $order->id, 'id_product' => $totalDetail['id_product']],
                        ['id_order' => $order->id, 'id_product' => $totalDetail['id_product'], 'product_quantity' => $totalDetail['product_quantity']]
                    );
                    $detail_id[] = $orderDetail->id;
                }
                OrderDetail::where('id_order', '=', $order->id)->whereNotIn('id', $detail_id)->delete();
            }

            return response()->json(['message' => 'order edited correctly', 'data' => $order]);
        }
        else {
            return response()->json(['message'=>'order not found'], 404);
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
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json(['message' => 'order deleted correctly']);
        }
        return response()->json(['message' => 'order not found'], 404);
    }
}

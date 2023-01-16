<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // SHOW ALL ORDERS DATA
    public function index()
    {
        $order = Order::with('user', 'product')->paginate(10);
        return response()->json([
            'order' => $order,
        ], 200);
    }

    // SHOW SPECIFIC ORDER ID DATA
    public function show($id)
    {
        $order = Order::with('user', 'product')->findOrFail($id);
        if ($order) {
            $order->get();
            return response()->json([
                'order' => $order,
            ], 200);
        }
    }

    // SHOW ORDERS ON THE BASE OF USER ID
    public function userOrder($id)
    {
        $order = User::findorFail($id)->order;
        return response()->json([
            'order' => $order,
        ]);
    }

    // ADD ORDER
    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        Order::create($data);
        return response()->json([
            'message' => 'Order created successfully',
        ], 200);
    }

    // UPDATE ORDER 
    public function update(OrderRequest $request, $id)
    {
        $data = $request->validated();
        $order = Order::find($id);
        if ($order) {
            $order->update($data);
            return response()->json([
                'message' => 'order Updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Given Id order not found',
            ], 404);
        }
    }

    // DELETE ORDER
    public function destroy($id)
    {
        $order = Order::findorFail($id);
        $order->delete();
        return response()->json([
            'message' => 'order Deleted',
        ], 200);
    }
}

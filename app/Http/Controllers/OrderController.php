<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrderSummary(Request $request)
    {
        return view('orderSummary');
    }

    public function placeOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            // Create address record
            $address = Address::create([
                'name' => $request->address,
                'phone' => '01301727106',
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);

            // Create order record
            $order = Order::create([
                'customer_id' => Auth::id(),
                'order_type' => 'delivery',
                'status' => 'pending',
                'instructions' => $request->instructions,
                'total_amount' => $request->total,
                'address_id' => $address->id,
                // 'payment_method_id' => $request->paymentMethod,
                
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);

            // Create order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Order placed successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error placing order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showOrderConfirmation($orderId)
    {
        $order = Order::with(['orderItems.item', 'address'])
            ->findOrFail($orderId);

        return view('orderconfirmation', compact('order'));
    }
} 
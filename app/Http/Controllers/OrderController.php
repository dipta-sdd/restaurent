<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\User;
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

    public function adminOrders(Request $request)
    {
        try {
            $query = Order::with(['orderItems.item', 'address', 'customer'])
                ->orderBy('created_at', 'desc');

            // Apply status filter
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Apply date range filter
            if ($request->filled('dateRange')) {
                switch($request->dateRange) {
                    case 'today':
                        $query->whereBetween('created_at', [
                            now()->startOfDay(),
                            now()->endOfDay()
                        ]);
                        break;
                    case 'yesterday':
                        $query->whereDate('created_at', now()->subDay());
                        break;
                    case 'week':
                        $query->whereBetween('created_at', [
                            now()->startOfWeek(),
                            now()->endOfWeek()
                        ]);
                        break;
                    case 'month':
                        $query->whereBetween('created_at', [
                            now()->startOfMonth(),
                            now()->endOfMonth()
                        ]);
                        break;
                }
            }

            // Apply order type filter
            if ($request->filled('type')) {
                $query->where('order_type', $request->type);
            }

            // Apply search filter (by order ID or customer name)
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('id', 'like', "%{$searchTerm}%")
                      ->orWhereHas('customer', function($q) use ($searchTerm) {
                          $q->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$searchTerm}%");
                      });
                });
            }

            // Get orders with customer information
            $orders = $query->get();

            // Group orders by date
            $orders_by_date = $orders->groupBy(function($order) {
                return $order->created_at->format('Y-m-d');
            })->map(function($orders) {
                return $orders->sortByDesc('created_at');
            });

            return view('admin.orders', compact('orders_by_date'));

        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching orders: ' . $e->getMessage());
        }
    }

    public function adminOrderDetails($orderId)
    {
        $order = Order::with(['orderItems.item', 'address', 'paymentMethod'])
            ->findOrFail($orderId);

        // Get customer details from User model
        $customer = User::find($order->customer_id);
        $order->customerName = $customer->name; 
        // dd($customer->name);
        

        return view('admin.order_details', compact('order'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,ready,delivered'
        ]);

        $order = Order::findOrFail($orderId);
        $user = auth()->user();

        // Check permissions based on role and current status
        if ($user->is_rider() && in_array($order->status, ['ready', 'processing']) && in_array($request->status, ['delivered', 'ready'])) {
            $order->status = $request->status;
            
        }
        elseif($user->is_admin() && $order->status === 'pending' && $request->status === 'processing') {
            $order->status = $request->status;
        }
         else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to update order status'
            ], 403);
        }

        $order->updated_by = $user->id;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'new_status' => $order->status
        ]);
    }

    public function previousOrders()
    {
        $user_id = Auth::id();
        
        // Get delivered orders (history)
        $delivered_orders = Order::with(['orderItems.item', 'address'])
            ->where('customer_id', $user_id)
            ->where('status', 'delivered')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get active orders (not delivered)
        $active_orders = Order::with(['orderItems.item', 'address'])
            ->where('customer_id', $user_id)
            ->whereNotIn('status', ['delivered'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('previousorder', compact('delivered_orders', 'active_orders'));
    }
} 

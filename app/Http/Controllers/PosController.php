<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Table;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    //
    public function pos()
    {
        $foods = Item::selectRaw('DISTINCT subcategory_id')->where('status', 'available')->where('type', 'food')->get();
        $foods = $foods->map(function ($category) {
            return Item::selectRaw('items.id, items.name, IF(variants.id , variants.price, items.price) as price, items.image, items.type, variants.name as variant_name, variants.id as variant_id, categories.name as category_name, categories.id as category_id , IF(items.status = "available", "Active", "Inactive") as status')
                ->leftJoin('subcategories as categories', 'items.subcategory_id', '=', 'categories.id')
                ->leftJoin('variants', 'items.id', '=', 'variants.item_id')
                ->where('items.subcategory_id', $category->subcategory_id)
                ->get();
        });
        $drinks = Item::selectRaw('DISTINCT subcategory_id')->where('status', 'available')->where('type', 'drink')->get();
        $drinks = $drinks->map(function ($category) {
            return Item::selectRaw('items.id, items.name, IF(variants.id , variants.price, items.price) as price, items.image, items.type, variants.name as variant_name, variants.id as variant_id, categories.name as category_name, categories.id as category_id , IF(items.status = "available", "Active", "Inactive") as status')
                ->leftJoin('subcategories as categories', 'items.subcategory_id', '=', 'categories.id')
                ->leftJoin('variants', 'items.id', '=', 'variants.item_id')
                ->where('items.subcategory_id', $category->subcategory_id)
                ->get();
        });
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        return view('admin.pos', ['foods' => $foods, 'drinks' => $drinks, 'paymentMethods' => $paymentMethods]);
    }

    public function processOrder(Request $request)
    {

        $cart = $request->cart;
        $orderType = $request->orderType;

        $tableNo = $request->tableNo;
        $totalAmount = $request->totalAmount;
        $paymentMethodId = $request->paymentMethodId;
        $reservationId = $request->reservationId;
        // dd($cart, $orderType, $tableNo, $totalAmount);
        if ($orderType == null) {
            return response()->json(['message' => 'Order type is required']);
        }
        $order = Order::create([
            'order_type' => $orderType,
            'table_no' => $tableNo,
            'status' => 'processing',
            'total_amount' => $totalAmount,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'payment_method_id' => $paymentMethodId,
            'reservation_id' => $reservationId,
        ]);

        foreach ($cart as $item) {
            // dd($item);
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'variant_id' => $item['variant_id'] ?? null,
                'quantity' => $item['quantity'],
                'price' => Variant::find($item['variant_id'])->price ?? Item::find($item['id'])->price,
            ]);
        }
        return response()->json(['message' => 'Order processed successfully', 'order' => $order]);
    }

    public function getTables()
    {
        $tables = DB::table(DB::raw('(SELECT DISTINCT t.id ,t.status, t.capacity , r.start , r.end , r.id as r_id, r.reservation_date FROM `tables` as t LEFT JOIN reservations as r ON ( t.id = r.table_id AND ( r.reservation_date > CURRENT_DATE OR ( r.reservation_date = CURRENT_DATE AND r.start > CURRENT_TIME ) ) ) ORDER BY id ASC, reservation_date ASC , start ASC ) as tt'))->select('*')->get();
        return response()->json($tables);
    }
}

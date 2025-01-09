<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Subcategory;

class MenuController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        $items = Item::with('subcategory')->get()->map(function ($item) {
            return $this->addDiscountedPrice($item);
        });

        return view('menu', compact('subcategories', 'items'));
    }

    public function getItems(Request $request)
    {
        $query = Item::with('subcategory');

        // Filter by subcategories if provided
        if ($request->has('subcategories') && !empty($request->subcategories)) {
            $query->whereIn('subcategory_id', $request->subcategories);
        }

        // Search by name if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort by price if specified
        if ($request->has('sort')) {
            $direction = $request->sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $direction);
        } else {
            $query->orderBy('created_at', 'desc'); // Default sorting
        }

        $items = $query->get()->map(function ($item) {
            return $this->addDiscountedPrice($item);
        });

        return response()->json($items);
    }

    private function addDiscountedPrice($item)
    {
        $item->discounted_price = $item->price; // Current price is the price from database
        $item->original_price = round($item->price * 1.02, 2); // Previous price is 2% higher
        return $item;
    }
}

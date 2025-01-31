<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
        return view('admin.pos', ['foods' => $foods, 'drinks' => $drinks]);
    }
    public function pos2()
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
        return view('admin.pos2', ['foods' => $foods, 'drinks' => $drinks]);
    }
}

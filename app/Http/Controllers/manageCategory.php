<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class manageCategory extends Controller
{
    //
    public function adminCategory()
    {
        $categories = Category::all();
        $subcategories = Subcategory::selectRaw('subcategories.*')->orderBy('category_id')->get();
        return view('admin.categories', ['categories' => $categories, 'subcategories' => $subcategories]);
    }
}

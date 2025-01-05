<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;

class manageCategory extends Controller
{
    //
    public function adminCategory()
    {
        $categories = Category::all();
        $subcategories = Subcategory::selectRaw('subcategories.*, categories.name as type, CONCAT(users.first_name, " ", users.last_name) as created_by, CONCAT(updated_by.first_name, " ", updated_by.last_name) as updated_by')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->leftJoin('users', 'subcategories.created_by', '=', 'users.id')
            ->leftJoin('users as updated_by', 'subcategories.updated_by', '=', 'updated_by.id')
            ->orderBy('category_id')->get();
        return view('admin.categories', ['categories' => $categories, 'subcategories' => $subcategories]);
    }
    public function addSubcategory(Request $request)
    {
        // dd(json_encode($request->all()));
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',

        ]);
        $subcategory = Subcategory::create($data);
        $subcategory->created_by = auth()->user()->id;
        $subcategory->updated_by = auth()->user()->id;
        $subcategory->save();
        $subcategory->created_by = auth()->user()->name;
        $subcategory->updated_by = auth()->user()->name;

        return response()->json($subcategory, 201);
    }
    public function editSubcategory(Request $request, $id)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'nullable|string',
        ]);
        $subcategory = Subcategory::where('id', $id)->first();
        $subcategory->update($data);
        $subcategory->updated_by = auth()->user()->id;
        $subcategory->save();
        $subcategory->updated_by = auth()->user()->name;
        return response()->json($subcategory, 201);
    }
    public function deleteSubcategory($id)
    {
        try {
            $subcategory = Subcategory::where('id', $id)->first();
            $subcategory->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}

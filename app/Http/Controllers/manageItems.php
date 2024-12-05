<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Subcategory;
use App\Models\Variant;
use App\Models\User;
// use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;


class manageItems extends Controller
{
    public function adminItems()
    {
        $subcategories = Subcategory::all();
        $items = Item::selectRaw('items.*, subcategories.name as subcategory_name, users.name as created_by, updated_by.name as updated_by')
            ->join('subcategories', 'items.subcategory_id', '=', 'subcategories.id')
            ->leftJoin('users', 'items.created_by', '=', 'users.id')
            ->leftJoin('users as updated_by', 'items.updated_by', '=', 'updated_by.id')
            ->orderBy('subcategory_id')
            ->get();
        
        return view('admin.items', [
            'subcategories' => $subcategories, 
            'items' => $items
        ]);
    }

    public function addItem(Request $request)
    {
        $data = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'allergens' => 'nullable|string',
            'dietary_options' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'nullable|string'
        ]);
        // dd($request->dietary_options);

        // Handle base64 image upload
        if (isset($data['image']) && !empty($data['image'])) {
            // Decode the base64 string
            $image = $data['image'];
            
            // Extract the image extension from the base64 string
            preg_match('/data:image\/(.*?);base64/', $image, $matches);
            $extension = $matches[1] ?? 'png'; // Default to 'png' if no extension found

            $image = str_replace("data:image/{$extension};base64,", '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $data['name'] . '_' . now()->format('YmdHis') . '.' . $extension; // Use the extracted extension
            \Storage::disk('public')->put('images/items/' . $imageName, base64_decode($image));
            $data['image'] = '/storage/images/items/' . $imageName; // Store the path in the database
        } else {
            // Handle case where image is not cropped but uploaded
            if ($request->hasFile('item_image')) {
                $file = $request->file('item_image');
                $imageName = $data['name'] . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/items', $imageName, 'public');
                $data['image'] = '/storage/images/items/' . $imageName; // Store the path in the database
            }
        }

        // Create the item
        $item = Item::create($data);
        $item->created_by = auth()->user()->id;
        $item->updated_by = auth()->user()->id;
        $item->save();

        // Fetch additional details for response
        $item->created_by = auth()->user()->name;
        $item->updated_by = auth()->user()->name;
        $item->subcategory_name = $item->subcategory->name;

        return response()->json($item, 201);
    }

    public function editItem(Request $request, $id)
    {
        $data = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'allergens' => 'nullable|string',
            'dietary_options' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        if (isset($data['image']) && !empty($data['image'])) {
            // Decode the base64 string
            $image = $data['image'];
            
            // Extract the image extension from the base64 string
            preg_match('/data:image\/(.*?);base64/', $image, $matches);
            $extension = $matches[1] ?? 'png'; // Default to 'png' if no extension found

            $image = str_replace("data:image/{$extension};base64,", '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $data['name'] . '_' . now()->format('YmdHis') . '.' . $extension; // Use the extracted extension
            \Storage::disk('public')->put('images/items/' . $imageName, base64_decode($image));
            $data['image'] = '/storage/images/items/' . $imageName; // Store the path in the database
        }

        $item = Item::findOrFail($id);

        // Handle image upload if provided


        $item->update($data);
        $item->updated_by = auth()->user()->id;
        $item->save();

        // Fetch additional details for response
        $item->updated_by = auth()->user()->name;
        $item->subcategory_name = $item->subcategory->name;

        return response()->json($item, 200);
    }

    public function deleteItem($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function showItem($id)
    {
        $item = Item::with(['subcategory', 'variants'])->findOrFail($id);
        \Log::info("Item Image Path: " . $item->image);
        foreach ($item->variants as $variant) {
            $variant->created_by_name = User::find($variant->created_by)->name ?? 'N/A';
            $variant->updated_by_name = User::find($variant->updated_by)->name ?? 'N/A';
        }
        // Log the image path
        return view('admin.item_detail', compact('item'));
    }


    public function addVariant(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|in:available,outofstok'
        ]);

        // Ensure the item exists
        $item = Item::find($data['item_id']);
        

      
        try {
            $variant = Variant::create($data);
            // dd($variant);
            
            $variant->created_by = auth()->user()->id;
            $variant->updated_by = auth()->user()->id;
            // $item->created_by = auth()->user()->name;
            // $item->updated_by = auth()->user()->name;
            // dd($variant->updated_by);
            $variant->save();

            $variant->created_by = auth()->user()->name;
            $variant->updated_by = auth()->user()->name;

            // Return the created variant with additional details
            return response()->json([
                'id' => $variant->id,
                'item_id' => $variant->item_id,
                'name' => $variant->name,
                'price' => $variant->price,
                'status' => $variant->status,
                'created_by' => $variant->created_by,
                'updated_by' => $variant->updated_by,
                'created_at' => $variant->created_at,
                'updated_at' => $variant->updated_at
            ], 201);
        } catch (\Exception $e) {
            // Log the exception message
            \Log::error('Error adding variant: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function editVariant(Request $request, $id)
    {
        // Validate the incoming request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|in:available,outofstok'
        ]);

        // Find the variant
        $variant = Variant::findOrFail($id);

        // Update the variant
        $variant->fill($data);
        $variant->updated_by = auth()->user()->id;
        // $item->created_by = auth()->user()->name;
        // $item->updated_by = auth()->user()->name;
        $variant->save();

        
        $variant->updated_by = auth()->user()->name;

        // Return the updated variant with additional details
        return response()->json([
            'id' => $variant->id,
            'item_id' => $variant->item_id,
            'name' => $variant->name,
            'price' => $variant->price,
            'status' => $variant->status,
            'created_by' => $variant->created_by,
            'updated_by' => $variant->updated_by,
            'created_at' => $variant->created_at,
            'updated_at' => $variant->updated_at
        ], 200);
    }

    public function deleteVariant($id)
    {
        try {
            // Find and delete the variant
            $variant = Variant::findOrFail($id);
            $variant->delete();

            return response()->json(null, 204);
        } catch (Exception $e) {
            // Handle any errors
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function filterItems(Request $request)
    {
        $subcategoryId = $request->input('subcategory_id');

        $query = Item::selectRaw('items.*, subcategories.name as subcategory_name')
            ->join('subcategories', 'items.subcategory_id', '=', 'subcategories.id');

        if ($subcategoryId) {
            $query->where('items.subcategory_id', $subcategoryId);
        }

        $items = $query->get();

        return response()->json(['items' => $items], 200);
    }
}
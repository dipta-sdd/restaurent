<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;

class manageTables extends Controller
{
    public function adminTables()
    {
        $tables = Table::selectRaw('tables.*, creator.name as creator_name, updater.name as updater_name')
            ->leftJoin('users as creator', 'tables.created_by', '=', 'creator.id')
            ->leftJoin('users as updater', 'tables.updated_by', '=', 'updater.id')
            ->orderBy('tables.created_at', 'desc')
            ->get();

        $statusOptions = Table::getStatusOptions();
        return view('admin.tables', compact('tables', 'statusOptions'));
    }

    public function addTable(Request $request)
    {
        $data = $request->validate([
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:' . implode(',', array_keys(Table::getStatusOptions()))
        ]);

        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        $table = Table::create($data);

        // Get creator and updater names for response
        $creator = User::find($table->created_by);
        $updater = User::find($table->updated_by);

        $table->creator_name = $creator->name;
        $table->updater_name = $updater->name;

        return response()->json($table, 201);
    }

    public function updateTable(Request $request, $id)
    {
        $data = $request->validate([
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:' . implode(',', array_keys(Table::getStatusOptions()))
        ]);

        $table = Table::findOrFail($id);
        
        $data['updated_by'] = auth()->id();
        $table->update($data);

        // Get creator and updater names for response
        $creator = User::find($table->created_by);
        $updater = User::find($table->updated_by);

        $table->creator_name = $creator->name;
        $table->updater_name = $updater->name;

        return response()->json($table);
    }

    public function deleteTable($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return response()->json(['message' => 'Table deleted successfully']);
    }
}

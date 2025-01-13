<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TabaleReservationController extends Controller
{
    //
    public function searchTables(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start' => 'required|date_format:H:i:s',
            'end' => 'required|date_format:H:i:s',
        ]);
        $date = $request->date;
        $start = $request->start;
        $end = $request->end;
        $normal = 'start NOT BETWEEN TIME("' . $start . '") AND TIME("' . $end . '") AND end NOT BETWEEN TIME("' . $start . '") AND TIME("' . $end . '")';
        // dd($start, $end);
        $tables = DB::table(DB::raw('(SELECT t.* , r.start, r.end FROM `tables` as t LEFT JOIN reservations as r ON ( r.table_id = t.id AND r.reservation_date = DATE("' . $date . '") AND r.status = "confirmed") ) as t'))
            ->selectRaw('t.id, CONCAT("T", t.id) as name, t.capacity')
            ->whereRaw('start IS NULL OR ( ' . $normal . ' )')
            ->get();
        return response()->json($tables);
        // SELECT * FROM `tables` as t LEFT JOIN reservations as r ON r.table_id = t.id WHERE r.start > TIME('20:23:39') AND r.end < TIME('22:23:39');
    }
}

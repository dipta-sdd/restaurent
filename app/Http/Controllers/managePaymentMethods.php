<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class managePaymentMethods extends Controller
{
    public function adminPaymentMethods()
    {
        $paymentMethods = PaymentMethod::selectRaw('payment_methods.*, 
            CONCAT(creator.first_name, " ", creator.last_name) as creator_name,
            CONCAT(updater.first_name, " ", updater.last_name) as updater_name')
            ->leftJoin('users as creator', 'payment_methods.created_by', '=', 'creator.id')
            ->leftJoin('users as updater', 'payment_methods.updated_by', '=', 'updater.id')
            ->orderBy('payment_methods.created_at', 'desc')
            ->get();

        $statusOptions = PaymentMethod::getStatusOptions();
        return view('admin.payment_methods', compact('paymentMethods', 'statusOptions'));
    }

    public function addPaymentMethod(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(PaymentMethod::getStatusOptions()))
        ]);

        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        $paymentMethod = PaymentMethod::create($data);

        // Get creator and updater names for response
        $creator = User::find($paymentMethod->created_by);
        $updater = User::find($paymentMethod->updated_by);

        $paymentMethod->creator_name = $creator ? $creator->first_name . ' ' . $creator->last_name : 'N/A';
        $paymentMethod->updater_name = $updater ? $updater->first_name . ' ' . $updater->last_name : 'N/A';

        return response()->json($paymentMethod, 201);
    }

    public function updatePaymentMethod(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', array_keys(PaymentMethod::getStatusOptions()))
        ]);

        $paymentMethod = PaymentMethod::findOrFail($id);
        
        $data['updated_by'] = auth()->id();
        $paymentMethod->update($data);

        // Get creator and updater names for response
        $creator = User::find($paymentMethod->created_by);
        $updater = User::find($paymentMethod->updated_by);

        $paymentMethod->creator_name = $creator ? $creator->first_name . ' ' . $creator->last_name : 'N/A';
        $paymentMethod->updater_name = $updater ? $updater->first_name . ' ' . $updater->last_name : 'N/A';

        return response()->json($paymentMethod);
    }

    public function deletePaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();

        return response()->json(['message' => 'Payment method deleted successfully']);
    }
} 
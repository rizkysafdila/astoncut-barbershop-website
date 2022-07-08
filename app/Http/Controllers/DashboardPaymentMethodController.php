<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class DashboardPaymentMethodController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'method' => 'required|max:255',
            'acc_number' => 'required'
        ]);

        PaymentMethod::create($validatedData);

        return redirect('/dashboard/settings')->with('success', 'New payment method has been created!');
    }

    public function update(Request $request)
    {
        $rules = [
            'method' => 'required|max:255',
            'acc_number' => 'required'
        ];

        $validatedData = $request->validate($rules);
        
        PaymentMethod::where('id', $request->id)->update($validatedData);

        return redirect('/dashboard/settings')->with('success', 'Payment method has been updated!');
    }

    public function destroy(Request $request)
    {
        PaymentMethod::where('id', $request['id'])->delete();
        return redirect('/dashboard/settings')->with('success', "Payment method has been deleted!");
    }
}

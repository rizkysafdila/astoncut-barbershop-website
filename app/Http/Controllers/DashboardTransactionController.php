<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        return view('dashboard.transactions.index', [
            'title' => 'Transactions',
            'transactions' => Transaction::with('paymentMethod', 'customer')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'price' => 'required|integer',
            'payment_method' => 'required|integer'
        ]);

        $validatedData['time'] = now();

        Transaction::create($validatedData);

        return redirect('/dashboard/transactions')->with('success', 'New transaction has been created!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Stylist;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\PaymentMethod;
use App\Models\Transaction;

class DashboardCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.customers.index', [
            'title' => 'Customer Reservations',
            'customers' => Customer::with('service', 'stylist')->latest()->get(),
            'methods' => PaymentMethod::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customers.create', [
            'title' => 'Create New Reservation',
            'services' => Service::all(),
            'stylists' => Stylist::where('status', '=', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'service_id' => 'required',
            'time' => 'required',
            'stylist_id' => 'required'
        ]);

        Customer::create($validatedData);

        return redirect('/dashboard/customers')->with('success', 'New reservation has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customers.edit', [
            'title' => 'Edit Customer Reservation',
            'customer' => $customer,
            'services' => Service::all(),
            'stylists' => Stylist::where('status', '=', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'service_id' => 'required',
            'time' => 'required',
            'stylist_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = 1;
        
        Customer::where('id', $customer->id)->update($validatedData);

        return redirect('/dashboard/customers')->with('success', 'Reservation has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
        return redirect('/dashboard/customers')->with('success', "Reservation <b>$customer->id</b> has been deleted!");
    }

    public function updateStatus(Request $request)
    {
        $request['status'] = intval($request['status']);

        $rules = [
            'status' => 'integer'
        ];

        $validatedData = $request->validate($rules);

        Customer::where('id', $request['id'])->update($validatedData);

        return redirect('/dashboard/customers')->with('success', 'Reservation has been updated!');
    }
}

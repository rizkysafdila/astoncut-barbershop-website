<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Stylist;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.reservations.index', [
            'title' => 'My Reservations',
            'customers' => Customer::where([
                ['name', auth()->user()->name],
                ['phone', auth()->user()->phone],
            ])->latest()->get(),
            'services' => Service::all(),
            'stylists' => Stylist::where('status', '=', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reservations.create', [
            'title' => 'Create New Reservation',
            'services' => Service::all(),
            'stylists' => Stylist::where('status', '=', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'service_id' => 'required',
            'time' => 'required',
            'stylist_id' => 'required'
        ]);

        Customer::create($validatedData);

        return redirect('/dashboard/my-reservations')->with('success', 'New reservation has been created!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        dd($customer);
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'service_id' => 'required',
            'time' => 'required',
            'stylist_id' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Customer::where('id', $customer->id)->update($validatedData);

        return redirect('/dashboard/my-reservations')->with('success', 'Reservation has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $request['status'] = intval($request['status']);

        $rules = [
            'status' => 'integer'
        ];

        $validatedData = $request->validate($rules);

        Customer::where('id', $request['id'])->update($validatedData);

        return redirect('/dashboard/my-reservations')->with('success', 'Reservation has been updated!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Stylist;
use Illuminate\Http\Request;

class DashboardStylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.stylists.index', [
            'title' => 'Stylists',
            'stylists' => Stylist::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'address' => 'required|max:255',
        ]);

        Stylist::create($validatedData);

        return redirect('/dashboard/stylists')->with('success', 'New stylist has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stylist  $stylist
     * @return \Illuminate\Http\Response
     */
    public function show(Stylist $stylist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stylist  $stylist
     * @return \Illuminate\Http\Response
     */
    public function edit(Stylist $stylist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stylist  $stylist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stylist $stylist)
    {
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'required|max:13',
            'address' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        Stylist::where('id', $stylist->id)->update($validatedData);

        return redirect('/dashboard/stylists')->with('success', 'Stylist has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stylist  $stylist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stylist $stylist)
    {
        Stylist::destroy($stylist->id);
        return redirect('/dashboard/stylists')->with('success', "Stylist <b>$stylist->name</b> has been deleted!");
    }
}

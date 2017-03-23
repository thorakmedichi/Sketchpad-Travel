<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = [
            'trips' => Trip::get()
        ];

        return view('admin.content.trips.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data = [
            'trip' => null,
            'action' => 'create'
        ];
        return view('admin.content.trips.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {   
        $trip = Trip::firstOrCreate($request->except(['_token', '_method', 'locations']));

        $this->attachLocations($request, $trip);

        return redirect()->route('admin.trips.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        $data = [
            'trip' => $trip,
            'action' => 'edit'
        ];

        return view('admin.content.trips.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, Trip $trip)
    {   
        $trip->update($request->except(['_token', '_method', 'locations']));

        $this->attachLocations($request, $trip);

        return redirect()->route('admin.trips.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('admin.trips.index');
    }

    /**
     * Attach polymorphic relations to Location
     * @param     Request    $request    The request object
     * @param     Trip       $trip       The Trip model
     * @return    null                 
     */
    private function attachLocations(Request $request, Trip $trip){
        $locations = [];
        if (!empty($request->input('locations'))){
            $locations = $request->input('locations');
        }
        $trip->Locations()->sync($locations);
    }
}

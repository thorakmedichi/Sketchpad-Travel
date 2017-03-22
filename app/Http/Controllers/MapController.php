<?php

namespace App\Http\Controllers;

use App\Map;
use Illuminate\Http\Request;
use App\Http\Requests\MapRequest;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = [
            'maps' => Map::get()
        ];
        return view('admin.content.maps.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data = [
            'map' => null,
            'action' => 'create'
        ];
        return view('admin.content.maps.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MapRequest $request)
    {   
        // Create the DB object
        Map::firstOrCreate($request->except(['_token', '_method']));

        return redirect()->route('admin.maps.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        $data = [
            'map' => $map,
            'action' => 'edit'
        ];

        return view('admin.content.maps.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(MapRequest $request, Map $map)
    {   
        // Upload the file to S3 and add filename to request inputs
        $request->merge(['kml_filename' => $this->uploadFile($request)]);        

        // Update database
        $map->update($request->except(['_token', '_method', 'kml_file']));
        return redirect()->route('admin.maps.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
    }
}

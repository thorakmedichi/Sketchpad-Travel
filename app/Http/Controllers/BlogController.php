<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = [
            'blogs' => Blog::get()
        ];
        return view('admin.content.blogs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data = [
            'blog' => null,
            'action' => 'create'
        ];
        return view('admin.content.blogs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blog = Blog::firstOrCreate($request->except('_token', '_method', 'locations', 'trips'));

        $this->attachTrips($request, $blog);
        $this->attachLocations($request, $blog);

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $data = [
            'blog' => $blog,
            'action' => 'edit' // Could also be done like this: explode('@', \Route::currentRouteAction())[1]
        ];
        return view('admin.content.blogs.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->except('_token', '_method', 'locations', 'trips'));

        $this->attachTrips($request, $blog);
        $this->attachLocations($request, $blog);

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Attach polymorphic relations to Trip
     * @param     Request    $request    The request object
     * @param     Blog       $blog       The Blog model
     * @return    null                 
     */
    private function attachTrips(Request $request, Blog $blog){
        $trips = [];
        if (!empty($request->input('trips'))){
            $trips = $request->input('trips');
        }
        $blog->Trips()->sync($trips);
    }

    /**
     * Attach polymorphic relations to Location
     * @param     Request    $request    The request object
     * @param     Blog       $blog       The Blog model
     * @return    null                 
     */
    private function attachLocations(Request $request, Blog $blog){
        $locations = [];
        if (!empty($request->input('locations'))){
            $locations = $request->input('locations');
        }
        $blog->Locations()->sync($locations);
    }
}

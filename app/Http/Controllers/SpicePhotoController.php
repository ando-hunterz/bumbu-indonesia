<?php

namespace App\Http\Controllers;

use App\Models\SpicePhoto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpicePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if ($request->file('photo')) {
            $file_count = 1;
            $path = [];
            $file_name = Carbon::now()->format("Y-m-d-H-i-s") .'.'. $request->file('photo')->getClientOriginalExtension();
            Storage::putFileAs(
                'spice',
                $request->file('photo'),
                $file_name
            );
            $path = Storage::path('spice\\' . $file_name);
        };

        return response()->json(["path" => $path]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpicePhoto  $spicePhoto
     * @return \Illuminate\Http\Response
     */
    public function show(SpicePhoto $spicePhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpicePhoto  $spicePhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(SpicePhoto $spicePhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpicePhoto  $spicePhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpicePhoto $spicePhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpicePhoto  $spicePhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpicePhoto $spicePhoto)
    {
        //
    }
}

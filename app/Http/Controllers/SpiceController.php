<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpiceRequest;
use App\Models\Spice;
use App\Models\SpicePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Spice::all());
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
     * @param  App\Http\Requests\StoreVisitorRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpiceRequest $request)
    {
        dd($request['photo_path']);
        $spice = Spice::create(
            [
                'name' => $request['name'],
                'description' => $request['description'],
                'province' => $request['province_id'],
                'name_translate' => $request['name_translate']
            ]
        );

        
        foreach ($request['photo_path'] as $path) {
            $spice->photos()->save(new SpicePhoto(['photo_url' => $path['photo_url'], 'filename' => $path['filename'], 'size' => $path['size']]));
        }

        $spice->province()->attach($request['province_id']);

        return response()
            ->json(['message' => 'New Spice is successfully requested, please wait for admin to approve'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Spice $spice
     * @return \Illuminate\Http\Response
     */
    public function show(Spice $spice)
    {
        return response()->json(['spice' => $spice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spice $spice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spice $spice)
    {
        $spice->name = $request['name'];
        $spice->description = $request['description'];
        $photos = $spice->photos()->get();
        for ($i = 0; $i < count($request['photo_path']); $i++) {
            if ($i < count($photos) && $photos[$i]['photo_url'] !== $request['photo_path'][$i]) {
                $photos[$i]->remove();
                $spice->photos()->save(new SpicePhoto(['photo_url' => $request['photo_path'][$i]]));
            }
            if ($i >= count($photos)) {
                $spice->photos()->save(new SpicePhoto(['photo_url' => $request['photo_path'][$i]]));
            }
        }
        $spice->is_approved = 0;
        return response()->json(["message" => 'spice edited, please wait for admin approval']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spice $spice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spice $spice)
    {
        $spice->like()->detach();
        $spice->comment()->detach();
        $spice->province()->detach();
        $spice->photos()->each(function ($photo) {
            $photo->delete();
        });
        $spice->delete();
        return response()->json(["message" => 'spice deleted']);
    }
}

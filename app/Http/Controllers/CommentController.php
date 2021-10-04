<?php

namespace App\Http\Controllers;

use App\Models\Spice;
use Illuminate\Http\Request;

class CommentController extends Controller
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
    public function store(Spice $spice, Request $request)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);
        
        if ($spice->comment()->where('visitor_id', '=', $request->header('x-visitor-id'))->count() == 1) {
            return response()->json([
                'status' => '4',
                'message' => 'User has already commented'
            ], 400);
        }

        $spice->comment()->attach($request->header('x-visitor-id'), ['comment' => $request['comment']]);

        return response()->json(["message" => 'Comment is sucessfully added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spice $spice, $id, Request $request)
    {
        if ($id !== $request->header('X-visitor-id')) {
            return response()->json([
                'status' => '3',
                'message' => 'Requested ID with visitor ID not match'
            ], 400);
        }

        $spice->comment()->detach($request->header('X-visitor-id'));

        return response()->json(["message" => 'Comment is sucessfully deleted']);
    }
}

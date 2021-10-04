<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $client_ip = $request->ip();
        $visitor = Visitor::find($request->header('x-visitor-id') == "" ? null : $request->header('x-visitor-id'));
        if($visitor != null) {
            return response()
                    ->json(['user' => $visitor])
                    ->setStatusCode(200);
        }
        if (Visitor::where('ip', '=', $client_ip)->first()) {
            return response()
                    ->json(['user' => Visitor::where('ip', '=', $client_ip)->first()])
                    ->setStatusCode(200);
        } else {
            return response()->json([
                'status' => '1',
                'message' => 'new user found'
            ])->setStatusCode(400);
        }
    }

}

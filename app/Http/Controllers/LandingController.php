<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $client_ip = $request->ip();
        if (Visitor::where('ip', '=', $client_ip)->first()) {
            return response()
                    ->json(['user' => Visitor::where('ip', '=', $client_ip)->first()])
                    ->setStatusCode(200);
        } else {
            return response()->json([
                'status' => '1',
                'message' => 'new user found'
            ])->setStatusCode('400');
        }
    }

}

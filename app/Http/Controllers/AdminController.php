<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Spice;
use App\Models\Visitor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getVisitor()
    {
        return view('visitor')->with(['visitors' => Visitor::all()]);
    }

    public function showVisitor(Visitor $visitor)
    {
        return view('visitor-detail')->with(['visitor' => $visitor]);
    }

    public function deleteVisitor(Visitor $visitor)
    {
        $visitor->like()->detach();
        $visitor->comment()->detach();
        $visitor->delete();
        return response()->json('visitor deleted');
    }

    public function getSpices()
    {
        return view('spice')->with(['spices' => Spice::all()]);
    }

    public function showSpice(Spice $spice)
    {
        return view('spice-detail')->with(['spice' => $spice, 'provinces' => Province::all()->map->only('id','name')]);
    }

    public function storeSpice(Spice $spice)
    {
        
    }

    public function deleteSpice(Spice $spice)
    {
        $spice->like()->detach();
        $spice->comment()->detach();
        $spice->province()->detach();
        $spice->photos()->each(function ($photo) {
            $photo->delete();
        });
        $spice->delete();
        return response()->json('visitor deleted');
    }

    public function showProvince(Province $province)
    {
        return view('province-detail')->with(['province' => $province]);
    }
}

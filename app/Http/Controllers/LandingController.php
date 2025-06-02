<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use App\Models\Room;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing()
    {

        
        $properties = Properties::all();
        $subQuery = Room::selectRaw('MIN(id) as id')->groupBy('room_name');

        $rooms = Room::with('properti.jeniskost') 
            ->whereIn('id', $subQuery)
            ->get();

            

        return view('landing', compact('properties', 'rooms'));
    }
    


}

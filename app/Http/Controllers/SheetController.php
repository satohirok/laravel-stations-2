<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\Reservation;

class SheetController extends Controller
{
    public function index() {
        $sheets = Sheet::all()->groupBy('row');
        return view('/sheet/index',compact('sheets'));
    }

    public function show(Request $request,$movie_id,$schedule_id,$screen_id) {
        $movie = Movie::find($movie_id);
        $schedule = Schedule::find($schedule_id);
        $screen = Screen::find($screen_id);

        if(!$request->input('date')){
            return response()->json(['error' => '画面取得に失敗しました'],400);
        }

        $sheets = Sheet::all()->groupBy('row');
        return view('/sheet/show',compact('movie','schedule','sheets','screen'));
    }
}

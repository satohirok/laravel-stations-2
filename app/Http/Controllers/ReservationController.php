<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Sheet;
use App\Models\Screen;
use App\Models\User;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $reservations = Reservation::with('schedule.movie')->get();
        return view('admin/reservations/index',compact('reservations'));
    }

    public function create(Request $request, $movie_id,$schedule_id,$screen_id)
    {

        if(!$request->has('sheetId') || !$request->has('date'))
        {
            return response()->json(['error' => '画面取得に失敗しました'],400);
        }

        $date = $request->query('date');
        $sheet_id = $request->query('sheetId');
        $screen_id = $request->query('screen_id');

        // 既存の予約をチェック
        $existingReservation = Reservation::where('schedule_id', $schedule_id)
                                        ->where('sheet_id', $sheet_id)
                                        ->where('screen_id', $screen_id)
                                        ->first();

        if ($existingReservation) {
            // すでに予約が存在する場合は400エラーを返す
            return response()->json(['error' => 'すでに予約済みの座席です'],400);
        }

        $sheet_id = $request->input('sheetId');
        $date = $request->input('date');
        $screen_id = $request->input('screen_id');
        return view('/reservation/create',compact('movie_id','schedule_id','sheet_id','date','screen_id'));

}

    public function admin_create()
    {
        $movies  = Movie::all();
        $schedules = Schedule::all();
        $sheets = Sheet::all();
        $screens = Screen::all();
        $users = User::all();
        return view('/admin/reservations/create',compact('movies','schedules','sheets','screens','users'));
    }

    public function store(CreateReservationRequest $request)
    {

        $reservation = new Reservation();
        $reservation->schedule_id = $request->input('schedule_id');
        $reservation->sheet_id = $request->input('sheet_id');
        $reservation->screen_id = $request->input('screen_id');
        $reservation->user_id = $request->input('user_id');
        $reservation->date = $request->input('date');

        $reservation->save();

        $movie_id = Schedule::findOrFail($request->input('schedule_id'))->movie_id;
        return redirect()->route('show', ['id' => $movie_id ]);
    }

    public function admin_store(CreateAdminReservationRequest $request)
    {

        $reservation = new Reservation();
        // $reservation->movie_id
        if ($request->input('date')){
            $reservation->date = $request->input('date');
        }
        $reservation->schedule_id = $request->input('schedule_id');
        $reservation->sheet_id = $request->input('sheet_id');
        $reservation->screen_id = $request->input('screen_id');
        $reservation->user_id = $request->input('user_id');

        $reservation->save();
        return redirect()->route('reservation.index');
    }

    public function edit($id){
        $reservation = Reservation::find($id);
        $movies = Movie::all();
        $schedules = Schedule::all();
        $sheets = Sheet::all();
        $screens = Screen::all();
        $users = User::all();

        return view('/admin/reservations/edit',compact('reservation','movies','schedules','sheets','screens','users'));
    }

    public function update(UpdateAdminReservationRequest $request ,$id){
        $reservation = Reservation::find($id);

        if ($request->input('date')){
            $reservation->date = $request->input('date');
        }
        $reservation->schedule_id = $request->input('schedule_id');
        $reservation->sheet_id = $request->input('sheet_id');
        $reservation->screen_id = $request->input('screen_id');
        $reservation->user_id = $request->input('user_id');

        $reservation->save();

        return redirect()->route('reservation.index');
    }

    public function destroy($id){
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return abort(404);
        }
        $reservation->delete();

        return redirect()->route('reservation.index');
    }
}

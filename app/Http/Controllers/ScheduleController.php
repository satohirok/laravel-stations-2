<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Screen;

class ScheduleController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['schedules' => function($query) {
            $query->orderBy('start_time', 'asc');
        }])->get();

        return view('/admin/schedule/index',compact('movies'));
    }

    public function show($id)
    {
        $schedule = Schedule::find($id);
        return view('/admin/schedule/show',compact('schedule'));
    }

    public function create($id)
    {
        $movie = Movie::find($id);
        $screens = Screen::all();
        return view('/admin/schedule/create',compact('movie','screens'));
    }

    public function store(CreateScheduleRequest $request,$id)
    {

        $startTimeDate = $request->input('start_time_date');
        $startTimeTime = $request->input('start_time_time');
        $endTimeDate = $request->input('end_time_date');
        $endTimeTime = $request->input('end_time_time');

        $startTime = $startTimeDate . ' ' . $startTimeTime;
        $endTime = $endTimeDate . ' ' . $endTimeTime;

        $start = Carbon::createFromFormat('Y-m-d H:i', $startTime);
        $end = Carbon::createFromFormat('Y-m-d H:i', $endTime);

        $schedule = new Schedule();
        $schedule->movie_id = $request->input('movie_id');
        $schedule->screen_id = $request->input('screen_id');
        $schedule->start_time = $start;
        $schedule->end_time = $end;

        $schedule->save();

        return redirect()->route('admin.show', ['id' => $id ]);

    }

    public function edit($id)
    {
        $schedule = schedule::find($id);
        $screens = Screen::all();
        return view('/admin/schedule/edit',compact('schedule','screens'));
    }

    public function update(UpdateScheduleRequest $request,$id)
    {

        $startTimeDate = $request->input('start_time_date');
        $startTimeTime = $request->input('start_time_time');
        $endTimeDate = $request->input('end_time_date');
        $endTimeTime = $request->input('end_time_time');

        $startTime = $startTimeDate . ' ' . $startTimeTime;
        $endTime = $endTimeDate . ' ' . $endTimeTime;

        $schedule = schedule::find($id);
        $schedule->movie_id = $request->input('movie_id');
        $schedule->screen_id = $request->input('screen_id');
        $schedule->start_time = $startTime;
        $schedule->end_time = $endTime;

        $schedule->save();

        return redirect()->route('admin.show', ['id' => $schedule->movie_id ]);

    }

    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return abort(404);
        }

        $schedule->delete();
        return redirect()->route('schedules.index');
    }
}

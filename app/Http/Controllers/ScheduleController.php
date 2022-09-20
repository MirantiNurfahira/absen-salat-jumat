<?php

namespace App\Http\Controllers;

use App\Models\Mosque;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->paginate(100);

        return view('users.schedules.index',compact('schedules'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $schedule = new Schedule;

        $schedule->name = $request->name;
        $schedule->schedule_date = Carbon::parse($request->date)->format('Y-m-d H:i:s');

        $schedule->save();

        return redirect('/schedules')
                        ->with('success','Berhasil Menyimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function show(mosque $mosque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function edit($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        return view('users.schedules.edit',compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $scheduleId)
    {

        $schedule = Schedule::findOrFail($scheduleId);

        $schedule->name = $request->name;
        $schedule->schedule_date = Carbon::parse($request->date)->format('Y-m-d H:i:s');

        $schedule->save();

        return redirect('/schedules')
                        ->with('success','Berhasil Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function destroy(mosque $mosque)
    {
        $mosque->delete();

        return redirect()->route('schedules.index')
                        ->with('success','Berhasil Hapus !');

    }
}

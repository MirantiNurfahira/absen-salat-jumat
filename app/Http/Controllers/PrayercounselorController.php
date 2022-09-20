<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use DB;

class PrayerCounselorController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('created_at', 'desc')->get();

        $user = Auth::guard('users')->user();

        $region = Region::where('prayer_counselor_id', $user->id)
            ->get();

        $regionNames = $region->pluck('region_name')->join(',');

        return view('prayercounselors.index')
            ->with('schedules', $schedules)
            ->with('regionNames', $regionNames);
    }

    public function scheduleDetail($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        $user = Auth::guard('users')->user();

        $regions = Region::where('prayer_counselor_id', $user->id)
            ->get();

        $students = Student::whereIn('region_id', $regions->pluck('id'))
            ->with(['presences' => function ($query) use ($user, $scheduleId) {
                $query->where('prayer_counselor_id', $user->id)->where('schedule_id', $scheduleId);
            }, 'region'])
            ->orderBy('region_id', 'asc')
            ->get();

        return view('prayercounselors.presences')
            ->with('students', $students)
            ->with('schedule', $schedule)
            ->with('regions', $regions);
    }

    public function createPage($scheduleId) {

        $schedule = Schedule::findOrFail($scheduleId);

        $user = Auth::guard('users')->user();

        $regions = Region::where('prayer_counselor_id', $user->id)
            ->get();

        $students = Student::whereIn('region_id', $regions->pluck('id'))
            ->get();

        return view('prayercounselors.createpresence')
        ->with('students', $students)
        ->with('schedule', $schedule)
        ->with('counselor', $user)
        ->with('regions', $regions);
    }

    public function create(Request $request) {
        $presence = new Presence;

        $presence->prayer_counselor_id = $request->prayer_counselor_id;
        $presence->schedule_id = $request->schedule_id;
        $presence->student_id = $request->student_id;
        $presence->check_in = Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $presence->status = $request->status;

        $presence->save();

        return redirect('/prayercounselors/schedules/detail/'.$request->schedule_id);
    }
}

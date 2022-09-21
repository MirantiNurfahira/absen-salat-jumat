<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Region;
use App\Models\Student;
use DB;

class StudentCounselorController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('created_at', 'desc')->get();

        $user = Auth::guard('users')->user();

        $regions = Region::where('student_counselor_id', $user->id)
            ->get();

        $prayerCounselors = Users::whereIn('id', $regions->pluck('prayer_counselor_id'))->get();

        $regionNames = $regions->pluck('region_name')->join(',');
        $prayerCounselorNames = $prayerCounselors->pluck('name')->join(',');

        $students = Student::whereIn('region_id', $regions->pluck('id'))
            ->with('region')
            ->withCount('presencesStatusTrue', 'presencesStatusFalse')
            ->orderBy('name', 'asc')
            ->get();

        return view('studentcounselors.index')
            ->with('students', $students)
            ->with('schedules', $schedules)
            ->with('regionNames', $regionNames)
            ->with('prayerCounselorNames', $prayerCounselorNames);
    }

    public function schedules() {
        $schedules = Schedule::orderBy('created_at', 'desc')->get();

        $user = Auth::guard('users')->user();

        $region = Region::where('student_counselor_id', $user->id)
            ->get();

        $regionNames = $region->pluck('region_name')->join(',');

        return view('studentcounselors.schedules')
            ->with('schedules', $schedules)
            ->with('regionNames', $regionNames);
    }

    public function scheduleDetail($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        $user = Auth::guard('users')->user();

        $regions = Region::where('student_counselor_id', $user->id)
            ->get();

        $students = Student::whereIn('region_id', $regions->pluck('id'))
            ->with(['presences' => function ($query) use ($scheduleId) {
                $query->where('schedule_id', $scheduleId);
            }, 'region'])
            ->orderBy('region_id', 'asc')
            ->get();

        return view('studentcounselors.presences')
            ->with('students', $students)
            ->with('schedule', $schedule)
            ->with('regions', $regions);
    }

    public function students() {
        $user = Auth::guard('users')->user();

        $regions = Region::where('student_counselor_id', $user->id)
            ->get();

        $groupedStudents = Student::whereIn('region_id', $regions->pluck('id'))
            ->with(['region'])
            ->get()
            ->mapToGroups(fn ($item) => [
                $item['region']['region_name'] => $item
            ]);

        return view('studentcounselors.students')
            ->with('groupedStudents', $groupedStudents)
            ->with('regions', $regions);
    }
}

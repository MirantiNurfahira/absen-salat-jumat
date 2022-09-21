<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Attedances;
use App\Models\Leaves;
use App\Models\Presence;
use App\Models\Region;
use App\Schedule;
use Carbon\Carbon;
use DB;
use Str;

class UsersController extends Controller
{
	private function rules_add()
	{
		return [
			'name' => 'required|string',
			'email' => 'required|string',
			'no_phone' => 'required|string',
			'role' => 'required|string',
			'password' => 'required|string',
		];
	}

	// Home Adnub
	public function Home()
	{
		$users = Users::all();
		return view('users.index', compact('users'));
	}

	// Process Create Users
	public function Store(Request $request)
	{
		try {

			$this->validate($request, $this->rules_add());

			Users::create([
				'name' => $request->name,
				'email' => $request->email,
				'no_phone' => $request->no_phone,
				'role' => $request->role,
				'password' => Hash::make($request->password),
			]);

			return redirect()->back()->with('sukses', 'Berhasil Menambahkan Users');

		} catch (Exception $e) {

			return redirect()->back()->with('gagal', 'Gagal Menambahkan Users');
		}
	}

	// Get Edit Users
	public function edit($id)
	{
		$users = Users::find($id);

		return response()->json(['code' => '200', 'data' => $users]);
	}

	// Process Update Users
	public function Update(Request $request, $id)
	{
		try {

			if ($request->password) {
				$update = Users::findOrFail($id);
				$update->update([
					'name' => $request->name,
					'email' => $request->email,
					'no_phone' => $request->no_phone,
					'role' => $request->role,
					'password' => Hash::make($request->password),
				]);

				return response()->json(['code' => 200, 'data' => $update], 200);

			}else{

				$update = Users::findOrFail($id);
				$update->update([
					'name' => $request->name,
					'email' => $request->email,
					'no_phone' => $request->no_phone,
					'role' => $request->role,
				]);

				return response()->json(['code' => 200, 'data' => $update], 200);
			}

		} catch (Exception $e) {

			return response()->json(['code' => 300, 'msg' => 'error'], 300);
		}
	}

	// Process Delete Users
	public function Delete($id)
	{
		$data = Users::find($id);

		if ($data != null) {

            Region::where('student_counselor_id', $data->id)
                ->update(['student_counselor_id'=> null]);

            Region::where('prayer_counselor_id', $data->id)
                ->update(['prayer_counselor_id'=> null]);

            $data->presences()->delete();

			$data->delete();

			return redirect()->back();
		}else{

			return redirect()->back();
		}

    }

    public function prayerCounselorSchedules() {
        $schedules = Schedule::all();

        return view('users.schedules.prayercuntselor',compact('schedules'));
    }

    public function scheduleDetail($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);

        $user = Auth::guard('users')->user();

        $regions = Region::where('prayer_counselor_id', $user->id)->get();

        $prayerCounselors = Users::with(['presences' => function ($query) use ($scheduleId) {
            $query->where('schedule_id', $scheduleId);
        }], 'prayerCounselorRegions')
        ->where('role', 'prayercounselor')->get();

        return view('users.schedules.presences')
            ->with('schedule', $schedule)
            ->with('prayerCounselors', $prayerCounselors)
            ->with('regions', $regions);
    }
}

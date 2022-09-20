<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Mosque;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('mosque', 'studentCounselor', 'prayerCounselor')->paginate(100);

        return view('users.regions.index',compact('regions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mosques = Mosque::all();
        $studentCounselors = User::where('role', 'studentcounselor')->get();
        $prayerCounselors = User::where('role', 'prayercounselor')->get();
        return view('users.regions.create')
            ->with('mosques', $mosques)
            ->with('studentCounselors', $studentCounselors)
            ->with('prayerCounselors', $prayerCounselors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'region_name' => 'required',
            'mosque_id' => 'required',
            'student_counselor_id' => 'required',
            'prayer_counselor_id' => 'required',

        ]);

        $region = new Region;

        $region->region_name = $request->region_name;
        $region->mosque_id = $request->mosque_id;
        $region->student_counselor_id = $request->student_counselor_id;
        $region->prayer_counselor_id = $request->prayer_counselor_id;

        $region->save();

        return redirect()->route('regions.index')
                        ->with('success','Berhasil Menyimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(region $region)
    {
        //
    }

    public function edit($region)
    {
        $region = Region::findOrFail($region);

        $mosques = Mosque::all();
        $studentCounselors = User::where('role', 'studentcounselor')->get();
        $prayerCounselors = User::where('role', 'prayercounselor')->get();

        return view('users.regions.edit')
            ->with('mosques', $mosques)
            ->with('studentCounselors', $studentCounselors)
            ->with('prayerCounselors', $prayerCounselors)
            ->with('region', $region);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'region_name' => 'required',

        ]);

        $region->update($request->all());

        return redirect()->route('regions.index')
                        ->with('success','Berhasil Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('regions.index')
                        ->with('success','Berhasil Hapus !');

    }
}

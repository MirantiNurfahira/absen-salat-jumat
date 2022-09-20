<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Mosque;
use App\Models\Users;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('mosque', 'studentcounselor', 'prayercounselor')->paginate(5);
  
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
        return view('users.regions.create');
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
        $region->mosque_name = $request->mosque_id;
        $region->studentcounselor = $request->student_counselor_id;
        $region->prayercounselor = $request->prayer_counselor_id;
    
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(region $region)
    {
        return view('users.regions.edit',compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, region $region)
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
    public function destroy(region $region)
    {
        $region->delete();
  
        return redirect()->route('regions.index')
                        ->with('success','Berhasil Hapus !');
    
    }
}

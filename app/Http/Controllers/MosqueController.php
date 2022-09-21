<?php

namespace App\Http\Controllers;

use App\Models\Mosque;
use App\Models\Region;
use Illuminate\Http\Request;

class MosqueController extends Controller
{
    public function index()
    {
        $mosques = Mosque::latest()->paginate(100);

        return view('users.mosques.index',compact('mosques'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.mosques.create');
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

            'mosque_name' => 'required',
            'location' => 'required',
        ]);

        Mosque::create($request->all());

        return redirect()->route('mosques.index')
                        ->with('success','Berhasil Menyimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function show(Mosque $mosque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function edit(Mosque $mosque)
    {
        return view('users.mosques.edit',compact('mosque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mosque $mosque)
    {
        $request->validate([
            'mosque_name' => 'required',
            'location' => 'required',
        ]);

        $mosque->update($request->all());

        return redirect()->route('mosques.index')
                        ->with('success','Berhasil Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mosque $mosque)
    {
        Region::where('mosque_id', $mosque->id)
            ->update(['mosque_id' => null]);

        $mosque->delete();

        return redirect()->route('mosques.index')
                        ->with('success','Berhasil Hapus !');

    }
}

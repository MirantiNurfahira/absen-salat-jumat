<?php

namespace App\Http\Controllers;

use App\Models\Mosque;

use Illuminate\Http\Request;

class MosqueController extends Controller
{
    public function index()
    {
        $mosques = Mosque::latest()->paginate(5);
  
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
  
        mosque::create($request->all());
   
        return redirect()->route('mosques.index')
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
    public function edit(mosque $mosque)
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
    public function update(Request $request, mosque $mosque)
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
    public function destroy(mosque $mosque)
    {
        $mosque->delete();
  
        return redirect()->route('mosques.index')
                        ->with('success','Berhasil Hapus !');
    
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::withCount('users')->get();
        // dd($cities[0]);

        return response()->view('cms.cities.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'name_en'=>'required|string|min:3|max:50',
            'name_ar'=>'required|string|min:3|max:50',
             'active'=>'nullable|string|in:on',
        ],[
            'name_en.required' => 'Enter city english name',
            'name_ar.required' =>'Enter city arabic name'
        ]

        );
       $city= new City();
       $city->name_en = $request->input('name_en');
       $city->name_an = $request->input('name_ar');
       $city->active= $request->has('active');
       $isSavad = $city->save();
       if($isSavad ){
        session()->flash('massage','City created successfully');
        return redirect()->route('cities.index');
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
       return response()->view('cms.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate([
            'name_en'=>'required|string|min:3|max:50',
            'name_ar'=>'required|string|min:3|max:50',
             'active'=>'nullable|string|in:on',
        ]);

        $city->name_en = $request->input('name_en');
       $city->name_an = $request->input('name_ar');
       $city->active= $request->has('active');
       $isSavad = $city->save();

       if($isSavad){
        return redirect()->route('cities.index');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illu minate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        $isDeleted = $city->delete();
        return redirect()->back();
    }
}

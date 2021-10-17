<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Profile::with(['user'])->get();
        return Profile::with("user")->get();
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
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:1999'

        ]); 

        $request->file('image')->store('public/images');
        


        $pro = new Profile();
        $pro->city = $request->city;
        $pro->country = $request->country;
        $pro->user_id = $request->user_id;
        $pro->image = $request->file('image')->hashName();

        $pro->save();

        return response()->json('Profile Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Profile::with('user')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:1999'

        ]); 

        $request->file('image')->store('public/images');

        $pro = Profile::findOrFail($id);
        $pro->city = $request->city;
        $pro->country = $request->country;
        $pro->user_id = $request->user_id;
        $pro->image = $request->file('image')->hashName();

        $pro->save();

        return response()->json('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Profile::destroy($id);
    }
}

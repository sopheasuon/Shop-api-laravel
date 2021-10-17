<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'min:3|max:15',
            'price' => 'nullable'
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->save();

        return response()->json(['message' => "Item save successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Item::findOrFail($id);
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
            'name' => 'min:3|max:15',
            'price' => 'nullable'
        ]);

        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->save();

        return response()->json(['message' => "Item updated successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Item::destroy($id);
        if($isDelete == 1) return response()->json(['message' => 'Item delete successfully'], 200);
        // else
        return response()->json(['message' => 'ID NOT EXIT'], 404);
    }

    /**
     * Search item name
     * @param string $name
     * @return \Illuminate\Http\Response 
     */
    public function search($name)
    {
        //
        return Item::where('name', 'like', '%' . $name . '%')->get();
    }


}

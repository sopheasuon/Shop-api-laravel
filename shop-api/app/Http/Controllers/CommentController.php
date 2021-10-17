<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::with('user', 'post')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $com = new Comment();
        $com->user_id = $request->user_id;
        $com->post_id = $request->post_id;
        $com->comment = $request->comment;

        $com->save();

        return response()->json("Comment Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Comment::with('user', 'post')->findOrFail($id);  
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
        $com = Comment::findOrFail($id);
        $com->user_id = $request->user_id;
        $com->post_id = $request->post_id;
        $com->comment = $request->comment;

        $com->save();

        return response()->json("Comment updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $isDeletCmt = Comment::destroy($id);
       if($isDeletCmt == 1) return response()->json(['message' => 'Comment  delete successfully'], 200);

       return response()->json(['message' => "ID Not Exit"], 404);
    }
}

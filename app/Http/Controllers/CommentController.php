<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate comment
        $validator = Validator::make($request->all(),[
            'username' => ['required'],
            'postid' => ['required'],
            'comment' => ['required']
        ]);

        if($validator->fails())
        {
            //return back()->withErrors($validator)->withInput();
            return response()->json(['error' => $validator->errors()->all()]);
        }
        else
        {
            // save comment
            $user_comment = new Comment([
                'username' => $request['username'],
                'post_id' => $request['postid'],
                'comment' => $request['comment']
            ]);

            $user_comment->save();
            return back();
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // show comments to posts/loadcomment
        $usercomments = Comment::where('post_id', $id)->get();
        return view('posts/loadcomment', compact('usercomments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

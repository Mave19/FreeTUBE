<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\UserReact;
use Validator;

class AdminController extends Controller
{
    /**
     * Checks if user is admin
     * 
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     * Fetching all data to admin page
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tableusers = User::paginate(10);
        $tableposts = Post::paginate(10);
        $tablecomments = Comment::paginate(10);
        $tablereacts = UserReact::paginate(10);
        return view('admin', compact('tableusers', 'tableposts', 'tablecomments', 'tablereacts'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $useredit = User::findorFail($id);
        return view('adminact/edit', compact('useredit'));
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
        // checks id
        $user_edit = User::findorFail($id);

        // validate data
        $validator = Validator::make($request->all(),[
            'username' => ['required'],
            'email' => ['required'],
            'contact' => ['required'],
            'admin' => ['required']
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator);
        }
        else
        {
            // update data
            $user_edit->username = $request->username;
            $user_edit->email = $request->email;
            $user_edit->contact = $request->contact;
            $user_edit->admin = $request->admin;

            $user_edit->save();

            return back()->with('success', 'User Updated');
        }
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

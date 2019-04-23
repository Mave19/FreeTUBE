<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserReact;
use Validator;

class UserReactController extends Controller
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
        //validate reacts
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'username' => ['required'],
            'postid' => ['required'],
            'reaction' => ['required']
        ]);

        if($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        else
        {
            // checking if the user already have a reaction and also to prevent spam of reacts
            $email = $request['email'];
            $postid = $request['postid'];

            // I used this so I can pass $email and $postid to where clause as an array
            $find = UserReact::where([
                                ['email', '=', $email],
                                ['post_id', '=', $postid]
                               ])->first();
            
            if(!$find)
            {
                // if $find didn't find a matching record it will be saved
                $user_react = new UserReact([
                    'email' => $request['email'],
                    'username' => $request['username'],
                    'post_id' => $request['postid'],
                    'reaction' => $request['reaction']
                ]);

                $user_react->save();
            }
            else
            {
                // if $find finds a matching record then it will be deleted
                if($find->reaction == 'Heart')
                {
                    $find->delete();
                    return null;
                }
            }
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
        // getting reacts
        $userreacts = UserReact::where('post_id', $id)->get();
        return view('posts/loadreact', compact('userreacts'));
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

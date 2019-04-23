<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show post to home
        $userfeeds = Post::orderBy('id', 'desc')->get();
        return view('posts/loadpost', compact('userfeeds'));
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
        //custom name attributes for validator
        $attributes = [
            'fileupload.*' => 'file upload',
            'fileupload' => 'file upload'
        ];

        // validate post 
        $validator = Validator::make($request->all(),[
            'username' => ['required'],
            'email' => ['required'],
            'title' => ['required', 'min:5', 'unique:posts,title'],
            'description' => ['required', 'min:5'],
            'fileupload.*' => ['file', 'mimes:jpeg,bmp,jpg,png,gif,mp4,avi', 'nullable', 'max:500000'],
            'fileupload' => ['array', 'max:3']
        ], [], $attributes);

        if($validator->fails())
        {
            //return back()->withErrors($validator)->withInput();
            return response()->json(['error' => $validator->errors()->all()]);
        }
        else
        {
            //For file upload
            if($request->hasfile('fileupload.*'))
            {
                // Breaking the multiple file upload with foreach
                foreach($request->file('fileupload.*') as $file)
                {
                    // Doing this 3 steps to have name duplication
                        // Get filename and extension
                        $filenameext = $file->getClientOriginalName();
                        // Get only filename
                        $filename = pathinfo($filenameext, PATHINFO_FILENAME);
                        // Get only extension
                        $fileextension = $file->getClientOriginalExtension();
                    //END
                    // Getting the filename to store and the time differs the file
                    $filetostore = $filename.'-'.time().'.'.$fileextension;
                    // Storing the file 
                    $path = $file->storeAs('public/user_upload', $filetostore); 
                    // Storing filename as an array to database
                    $filedata[] = $filetostore;
                }   
            }
            else
            {
                // if user didn't upload a file
                $filedata[] = "no_file";
            }

            // save post
            $user_post = new Post([
                'username' => $request['username'],
                'email' => $request['email'],
                'title' => $request['title'],
                'description' => $request['description'],
                'file_upload' => implode(',', $filedata)
            ]);

            $user_post->save();

            return back();
        }
    }

    /**
     * Display the specified resource.
     * I used the parameter $title instead of $id for security reasons
     * and also the title column on the db is unique so there are no problems
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        // show post to posts/post
        $showfeed = Post::where('title', $title)->firstOrFail();
        return view('posts/expandpost', compact('showfeed'));
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
        Post::destroy($id);
        return back()->with('success', 'Post Deleted');
    }
}

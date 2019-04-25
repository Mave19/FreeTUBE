@extends('layouts.main')

@section('title')
Free|TUBE Home
@endsection

@guest
    <script>window.location="{{url('login')}}"</script> 
@else
    @section('content')
    <div class="container">
        <!-- ERROR ALERT -->
        <div class="alert alert-danger" role="alert" style="display:none">
            <a href="javascript:location.reload(true)" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
            <h3>Oops! There's an error.</h3>
                <ul>
                
                </ul>
        </div>
        <!-- SUCCESS ALERT -->
        @if(\Session::has('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3>SUCCESS</h3>
                    <li>{{\Session::get('success')}}</li>
            </div>
        @endif
        <div class="card card text-white bg-dark">
            <div class="card-header">
                <h1>Post something...</h1>
            </div>
            <!-- FORM POST -->
            <form class="card-body" id="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
                <input type="hidden" name="username" value="{{Auth::user()->username}}">
                <input type="hidden" name="email" value="{{Auth::user()->email}}">  
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="fileupload[]" id="fileupload" multiple>
                </div>    
                <button type="submit" class="btn btn-success float-right">POST</button>
            </form> 
        </div>
        <br> 

        <!-- POST -->
        <h1>POSTS FEED</h1>
            <!-- LOADING THINGY-->
                <div id="loading">Loading...</div>
            <!-- SHOW POST -->
                <div id="showposts"></div>
    </div>
        <!-- AJAX POST -->
        <script src="{{asset('js/ajax/post.js')}}"></script>
        <!-- END -->

        <!-- FETCHING DATA POSTS ON START OF THE PAGE -->
        <script>
            // load url data
            var url = "{{url('/post')}}";

            $('#loading').delay(800).fadeOut(500, function(){
                $("#showposts").load('{{url("/post")}}');
            });
        </script>
        <!-- END -->
    @endsection
@endguest

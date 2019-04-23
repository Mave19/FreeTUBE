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
        <script>
            $(document).ready(function() {
                $('#post').on('submit', function(e){
                    e.preventDefault();
                    // NEEDED THIS WHEN YOU UPLOADING A FILE THROUGH AJAX
                    var formData = new FormData($('#post')[0]);
                    // SAVING OF POST
                    $.ajax({
                        type: "POST",
                        url: "/post",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data)
                        {
                            if($.isEmptyObject(data.error))
                            {
                                //Clearing the form after success
                                $('#post')[0].reset();
                                
                                // Setting a setTimeout to fetch new posted data
                                var refresh = setTimeout(function(){
                                    $("#showposts").load('{{url("/post")}}').fadeIn(500);
                                }, 1000);
                            }
                            else
                            {
                                showErrors(data.error);
                            }
                        }
                    });
                });
            });
            // SHOWING OF ERRORS
            function showErrors(message)
            {
                $('.alert-danger').find('ul').empty();
                $('.alert-danger').css('display', 'block');

                $.each(message, function(key, value){
                    $('.alert-danger').find('ul').append("<li>" + value + "</li>");
                });
            }
            // FETCHING DATA POSTS ON START OF THE PAGE
            $('#loading').delay(800).fadeOut(500, function(){
                $("#showposts").load('{{url("/post")}}');
            });
        </script>
    @endsection
@endguest

<!-- EXPANDED POST -->
@extends('layouts.main')

@section('title')
Free|TUBE {{$showfeed->title}}
@endsection

@guest
    <script>window.location="{{url('login')}}"</script>    
@else
    @section('content')
    <div class="container">
        <h1>{{$showfeed->username}} POST</h1>
        <!-- SHOW SELECTED POST -->
        <div class="card text-white bg-dark">
            <div class="card-header">
                User: {{$showfeed->username}} | Posted: {{$showfeed->created_at}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$showfeed->title}}</h5>
                <p class="card-text">{!! nl2br(e($showfeed->description)) !!}</p>
                <!-- SHOW IMAGE -->
                @if($showfeed->file_upload !== 'no_file')
                    <!-- EXPLOADING THE COMMA TO FETCH THE DATA -->
                    @php
                        $files = explode(',', $showfeed->file_upload)
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($files as $file)
                                <!-- VALIDATING THE EXTENSION -->
                                @if(substr($file, -4) == '.png' or substr($file, -4) == '.jpg' or substr($file, -4) == '.gif' or substr($file, -4) == '.bmp')
                                    <!-- USING LIGHTBOX TO DISPLAY IMAGE -->
                                    <a data-lightbox="userupload" href="/storage/user_upload/{{$file}}">
                                        <img class="img-thumbnail rounded" src="/storage/user_upload/{{$file}}" style="margin-bottom:5px">
                                    </a>   
                                @else
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video class="embed-responsive-item" controls>
                                            <source src="/storage/user_upload/{{$file}}" type="video/mp4">
                                            <source src="/storage/user_upload/{{$file}}" type="video/ogg">
                                            Your browser does not support HTML5 video.
                                        </video>   
                                    </div>      
                                @endif  
                            @endforeach
                        </div>
                    </div>
                @endif  
            </div>
            <div class="card-footer">
                <!-- ERROR ALERT -->
                <div class="alert alert-danger" role="alert" style="display:none">
                    <a href="javascript:location.reload(true)" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <h3>Oops! There's an error.</h3>
                    <ul>
                    
                    </ul>    
                </div>
                <!-- COMMENTS -->
                <hr class="bg-light">
                    <h3>Comments:</h3> 
                        <!-- LOADING THINGY -->
                        <div id="loading">Loading...</div>
                        <!-- WHERE WE SHOW COMMENTS -->
                        <div id="showcomments"></div>     
                <hr class="bg-light"> 
                <!-- SAVE COMMENT -->
                <form id="postcomment">
                @csrf
                    <input type="hidden" name="username" value="{{Auth::user()->username}}">
                    <input type="hidden" name="postid" value="{{$showfeed->id}}">
                    <div class="form-group">
                        <textarea class="form-control" name="comment" id="comment">{{old('comment')}}</textarea>
                    </div>
                    <!-- HEART/REACT BUTTON -->
                    <button type="button" class="btn btn-danger btn-sm" id="Heart">
                        <i id="showreacts" class="fas fa-heart"> </i>
                    </button> 
                    <!-- END -->
                    <button type="submit" class="btn btn-success float-right">Comment</button>
                </form>       
            </div>
        </div>
    </div>  
    <!-- AJAX FOR COMMENT, & HEART REACTS -->
        <script>
            $(document).ready(function() {
                // SAVING OF COMMENTS
                $('#postcomment').on('submit', function(e){
                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "/comment",
                        data: $('#postcomment').serialize(),
                        success: function(data)
                        {
                            if($.isEmptyObject(data.error))
                            {
                                // Clearing the form after success
                                $('#postcomment')[0].reset();
                            }
                            else
                            {
                                showErrors(data.error);
                            }
                        }
                    });
                });
                // SAVING REACTS
                $('#Heart').click(function(e){
                    e.preventDefault();
                    // getting the data    
                    var useremail = "{{Auth::user()->email}}";
                    var username = "{{Auth::user()->username}}";
                    var post_id = "{{$showfeed->id}}";
                    var reaction = "Heart";
                    // passing the data through ajax
                    $.ajax({
                        type: "POST",
                        url: "/react",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 
                        {
                            email: useremail,
                            username: username,
                            postid: post_id,
                            reaction: reaction
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
            // FETCHING OF DATA
            var refresh = setInterval(function(){
                // FETCHING COMMENTS
                $('#loading').delay(800).fadeOut(500, function(){
                    $("#showcomments").load('{{url("/comment/$showfeed->id")}}');
                });
                // FETCHING REACTS
                $("#showreacts").load('{{url("/react/$showfeed->id")}}');
            }, 1000);
        </script>
    @endsection    
@endguest
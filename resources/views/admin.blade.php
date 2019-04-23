@extends('layouts.main')

@section('title')
Admin Dashboard
@endsection

@guest
    <script>window.location="{{url('login')}}"</script> 
@else
    @section('content')
        <div class="container">
            <h1>DASHBOARD</h1>
            <!-- BOXES -->
                <div class="row">
                    <!-- USERS -->
                    <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                        <a href="#" onclick="tabs(event, 'Users')" class="after-loop-item card border-0 card-templates shadow-lg">
                            <div class="card-body d-flex align-items-end flex-column text-right text-white bg-danger">
                                <h4>USERS</h4>
                                <p class="w-75">The list of users</p>
                                <i class="fas fa-users"> {{$tableusers->count()}}</i>
                            </div>
                        </a>
                    </div>
                    <!-- POSTS -->
                    <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                        <a href="#" onclick="tabs(event, 'Posts')" class="after-loop-item card border-0 card-templates shadow-lg">
                            <div class="card-body d-flex align-items-end flex-column text-right text-white bg-primary">
                                <h4>POSTS</h4>
                                <p class="w-75">The list of posts</p>
                                <i class="fas fa-rss-square"> {{$tableposts->count()}}</i>
                            </div>
                        </a>
                    </div>
                    <!-- COMMENTS -->
                    <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                        <a href="#" onclick="tabs(event, 'Comments')" class="after-loop-item card border-0 card-templates shadow-lg">
                            <div class="card-body d-flex align-items-end flex-column text-right text-white bg-success">
                                <h4>COMMENTS</h4>
                                <p class="w-75">The list of comments</p>
                                <i class="fas fa-comments"> {{$tablecomments->count()}}</i>
                            </div>
                        </a>
                    </div>
                    <!-- REACTS -->
                    <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto">
                        <a href="#" onclick="tabs(event, 'Reacts')" class="after-loop-item card border-0 card-templates shadow-lg">
                            <div class="card-body d-flex align-items-end flex-column text-right text-dark bg-warning">
                                <h4>REACTS</h4>
                                <p class="w-75">The list of reacts</p>
                                <i class="fas fa-heart"> {{$tablereacts->count()}}</i>
                            </div>
                        </a>
                    </div>
                </div><br>
        <!-- END -->
        
        <!-- TABLES -->
            <!-- FOR USERS -->
            <div id="Users" class="maintab">
                <h1>USERS TABLE</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Contact #</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tableusers as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->contact}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><a href="/admin/{{$user->id}}/edit"> Edit</a></td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                    </div>
            </div>  
            <!-- FOR POSTS -->
            <div id="Posts" class="tabcontent" style="display:none">
                <h1>POST TABLE</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Uploaded File</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tableposts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->username}}</td>
                                <td>{{$post->email}}</td>
                                <td>{{$post->title}}</td>
                                <td>{!! nl2br(e($post->description)) !!}</td>
                                <td>{{$post->file_upload}}</td>
                                <td>{{$post->created_at}}</td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                    </div>
            </div>
            <!-- FOR COMMENTS -->
            <div id="Comments" class="tabcontent" style="display:none">
                <h1>COMMENT TABLE</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Post ID</th>
                                <th>Comment</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tablecomments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->username}}</td>
                                <td>{{$comment->post_id}}</td>
                                <td>{!! nl2br(e($comment->comment)) !!}</td>
                                <td>{{$comment->created_at}}</td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                    </div>
            </div>  
            <!-- FOR REACTS -->
            <div id="Reacts" class="tabcontent" style="display:none">
                <h1>REACT TABLE</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Post ID</th>
                                <th>Reaction</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tablereacts as $react)
                            <tr>
                                <td>{{$react->email}}</td>
                                <td>{{$react->username}}</td>
                                <td>{{$react->post_id}}</td>
                                <td>{{$react->reaction}}</td>
                                <td>{{$react->created_at}}</td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                    </div>
            </div>
        </div>
        <!-- SCRIPT FOR CHANGING OF TABLES -->
        <script>
            function tabs(evt, tabtype){
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++){
                    tabcontent[i].style.display = "none";
                }
                maintab = document.getElementsByClassName("maintab");
                for (i = 0; i < maintab.length; i++){
                    maintab[i].style.display = "none";
                }
                document.getElementById(tabtype).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
    @endsection
@endguest
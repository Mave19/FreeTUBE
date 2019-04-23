<!-- LOADING OF POST -->
@forelse($userfeeds as $feed)
    <div class="card text-white bg-dark">
        <div class="card-header">
            <label>User: {{$feed->username}} | Posted: {{$feed->created_at}}</label>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$feed->title}}</h5>
            <p class="card-text">{!! nl2br(e($feed->description)) !!}</p>
            <!-- SHOW IMAGE -->
            @if($feed->file_upload !== 'no_file')
                <!-- EXPLOADING THE COMMA TO FETCH THE DATA -->
                @php
                    $files = explode(',', $feed->file_upload)
                @endphp
                <div class="row">
                    <div class="col-md-12">
                        @foreach($files as $file)
                            <!-- VALIDATING THE EXTENSION -->
                            @if(substr($file, -4) == '.png' or substr($file, -4) == '.jpg' or substr($file, -4) == '.gif')
                                <!-- USING LIGHTBOX TO DISPLAY IMAGE -->
                                <a data-lightbox="userupload" href="/storage/user_upload/{{$file}}">
                                    <img class="img-thumbnail rounded" src="/storage/user_upload/{{$file}}" width="150" height="90" style="margin-bottom:5px">
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
            <!-- CHECKS USER THAT LOGIN FOR DELETE BUTTON -->
            @if(isset(Auth::user()->email))
                @if(Auth::user()->email == $feed->email)
                    <form action="/post/{{$feed->id}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm float-right" 
                        onclick="return confirm('Are you sure you want to delete this? You cannot bring this back.');"
                        value="Delete Post">
                    </form>
                @endif
            @endif
            <!-- EXPAND POST BUTTON -->
            <a href="/post/{{$feed->title}}" class="btn btn-primary btn-sm float-right" style="margin-right:5px">Expand Post</a>
        </div>
    </div>
@empty
    <label>NO DATA! :(</label>    
@endforelse
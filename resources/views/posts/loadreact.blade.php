<!-- COUNT REACTS -->
@if(isset(Auth::user()->email))
    <!-- echo number of reacts -->
    {{$userreacts->count()}}
    <!-- checks logged user -->
    @foreach($userreacts as $react)
        @if(Auth::user()->email == $react->email)
            <!-- if email matched -->
            <br>(You reacted)
        @endif
    @endforeach
@endif
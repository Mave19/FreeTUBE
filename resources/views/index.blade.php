@extends('layouts.main')

@section('title')
Free|TUBE 
@endsection

@section('content')
    @guest
        <div class="container">
            <h1>HELLO USER</h1>

            <p>Hello, this is my first laravel project which aims to post anything you'd like to share on Free|TUBE.
            It could span to videos, pictures or your thoughts. But first you need to have an account to start.</p>

            <img class="image" src="/images/laravelpic.png">
        </div>
    @else
        <script>window.location="{{url('/home')}}"</script>    
    @endguest    
@endsection
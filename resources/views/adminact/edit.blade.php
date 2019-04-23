@extends('layouts.main')

@section('title')
Edit - {{$useredit->username}}
@endsection

@section('content')
<div class="container">
    <!-- ERROR ALERT -->
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3>Oops! There's an error.</h3>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark">
                <div class="card-header">EDIT USER</div>

                <div class="card-body">
                    <form method="POST" action="/admin/{{$useredit->id}}">
                        @csrf
                        @method("PUT")

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{$useredit->username}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$useredit->email}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{$useredit->contact}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="admin" class="col-md-4 col-form-label text-md-right">{{ __('Admin Type') }}</label>

                            <div class="col-md-6">
                                <select id="admin" class="btn btn-light" name="admin">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
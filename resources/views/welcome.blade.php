@extends('layout')

@section('content')

    Welcome, {{ Auth::getUser()->name }}
    
@endsection
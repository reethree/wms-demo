@extends('layout')

@section('content')
<div id="wrap-body">
    
    <div class="container margin-top-90">

        <div class="content" style='height:auto; min-height:auto;'>
            <div class='wrap-requirement'>

                <div class="box-requirement page-other">
                
                    <div class='text-center'>
                        <h1>404</h1>
                        <p>{{trans('message.PAGE_NOT_FOUND')}}</p>
                        <a href='{{route('index')}}' class='btn btn-danger btn-sm margin-top-30'>{{trans('message.BACK')}}</a>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop

@section('header')
<style>
    html,body{
        height:auto;
    }
</style>
@stop
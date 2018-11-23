@extends('layouts.master')

@section('menus')
	@auth
		<app-header :user="{{auth()->user()}}">{{ auth()->user()->name }}</app-header>
	@endauth
@stop

@section('content')
	@auth
		<router-view></router-view>
	@endauth
@stop

@section('welcome')
	@guest
		<welcome></welcome>
	@endguest
@stop

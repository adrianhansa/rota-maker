@extends('layouts.app')

@section('content')
<div class="container">
	@auth
		<app-header :user="{{auth()->user()}}">{{ auth()->user()->name }}</app-header>
		<router-view></router-view>
	@else
		<welcome></welcome>
	@endauth
</div>
@endsection

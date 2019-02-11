@extends('layouts.default')
@section('title','用户列表')

@section('content')
  <h1>所用用户</h1>
  @foreach($users as $user)
    @include('users._user',$user)
  @endforeach
  {{ $users->links() }}
@stop

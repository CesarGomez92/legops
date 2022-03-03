@extends('layouts.app')

@section('title')
    {{ __('users.create_user') }} @parent
@endsection

@section('content')
    <create-user :categories="{{ $categories }}"></create-user>
@endsection
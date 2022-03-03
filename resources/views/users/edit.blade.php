@extends('layouts.app')

@section('title')
    {{ __('users.create_user') }} @parent
@endsection

@section('content')
    <users-form :categories="{{ $categories }}" :user="{{ $user }}"></users-form>
@endsection
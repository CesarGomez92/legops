@extends('layouts.app')

@section('title')
    {{ __('users.create_user') }} @parent
@endsection

@section('content')
    <users-form :categories="{{ $categories }}"></users-form>
@endsection
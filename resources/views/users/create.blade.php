@extends('layouts.app')

@section('title')
    {{ __('users.list_users') }} @parent
@endsection


@section('content')
    <list-users :categories="{{ $categories }}"></list-users>
@endsection
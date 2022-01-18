@extends('layouts.app')

@section('content')
    <check-sales :auth_user='@json($auth_user)'></check-sales>
@endsection

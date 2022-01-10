@extends('layouts.app')

@section('content')
    <my-product :auth_user='@json($auth_user)'></my-product>
@endsection

@extends('layouts.app')

@section('content')
    <order-history :auth_user='@json($auth_user)'></order-history>
@endsection

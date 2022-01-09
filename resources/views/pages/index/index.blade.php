@extends('layouts.index')

@section('content')
    <index :auth_user='@json($auth_user)'></index>
@endsection

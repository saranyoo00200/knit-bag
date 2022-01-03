@extends('layouts.app')

@section('content')
    @role('admin')
        <admin-dashboard></admin-dashboard>
    @endrole
    @role('user')
        <user-dashboard></user-dashboard>
    @endrole
@endsection

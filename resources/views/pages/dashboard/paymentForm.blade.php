@extends('layouts.app')

@section('content')
    <payment-form :auth_user='@json($auth_user)'></payment-form>
@endsection

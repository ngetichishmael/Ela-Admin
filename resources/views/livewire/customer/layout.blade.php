@extends('layouts.layoutMaster')

@section('title', 'Customers')


@section('content')
    <!-- Dashboard Ecommerce Starts -->
    @livewire('customer.dashboard')
    <!-- Dashboard Ecommerce ends -->
@endsection

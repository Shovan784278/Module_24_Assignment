@extends('layout.sidenav-layout')
@section('content')

@include('components.event.event_create')
@include('components.event.event_delete')
@include('components.event.event_list')
@include('components.event.event_update')
@endsection
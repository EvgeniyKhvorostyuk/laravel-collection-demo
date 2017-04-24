@extends('layouts.master')

@section('content')
    
  @if (Auth::check()) <h1>Hello, {{ Auth::user()->name }}</h1> @else <h1>Hello, Guest</h1> @endif

@endsection
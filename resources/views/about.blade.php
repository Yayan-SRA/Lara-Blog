@extends('layouts.main')

@section('content')
    <img src="img/{{ $img }}" alt="{{ $name }}" srcset="">
    <h3>{{ $name }}</h3>
    <h3>{{ $email }}</h3>
@endsection

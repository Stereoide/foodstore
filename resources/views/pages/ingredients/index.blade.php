@extends('layouts.app')

@section('content')
    <ingredients-list :data-ingredients="{{ $ingredients }}"></ingredients-list>
@endsection

@extends('layouts.app')


@section('content')



<form action="{{ route('clients.store') }}" method="post">
	@method('post')

	@include('clients._form')
</form>

@endsection
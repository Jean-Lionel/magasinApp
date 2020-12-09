@extends('layouts.app')


@section('content')



<form action="{{ route('users.store') }}" method="post">
	@method('post')

	@include('users._form')
</form>

@endsection
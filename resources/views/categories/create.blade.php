@extends('layouts.app')


@section('content')



<form action="{{ route('categories.store') }}" method="post">
	@method('post')

	@include('categories._form')
</form>

@endsection
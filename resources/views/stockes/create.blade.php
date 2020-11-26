@extends('layouts.app')


@section('content')



<form action="{{ route('stockes.store') }}" method="post">
	@method('post')

	@include('stockes._form')
</form>

@endsection
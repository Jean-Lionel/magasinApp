@extends('layouts.app')


@section('content')



<form action="{{ route('products.store') }}" method="post">
	@method('post')

	@include('products._form')
</form>

@endsection
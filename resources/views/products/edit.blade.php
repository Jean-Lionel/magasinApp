@extends('layouts.app')


@section('content')



<form action="{{ route('products.update', $product) }}" method="post">
	@method('put')

	@include('products._form',['btnMessage' => 'Modifier'])
</form>

@endsection
@extends('layouts.app')


@section('content')



<form action="{{ route('clients.update', $client) }}" method="post">
	@method('put')

	@include('clients._form',['btnMessage' => 'Modifier'])
</form>

@endsection
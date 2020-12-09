@extends('layouts.app')


@section('content')



<form action="{{ route('users.update', $user) }}" method="post">
	@method('put')

	@include('users._form',['btnMessage' => 'Modifier'])
</form>

@endsection
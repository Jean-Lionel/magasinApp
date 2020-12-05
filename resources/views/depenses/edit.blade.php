@extends('layouts.app')


@section('content')



<form action="{{ route('depenses.update', $depense) }}" method="post">
	@method('put')

	@include('depenses._form',['btnMessage' => 'Modifier'])
</form>

@endsection
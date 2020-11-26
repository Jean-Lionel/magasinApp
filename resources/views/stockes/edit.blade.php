@extends('layouts.app')


@section('content')



<form action="{{ route('stockes.update', $stocke) }}" method="post">
	@method('put')

	@include('stockes._form',['btnMessage' => 'Modifier'])
</form>

@endsection
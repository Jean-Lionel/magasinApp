@extends('layouts.app')


@section('content')



<form action="{{ route('depenses.store') }}" method="post">
	@method('post')

	@include('depenses._form',['btnMessage' => 'Enregistrer'])
</form>

@endsection
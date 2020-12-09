@extends('layouts.app')


@section('content')



<form action="{{ route('users.update', $user) }}" method="post">
	@method('put')

	@include('users._form',['btnMessage' => 'Modifier'])


	<div class="col-md-6 offset-3">

		<div class="row">

		@foreach ($roles as $role)
		{{-- expr --}}

		
			
			<div class="form-group form-check col-md-6">

				<input class="ml-3" type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id}}" id="{{$role->id}}" 

				@foreach ($user->roles as $userRole)
				{{-- expr --}}
				@if ($userRole->id == $role->id)
				{{'checked'}}

				@endif
				@endforeach

				>

				<label for="{{$role->id}}" class="form-check-label ml-3">{{$role->name}}</label>

			</div>


		
		@endforeach

		</div>


	</div>

	

</form>

@endsection
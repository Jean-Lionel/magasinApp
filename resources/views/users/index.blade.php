@extends('layouts.app')

@section('content')

<div>
	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('users.create') }}" 
			class="btn btn-primary btn-sm">Ajouter</a>
			<h4 class="text-center">
				Liste des produits
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="text" name="search" class="form-control form-control-sm" value="{{ $search ?? ""}}" placeholder="Rechercher ici ">
			</form>
		</div>
	</div>
	
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">NOM</th>
				<th scope="col">E-MAIL</th>
				<th scope="col">Roles</th>

				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>

					<ul class="">
					
						@foreach($user->roles as $role)
						<li class="">{{ $role->name }}</li>
						@endforeach

					</ul>
					


				</td>
				<td class="d-flex">
					<a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i> </a>

					<form action="{{ route('users.destroy', $user) }}" method="post">
						@csrf
						@method('DELETE')

						<button type="submit" class="btn ml-2 btn-danger btn-sm"><i class="fa fa-trash"></i></button>
					</form>
				</td>
				
			</tr>

			@endforeach


		</tbody>
	</table>






</div>

<div class="col-md-12" style="height: 20px; overflow: hidden;">
	{{-- {{ $products->links()}} --}}
</div>


@endsection
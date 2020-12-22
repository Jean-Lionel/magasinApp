@extends('layouts.app')

@section('content')

<div>
	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('stockes.create') }}" 
			class="btn btn-primary btn-sm">bon d'entre en stock</a>
			<h4 class="text-center">
				Liste des stockes
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="search" class="form-control form-control-sm" placeholder="Rechercher ici ">
			</form>
		</div>
	</div>
	
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Designation</th>
				<th scope="col">Description</th>
				<th scope="col">Date de creation</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($stockes as $value)
			{{-- expr --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>
					{{ $value->name}}
				</td>

				<td>{{ $value->description }}</td>
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">
					<a href="{{ route('stockes.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>
					<form class="form-delete" action="{{ route('stockes.destroy' , $value) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm delete_client">Supprimer</button>
				</form>


				</td>
			</tr>
			@endforeach


		</tbody>
	</table>

	
</div>

<div class="col-md-12" style="height: 20px; overflow: hidden;">
		{{ $stockes->links()}}
</div>


@endsection
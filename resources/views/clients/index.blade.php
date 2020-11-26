@extends('layouts.app')

@section('content')

<div>
	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('clients.create') }}" 
			class="btn btn-primary btn-sm">Ajouter</a>
			<h4 class="text-center">
				Liste des clients
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
				<th scope="col">NOM</th>
				<th scope="col">PRENOM</th>
				<th scope="col">TELEPHONE</th>
				<th scope="col">ADDRESSE</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($clients as $value)
			{{-- expr 



description  --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>
					{{ $value->first_name}}
				</td>
				<td>{{ $value->last_name }}</td>
				<td>{{ $value->telephone }}</td>
				<td>{{ $value->addresse }}</td>
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">
					<a href="{{ route('clients.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>
					<form class="form-delete" action="{{ route('clients.destroy' , $value) }}" style="display: inline;" method="POST">
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
		{{ $clients->links()}}
</div>


@endsection
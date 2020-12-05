@extends('layouts.app')

@section('content')

<div>
	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('depenses.create') }}" 
			class="btn btn-primary btn-sm">Ajouter</a>
			<h4 class="text-center">
				Tout les depenses
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="text" name="search" class="form-control form-control-sm" value="{{ $search }}" placeholder="Rechercher ici ">
			</form>
		</div>
	</div>
	
	<table class="table table-sm">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Action</th>
				<th scope="col">Momtant</th>
				<th scope="col">Date</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($depenses as $value)
			{{-- expr --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->name }}</td>
				<td>
					{{ $value->montant}}
				</td>

				<td>
					{{ $value->created_at}}
				</td>

			
				<td class="d-flex justify-content-around">
				
					<form class="form-delete" action="{{ route('depenses.destroy' , $value) }}" style="display: inline;" method="POST">
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
		{{ $depenses->links()}}
</div>


@endsection
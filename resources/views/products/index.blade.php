@extends('layouts.app')

@section('content')

<div>
	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">
			<a href="{{ route('products.create') }}" 
			class="btn btn-primary btn-sm">Ajouter</a>
			<h4 class="text-center">
				Liste des produits
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
				<th scope="col">CODE</th>
				<th scope="col">Designation</th>
				<th scope="col">Prix</th>
				<th scope="col">Qte</th>
				<th scope="col">Category</th>
				<th scope="col">Date d'expiration</th>
				<th scope="col">Date d'entre</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($products as $value)
			{{-- expr --}}
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->code_product }}</td>
				<td>
					{{ $value->name}}
				</td>

				<td>{{ $value->price }}</td>
				<td>{{ $value->quantite }}</td>

				<td><b>{{ $value->category->title }}</b></td>
				<td>{{ $value->date_expiration }}</td>
				<td>{{ $value->created_at }}</td>
				<td class="d-flex justify-content-around">
					<a href="{{ route('products.edit', $value) }}" class="btn btn-outline-info btn-sm mr-2">Modifier</a>



					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
						Ajouter
					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Ajouter <b> {{ $value->name }} </b></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>

					{{-- fin Modal --}}





















					<a href="{{ route('products.show', $value) }}" class="btn btn-outline-warning btn-sm mr-2">Afficher</a>
					<form class="form-delete" action="{{ route('products.destroy' , $value) }}" style="display: inline;" method="POST">
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
	{{ $products->links()}}
</div>


@endsection
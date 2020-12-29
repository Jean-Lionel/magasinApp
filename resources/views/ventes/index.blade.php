@extends('layouts.app')

@section('content')

<div>
	<div class="row">


		<div class="col-md-6 d-flex justify-content-between">

			<h4 class="text-center">
				Liste des produits
			</h4>
		</div>
		<div class="col-md-6">
			<form action="">
				<input type="search" name="search" value="{{    $search }}"  class="form-control form-control-sm" placeholder="Rechercher ici ">
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
				<th scope="col">Date d'expiration</th>
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
				<td>{{ $value->date_expiration }}</td>
				<td class="d-flex justify-content-around">
					
					<form action="{{ route('panier.store') }}" method="post">
						@csrf

						<input type="hidden" name="id" value="{{$value->id}}">

						<button  type="submit" class="btn btn-sm btn-primary">+ Ajouter aux pannier</button>
					</form>


				</td>
			</tr>
			@endforeach


		</tbody>
	</table>
	
</div>

<div class="col-md-12" style="height: 100px; overflow: hidden;">
	{{ $products->links()}}
</div>

@if (Cart::content()->count() > 0)
{{-- expr --}}

<div>
	<ul class="list-group">

		<div class="row">

			@foreach (Cart::content() as $product)
			{{-- expr --}}
			<div class="col-md-4">
				<li class="list-group-item m-2 d-flex justify-content-between align-items-center">
					{{ $product->name }}
					<span class="badge badge-primary badge-pill">{{getPrice( $product->model->price) }}</span>

					<form action="{{ route('cart.destroy',$product->rowId) }}" method="post">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                   </form>

				</li>
			</div>
			@endforeach


		</div>
	</ul> 
</div>
@endif



@endsection
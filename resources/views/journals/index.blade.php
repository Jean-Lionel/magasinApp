@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

<div class="row">
	
	<div class="col-md-6">
		<h5 class="text-center">Historique des ventes</h5>
		<div>
			<form action="" class="form-group row">
				<div class="col-sm-6">
					<label for="">TYPE DE PAIMENENT</label>
					
				</div>
				<div class="col-sm-6">
					<select class="form-control" name="type_paiement" id="">
						<option value="DETTE">DETTE</option>
						<option value="EN CACHE">EN CACHE</option>
					</select>
					
				</div>
				
			</form>
		</div>
		<table class="table table-sm ">
			<thead class="table-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">PRODUITS</th>
					<th scope="col">@sortablelink('montant','MONTANT')</th>
					<th scope="col">
						@sortablelink('type_paiement', 'MODE DE PAIMENT')
					</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>


				@foreach($orders as $key => $order)

				<tr>
					<th scope="row">{{ $order->id }}</th>

					<td>
						<ul class="">
							@foreach(unserialize($order->products) as $product)
							<li>{{ $product['name'] }} | Qte : {{ $product['quantite'] }} | 
							PRIX : {{ getPrice($product['price'] )}}</li>
							@endforeach

							<li class="text-center list-unstyled">{{ $order->created_at }}</li>

						</ul>
					</td>
					<td>{{ getPrice($order->amount )}}</td>
					<td>{{ $order->type_paiement ?? ""}}</td>
					<td class="d-flex">
						<a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-success mr-2" title="imprimer"> <i class="fa fa-print" ></i></a> 
						

						<form action="{{ route('orders.destroy', $order) }}" method="post">
							@method("DELETE")
							@csrf
							<button type="submit" onclick="return confirm('êtez-vous sûr d\'annuler la facture?')" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fa fa-minus" ></i> </button>
							
						</form>
					</td>
					
				</tr>

				@endforeach

			</tbody>
		</table>


	</div>
	<div class="col-md-6">
		<h5 class="text-center">Historique des entrées</h5>

		<table class="table table-sm table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">DESIGNATION</th>
					<th scope="col">QUANTITE</th>
					<th scope="col">PRIX</th>
					<th scope="col">DATE D'EXPIRATION</th>
					<th scope="col">DATE D'ENTRE</th>
				</tr>
			</thead>
			<tbody>


				@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->quantite }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->date_expiration }}</td>
					<td>{{ $product->created_at }}</td>
				</tr>

				@endforeach

			</tbody>
		</table>
		

	</div>
</div>



@stop
@extends('layouts.app')

{{-- Stocke Controller Journal --}}

@section('content')

<div class="row">
	
	<div class="col-md-6">
		<h5 class="text-center">Historique des ventes</h5>
		<table class="table table-sm table-info">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">PRODUITS</th>
					<th scope="col">MONTANT</th>
				</tr>
			</thead>
			<tbody>


				@foreach($orders as $key => $order)

				<tr>
					<th scope="row">{{ $order->id }}</th>

					<td>
						<ul>
							@foreach(unserialize($order->products) as $product)
							<li>{{ $product['name'] }} | Qte : {{ $product['quantite'] }} | 
							PRIX : {{ getPrice($product['price'] )}}</li>
							@endforeach

						</ul>
					</td>
					<td>{{ getPrice($order->amount )}}</td>
					
				</tr>

				@endforeach

			</tbody>
		</table>


	</div>
	<div class="col-md-6">
		<h5 class="text-center">Historique des entres</h5>

		<table class="table table-sm table-secondary">
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
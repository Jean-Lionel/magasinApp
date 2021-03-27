{{-- Checkout Methode paimenetDette 2020 CODE DECEMBRE --}}

@extends('layouts.app')

@section('content')

<div>
	<div>
		<h5 class="text-right">TOTAL DES DETTES : {{ getPrice($totalDette) }} #FBU</h5>
	</div>
	<table class="table table-secondary">
		<thead class="badge-dark">
			<tr>
				<th>#</th>
				<th>Nom du client</th>
				<th>@sortablelink('montant','Montant')</th>
				<th>@sortablelink('montant_restant','Montant Restant ')</th>
				<th>Facture Numéro</th>
				<th>@sortablelink('status','Status')</th>
				
				<th>Date de paiement</th>

				<th>@sortablelink('order_id','Date de Dette')</th>
				<th>Action</th>
			
			</tr>
			
		</thead>
		<tbody>
			@foreach($dettes as $dette)
			<tr>

				@if($dette->order)
				<td>{{ $dette->id ?? "" }}</td>
				<td>{{  collect(json_decode($dette->order->client))->get('name') ??"" }}</td>
				<td>{{ $dette->montant ?? ""}}</td>
				<td>{{ $dette->montant_restant ?? "" }}</td>
				<td>{{ $dette->order->id ?? ""}}</td>
				<td>{{ $dette->status ?? "" }}</td>
				<td>{{ $dette->created_at ?? ""}}</td>
				<td>{{ $dette->order->created_at ?? "" }}</td>
				<td>
					<a href="{{ route('paimenent_dette.create',  ['dette' =>$dette]) }}" class="btn btn-primary btn-sm">Paiment</a>
				</td>
				@endif
			</tr>

			@endforeach

			
		</tbody>
		
	</table>

	
</div>


@stop
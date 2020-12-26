@extends('layouts.app')

@section('content')

<div>
	<div class="row">
		
		<div class="col-md-8">
			<form action="">
				<div class="row">
					<div class="co-md-4">
					
						<input required="" type="date" value="{{ $s_date ??"" }}" id="s_date" name="s_date" class="form-control form-inline">
						
					</div>
					<div class="col-md-1">AU</div>
					<div class="co-md-4 ml-1">
						<input required="" type="date" value="{{ $e_date ?? "" }}" name="e_date" class="form-control">
					</div>

					<div class="col-md-4">
						<select name="action" id="action">
						<option value="ENTRE" {{ $action == 'ENTRE' ? 'selected' : ''  }}>ENTRE</option>
							<option value="VENTE" {{ $action == 'VENTE' ? 'selected' : ''  }}>VENTE</option>
						</select>
					</div>

					<div class="col-md-1">
						<button type="submit" class="btn btn-primary">OK</button>
					</div>
				</div>

				
			</form>
			
		</div>

		<div class="col-md-6">
			
		</div>

		<div class="col-md-12">
			
			<table class="table table-sm table-striped">
				<thead>
					<tr>
						<th rowspan="2">Dates</th>
						<th rowspan="2">Produit</th>
						<th colspan="3">Entre en stock</th>
						<th colspan="3">Stock Final</th>
					</tr>
					<tr>
						@if($action === 'ENTRE')
							<th colspan="2">Qté Entre</th>
						@else
							<th colspan="2">Qté Vendue</th>
						@endif
						
						<th>Qté Initial</th>
						
					</tr>
				</thead>

				<tbody>

					@foreach($products as $val)
					@php
						$product = json_decode($val->details, true)
					@endphp

					<tr>
						<td>{{ $val->created_at }}</td>
						<td>{{ $product['name'] }}</td>
						<td colspan="2">{{ $val->quantite ?? ""}}</td>
						<td>{{ $product['quantite'] }}</td>

						@if($action === 'ENTRE')
						<td>{{ $product['quantite'] + $val->quantite }}</td>
						@else
						<td>{{ abs($product['quantite'] - $val->quantite) }}</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection
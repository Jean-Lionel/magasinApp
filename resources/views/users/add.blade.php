@extends('layouts.app')

@section('content')

<div >
	<div class="card">
		<div class="card-title text-center">{{ $product->name }}</div>

		<div class="card-body">
			<form action="{{ route('add_quantite_stock') }}" method="post">
				
				@csrf
				@method('POST')

				<input type="hidden" name="product_id"  value="{{ $product->id }}">

				<!-- Large input -->
				<div class="row">
					<div class="col-md-3">
						<label for="quantite">QUANTITE</label>
					</div>
					<div class="col-md-3">
						<input required="" name="quantite" class="form-control form-control-sm" type="number" value="{{ old('quantite') }}"  placeholder="Exemple : 4">
						{!! $errors->first('quantite', '<small class="help-block invalid-feedback">:message</small>') !!}
					</div>
					<div class="col-md-3 d-flex">
						<input type="submit" value="Ajouter" class="btn-sm btn-info">
						<a href="{{ route('products.index') }}" class="btn-sm btn-dark ml-3">retour</a>
					</div>
					<div class="col-md-3"></div>
				</div>

			</form>
		</div>
	</div>
</div>


@stop
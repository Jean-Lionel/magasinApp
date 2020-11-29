@csrf

<div class="row">

	<div class="col-md-12">
		<h5 class="text-left">Nouveau Produit</h5>
	</div>


	<div class="col-md-3">
		<div class="form-group">
			<label for="code_product">CODE DE PRODUIT</label>
			<input type="text" class="form-control {{$errors->has('code_product') ? 'is-invalid' : 'is-valid' }}" id="code_product" name="code_product" value="{{ old('code_product') ?? $product->code_product?? ' ' }}">

			{!! $errors->first('code_product', '<small class="help-block invalid-feedback">:message</small>') !!}

		</div>

	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label for="name">DESIGNATION</label>
			<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ old('name') ?? $product->name?? ' ' }}">

			{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</div>

	</div>
	<div class="col-md-3">
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="price">PRIX UNITAIRE</label>
				<input type="number" class="form-control {{$errors->has('price') ? 'is-invalid' : 'is-valid' }}" id="price" name="price" value="{{ old('price') ?? $product->price?? ' ' }}">

				{!! $errors->first('price', '<small class="help-block invalid-feedback">:message</small>') !!}

			</div>
		</div>

	</div>

	

	<div class="col-md-3">
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="date_expiration">DATE D'EXPIRATION</label>
				<input type="date" class="form-control {{$errors->has('date_expiration') ? 'is-invalid' : 'is-valid' }}" id="date_expiration" name="date_expiration" value="{{ old('date_expiration') ?? $product->date_expiration?? ' ' }}">

				{!! $errors->first('date_expiration', '<small class="help-block invalid-feedback">:message</small>') !!}

			</div>
		</div>
		

	</div>


	<div class="col-md-3">
		
		<div class="form-group">
			<label for="category_id">CATEGORIE</label>
			<select name="category_id" id="" class="form-control {{$errors->has('category_id') ? 'is-invalid' : 'is-valid' }}">

				<option value="{{ $product->category_id ??""  }}">
					
					{{ $product->category->title ?? "" }}
				</option>
				
				@foreach ($categories as $element)
					{{-- expr --}}
					<option value="{{$element->id}}">{{$element->title}}</option>
				@endforeach
			</select>
			{!! $errors->first('category_id', '<small class="help-block invalid-feedback">:message</small>') !!}

		</div>
		

	</div>

	<div class="col-md-3">
		
		<div class="form-group">
			<label for="quantite">QUANTITE</label>
			<input type="number" class="form-control {{$errors->has('quantite') ? 'is-invalid' : 'is-valid' }}" id="quantite" name="quantite" value="{{ old('quantite') ?? $product->quantite?? ' ' }}">

			{!! $errors->first('quantite', '<small class="help-block invalid-feedback">:message</small>') !!}

		</div>
		

	</div>
	
	<div class="col-md-3">
		
		<div class="form-group">
			<label for=""></label>
			<input type="submit" value="{{ $btnMessage ?? 'Enregitre' }}" class="form-control btn-primary">
		</div>

	</div>

	<div class="col-md-3">
		
		<div class="form-group">
			<label for=""></label>
			<input type="reset" value="Annuler" class="form-control btn-warning">
		</div>

	</div>




</div>


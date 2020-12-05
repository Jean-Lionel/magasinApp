@csrf

<div class="row">

	<div class="col-md-12">
		<h5 class="text-left">Nouveau Produit</h5>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="name">ACTION</label>
			<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ old('name') ?? $depense->name?? ' ' }}">

			{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</div>

	</div>
	<div class="col-md-4">
		
		
			<div class="form-group">
				<label for="montant">MONTANT</label>
				<input type="number" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant" name="montant" value="{{ old('montant') ?? $depense->montant?? ' ' }}">

				{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}

			</div>
		

	</div>

	<div class="col-md-8">
		<textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
	</div>

	

	<div class="col-md-3 offset-2">
		
		<div class="form-group">
			<label for=""></label>
			<input type="reset" value="Annuler" class="form-control btn-warning">
		</div>

	</div>

	<div class="col-md-3">
		
		<div class="form-group">
			<label for=""></label>
			<input type="submit" value="{{ $btnMessage  }}" class="form-control btn-primary">
		</div>

	</div>




</div>


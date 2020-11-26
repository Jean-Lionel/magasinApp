@csrf

<div class="row">

	<div class="card">
		<div class="card-body">

			<div class="col-md-12">
				<h5 class="text-left">Client</h5>
			</div>
			{{
				
			}}

			<div class="col-md-12">
				<div class="form-group">
					<label for="first_name">NOM</label>
					<input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : 'is-valid' }}" id="first_name" name="first_name" value="{{ old('first_name') ?? $client->first_name?? ' ' }}">

					{!! $errors->first('first_name', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="telephone">TELEPHONE</label>
					<input type="text" class="form-control {{$errors->has('telephone') ? 'is-invalid' : 'is-valid' }}" id="telephone" name="telephone" value="{{ old('telephone') ?? $client->telephone?? ' ' }}">

					{!! $errors->first('telephone', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description">Description</label>
					

					<textarea class="form-control"  row="15" {{$errors->has('description') ? 'is-invalid' : 'is-valid'}} name="description">{{ old('description') ?? $client->description?? ' ' }}
					</textarea>

					{!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
			</div>

			<div class="col-md-12">
				<input type="submit" value="{{ $btnMessage ?? 'Enregitre' }}" class="form-control btn-primary">
			</div>

		</div>
	</div>


</div>


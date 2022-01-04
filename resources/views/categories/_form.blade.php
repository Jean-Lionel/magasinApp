@csrf

<div class="row">

	<div class="card">
		<div class="card-body">

			<div class="col-md-12">
				<h5 class="text-left">Nouveau categorie</h5>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : 'is-valid' }}" id="title" name="title" value="{{ old('title') ?? $category->title?? ' ' }}">

					{!! $errors->first('title', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
			</div>


			<div class="col-md-12">
				<div class="form-group">
					<label for="title">STOCK</label>

					<select name="stock_id" id="" class="form-control {{$errors->has('stock_id') ? 'is-invalid' : 'is-valid' }}">
						
						@foreach ($stockes as $element)
							{{-- expr --}}
							<option value="">---choisissez le stock</option>
							<option value="{{ $element->id }}">{{ $element->name }}</option>
						@endforeach
					</select>

					{!! $errors->first('stock_id', '<small class="help-block invalid-feedback">:message</small>') !!}




					{{-- <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : 'is-valid' }}" id="title" name="title" value="{{ old('title') ?? $category->title?? ' ' }}">
 --}}
					
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description">Description</label>
					

					<textarea class="form-control"  row="15" {{$errors->has('description') ? 'is-invalid' : 'is-valid'}} name="description">{{ old('description') ?? $category->description?? ' ' }}
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


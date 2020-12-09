@csrf

<div class="row">
	<div class="col-md-6 offset-3">
		
		<div class="card">
			<h5 class="text-center card-header">Nouveau utilisateur</h5>
			<div class="card-body">
				<div class="form-group">
					<label for="name">Name</label>
					<input required="" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ old('name') ?? $user->name?? ' ' }}">

					{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input required="" type="text" class="form-control {{$errors->has('email') ? 'is-invalid' : 'is-valid' }}" id="email" name="email" value="{{ old('email') ?? $user->email?? ' ' }}">

					{!! $errors->first('email', '<small class="help-block invalid-feedback">:message</small>') !!}
				</div>


				<div class="form-group">
					<label for="password">Password</label>
					<input  type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : 'is-valid' }}" id="password" name="password" value="">

					{!! $errors->first('password', '<small class="help-block invalid-feedback">:message</small>') !!}
				</div>

				<div class="form-group">
					<input type="submit" value="Enregistrer" class="btn btn-danger">
				</div>

			</div>
		</div>

	</div>


</div>


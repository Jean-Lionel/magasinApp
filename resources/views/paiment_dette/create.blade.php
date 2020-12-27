@extends('layouts.app')

@section('content')



{{-- @dump($dette)
	--}}
	<div class="card">
		<div class="card-header">

			@php
			$date = collect(json_decode($dette->order->client))->get('created_at');
			@endphp
			<h4 class="text-center">Remboursemment du dette du 
				{{ date_format(date_create($date), 'd-M-Y')
			}}</h4>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					NOM DU CLIENT : <b>{{ collect(json_decode($dette->order->client))->get('name') }}</b>

				</div>
				<div class="col-md-8">
					<form action="{{ route('paimenent_dette.store') }}" method="post" class="form">
						@csrf
						@method('post')

						<input type="hidden" name="montant_restant" value="{{ $dette->montant_restant }}">
						<input type="hidden" name="dette_id" value="{{ $dette->id }}"> 
						<div class="form-group row">
							<div class="col-sm-2"><label for="montant">Montant</label></div>
							<div class="col-sm-6">
								<input type="number" required="" name="montant" value="{{ old('montant') }}" class="form-control">
								

								<p class="mt-3">
									@if($errors->first('montant'))
									<span class="alert-danger alert">{!! $errors->first('montant') !!}</span>

									@endif
								</p>
							</div>
							<div class="col-sm-2"><input type="submit" value="Enregistrer"  class="form-control btn btn-primary"></div>
							
						</div>
					</form>

				</div>
			</div>

		</div>
	</div>
	@stop
<div>
    {{-- The whole world belongs to you --}}

    <div class="row">
    	<div class="col-md-3">
    		<div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    		<form action="" wire:submit.prevent="saveService">
    			<div class="form-group">
    				<label for="">TYPE DE SERVICE</label>
    				<select wire:model="type" name="" id="" class="form-control">
    				<option value="">Select ...</option>
    				<option value="IMPRESSION" id="">IMPRESSION</option>
    				<option value="DISIGN" id="">DISIGN</option>
    				<option value="AUTRES" id="">AUTRES</option>
    				</select>
    				
    			</div>

                @if($type == 'AUTRES')
                <div class="form-group">
                    <label for="">DESCRIPTION</label>
                    <input class="form-control" type="text" wire:model="description">
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                @endif
    			<div class="form-group">
    				<label for="">MONTANT</label>
    				<input class="form-control" type="number" wire:model="montant">
    				@error('montant')
    				<p class="text-danger">{{ $message }}</p>
    				@enderror
    			</div>
    			<div class="form-group">
    				<label for="">QUANTITE</label>
    				<input class="form-control" type="number" wire:model="quantite">
    				@error('quantite')
    				<p class="text-danger">{{ $message }}</p>

    				@enderror
    			</div>

    			<div class="form-group">
    				<h5>TOTAL : {{ getPrice($this->total) }} #FBU</h5>
    			</div>

    			<div class="form-group mt-2">
    				<button type="submit" class="btn btn-block btn-info">Valider</button>
    			</div>
    		</form>
    		
    	</div>
    	<div class="col-md-8">
    		<table class="table table-sm"> 
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>TYPE DE SERVICE</th>
    					<th>MONTANT</th>
    					<th>QUANTITE</th>
    					<th>TOTAL</th>
    					<th>Date</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($services as $key => $service)
    				<tr>
    					<td>{{ ++ $key }}</td>
    					<td>{{ $service->type }}</td>
    					<td>{{ $service->montant }}</td>
    					<td>{{ $service->quantite }}</td>
    					<td>{{ getPrice($service->quantite * $service->montant) }}</td>
    					<td>{{ $service->created_at }}</td>
    					
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
    		
    	</div>
    </div>
</div>

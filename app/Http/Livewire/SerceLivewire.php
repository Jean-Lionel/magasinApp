<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class SerceLivewire extends Component
{
	public $type;
	public $montant;
	public $quantite;
	public $description;
	public $identification;
	


    public function render()
    {
    	$services = Service::latest()->paginate();
        return view('livewire.serce-livewire',[
        	'services' => $services
        ]);
    }

    protected $rules = [
    	'type' => 'required',
    	'montant' => 'required|numeric|min:0',
    	'quantite' => 'required|numeric|min:0'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveService(){
    	$this->validate();
    	$data = [
    		'type' => $this->type,
	    	'montant' => $this->montant,
	    	'quantite' => $this->quantite,
	    	'description' => $this->description,
    	];

    	if($this->identification)
    	{
    		Service::find($this->identification)->update($data);
    		session()->flash('message', 'Opération réussi');
    		$this->reset();

    	}else{
    		Service::create($data);
    		$this->reset();
    		session()->flash('message', 'Opération réussi');

    	}


    }

    public function modifierService($id)
    {
    	$service = Service::find($id);
    	$this->identification = $service->id;
    	$this->type = $service->type;
		$this->montant = $service->montant;
		$this->quantite = $service->quantite;
    }

    public function getTotalProperty()
    {
        return floatval($this->montant) * floatval($this->quantite);
    }
}

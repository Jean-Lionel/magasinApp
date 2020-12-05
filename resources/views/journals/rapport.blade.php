@extends('layouts.app')

{{-- StockController Rapport  --}}


@section('content')

<div>

	<div class="row">
		<div class="col-md-4">

			<div class="card border-dark">
				<div class="card card-header">
					<h5 class="text-center">Vente du : {{ \Carbon\Carbon::now()->format('Y-m-d') }}</h5>
				</div>

				<div class="card card-body">
					<h4 class="text-center"># {{ getPrice( $venteJournaliere) }} FBU</h4>
				</div>

			</div>
		</div>

		<div class="col-md-4">

			<div class="card border-info">
				<div class="card card-header">
					<form action="{{ route('rapport') }}" class="form">
						
						<div class="row">
							<div class="col-md-8">
								<input type="date"  value="{{ $date_recherche }}" name="date_recherche" class="form-control">
							</div>
							<div class="col-md-2">
								<input type="submit" value="OK" class="btn btn-sm btn-warning">
							</div>
						</div>
					</form>
				</div>

				<div class="card card-body">
					<h4 class="text-center"># {{ getPrice( $vente_date) }} FBU</h4>
				</div>

			</div>
		</div>



		<div class="col-md-4">

			<div class="card border-danger">
				<div class="card card-header">
					<h5 class="text-center">Total du montant du caisse</h5>
				</div>

				<div class="card card-body">
					<h4 class="text-center"># {{ getPrice( $montant_total) }} FBU</h4>
				</div>

			</div>
		</div>


	</div>

	<div class="row">
		<div class="col-md-6">

			<div style="width:100%;">
				<h5>Les 10 premiers produits les plus vendus</h5>
				<canvas id="myChart"></canvas>
			</div>
			
		</div>
		<div class="col-md-6">
			
			<div style="width:100%;">
				<h5>Top 10 des quantités</h5>
				<canvas id="chart2"></canvas>
			</div>
			
			
			
		</div>
		<div class="col-md-4">
			CHART 3
		</div>


	</div>

</div>


@stop


@section('javascript')

<script>

	const Charts = ["line","bar","pie","pie","bar"];

	const random = Math.floor(Math.random() * Charts.length );
	const random2 = Math.floor(Math.random() * Charts.length );

	

	var ctx = document.getElementById('myChart').getContext('2d');
	var chart2 = document.getElementById('chart2').getContext('2d');

	let labels = '{{ $labels }}';

	var myChart = new Chart(ctx, {
		type: Charts[random],
		data: {
			labels:  labels.split(','),
			datasets: [{
				label: "# NOMBRE D'ACHAT : ",
				data: [{{ $data['nombre_vendu'] }} ],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				fill: true,
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)',
				'rgba(255, 15, 64, 1)',
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});


	var myChart2 = new Chart(chart2, {
		type: Charts[random2],
		data: {
			labels:  labels.split(','),
			datasets: [{
				label: '# QUANTITE VENDU',
				data: [{{ $data['quantite'] }} ],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				fill: true,
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)',
				'rgba(255, 15, 64, 1)',
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});


</script>


@stop
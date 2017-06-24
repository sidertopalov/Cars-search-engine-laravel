@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Single Car view</h2>
</div>
<hr>
@endsection

@section('content')

<div class="row">
	<div class="col-md-3">
	    
	</div>

	<div class="col-md-6 text-center">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Image</th>
					<th>Car Info</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>
						<img class="rounded-circle" src="{{ asset($car->car_photo_dir) }}" alt="Generic placeholder image" width="200" height="160">
					</td>
					<td class="text-left">
						<div style="color:blue;">
							<b>{{ $car->car_brand }}<b>
						</div>
						<div style="color:blue;">
							<b>{{ $car->car_model }}</b>
						</div>
						<div style="color:blue;">
							<b>{{ $car->car_engine }}</b>
						</div>
						<div style="color:blue;">
							<b>{{ $car->car_color }}</b>
						</div>
						<div style="color:green;"> 
							<b>{{ $car->car_price }},00 BGN</b>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-md-3">
	    
	</div>
</div>

@endsection
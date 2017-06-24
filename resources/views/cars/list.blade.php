@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>List of Cars</h2>
</div>
<hr>
@endsection

@section('content')

<div class="row">
	<div class="col-md-2">
	    
	</div>

	<div class="col-md-8">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@elseif (session('error'))
			<div class="alert alert-warning">
				{{ session('error') }}
			</div>
		@endif

		<div class="text-center">{{ $cars->links() }}</div>
		@if ( count($cars) > 0 )
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Image</th>
						<th>Car Info</th>
						<!-- <th>Brand</th>
						<th>Model</th>
						<th>Engine</th>
						<th>Color</th>
						<th>Price</th> -->
						@if(Auth::check())
							@if(Auth::user()->isAdmin)
								<th>Actions</th>
							@endif
						@endif
					</tr>
				</thead>

				<tbody>
					@foreach ($cars as $car)
						<tr>
							<td>
								<img class="rounded-circle" src="{{ asset($car->car_photo_dir) }}" alt="Generic placeholder image" width="200" height="160">
							</td>
							<td>
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
							<!-- <td>{{ $car->car_brand }}</td>
							<td>{{ $car->car_model }}</td>
							<td>{{ $car->car_engine }}</td>
							<td>{{ $car->car_color }}</td>
							<td>{{ $car->car_price }}</td> -->
							@if(Auth::check())
								<td>
									@if(Auth::user()->isAdmin)
										<a class="btn btn-default" href="/cars/{{ $car->id_car }}">View</a> 
										<a class="btn btn-success" href="/cars/{{ $car->id_car }}/edit">Edit</a> 
										<form  action="/cars/{{ $car->id_car }}" style="display:inline-table;" method="POST">
											{{csrf_field()}}
											{{ method_field('DELETE') }}
											<input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?') "> 
										</form>
									@else
										<a class="btn btn-default" href="/cars/{{ $car->id_car }}">View</a> 
									@endif
								</td>
							@else
								<td>
									<a class="btn btn-default" href="/cars/{{ $car->id_car }}">View</a> 
								</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>No records</p>
		@endif
		<div class="text-center">{{ $cars->links() }}</div>
	</div>

	<div class="col-md-2">
	    
	</div>
</div>

@endsection
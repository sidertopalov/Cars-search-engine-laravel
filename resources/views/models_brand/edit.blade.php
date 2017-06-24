@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Edit Model</h2>
</div>
<hr>
@endsection


@section('content')

<div class="row">
	<div class="col-md-4">
	    
	</div>

	<div class="col-md-4">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
		
		<form class="form-horizontal" method="post" action="/models/{{$model->model}}">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
			<div class="form-group">
				<label for="oldBrand">Brand name:</label>
				<input type="text" class="form-control" name="oldBrand" id="oldBrand" value="{{$model->brand}}" readonly>
			</div>
			<div class="form-group">
				<label for="oldModel">Old Model name:</label>
				<input type="text" class="form-control" name="oldModel" id="oldModel" value="{{$model->model}}" readonly>
			</div>

			<div class="form-group">
				<label for="newBrand">New Model name:</label>
				<input type="text" class="form-control" name="newModel" id="newModel" placeholder="Enter brand" required>
			</div>
			<div class="form-group"> 
				<div>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-4">
	    
	</div>
</div>

@endsection
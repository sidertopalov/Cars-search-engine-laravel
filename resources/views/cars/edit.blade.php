@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Edit Car</h2>
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
		
		<form class="form-horizontal" method="post" action="/cars/{{$car->id_car}}" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}

			<div class="form-group text-center">
				<img class="rounded-circle" src="{{ asset($car->car_photo_dir) }}" alt="Generic placeholder image" width="200" height="160">
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="brand">Brands:</label>
				<div class="col-sm-10">
					<select id="brand" name="brand" class="form-control">
						@foreach($brands as $brand)
							@if($brand->brand == $car->car_brand)
								<option value="{{ $brand->brand}}" selected>{{ $brand->brand }}</option>
							@else 
								<option value="{{ $brand->brand}}">{{ $brand->brand }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="model">Models:</label>
				<div class="col-sm-10">
					<select id="model" name="model" class="form-control">
						@foreach($models as $model)
							@if($model->model == $car->car_model)
								<option value="{{ $model->model}}" class="{{ $model->brand }}" selected>{{ $model->model }}</option>
							@else 
								<option value="{{ $brand->brand}}">{{ $brand->brand }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="engine">Engine:</label>
				<div class="col-sm-10">
					<select id="engine" name="engine" class="form-control">
						@foreach($engines as $engine)
							@if($engine->engines == $car->car_engine)
								<option value="{{ $engine->engines}}" selected>{{ $engine->engines }}</option>
							@else 
								<option value="{{ $engine->engines}}">{{ $engine->engines }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="color">Color:</label>
				<div class="col-sm-10">
					<select id="color" name="color" class="form-control">
						@foreach($colors as $color)
							@if($color->color == $car->car_color)
								<option value="{{ $color->color}}" selected>{{ $color->color }}</option>
							@else 
								<option value="{{ $color->color}}">{{ $color->color }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="price">Price:</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="price" id="price" placeholder="Enter price.." min="1" value="{{ $car->car_price }}" required>
				</div>
			</div>

			 <div class="form-group">
            	<label class="control-label col-sm-2" for="image">Browse:</label>
                <div class="col-md-6">
               	    <input id="image" type="file" name="image" accept="image/*">
                </div>
            </div>

			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-4">
	    
	</div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('js/jquery.chained.min.js') }}"></script>
<script type="text/javascript">
	$("#model").chained("#brand");
</script>
@endsection
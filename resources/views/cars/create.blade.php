@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Create new Car</h2>
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
		
		<form class="form-horizontal" method="post" action="/cars" enctype="multipart/form-data">
			{{ csrf_field() }}
			<!-- <div>{{ old('brand') }}</div> -->
			<div class="form-group">
				<label class="control-label col-sm-2" for="brand">Brands:</label>
				<div class="col-sm-10">
					<select id="brand" name="brand" class="form-control">
						<option value="">-избери-</option>
						@foreach($brands as $brand)
							@if ( old('brand') == $brand->brand)
								<option value="{{ $brand->brand }}" selected>{{ $brand->brand }}</option>
							@else
								<option value="{{ $brand->brand }}" >{{ $brand->brand }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="model">Models:</label>
				<div class="col-sm-10">
					<select id="model" name="model" class="form-control">
						<option value="">-избери-</option>
						@foreach($models as $model)
							@if ( old('model') == $model->model)
								<option value="{{ $model->model}}" class="{{ $model->brand }}" selected>{{ $model->model }}</option>
							@else 
								<option value="{{ $model->model}}" class="{{ $model->brand }}" >{{ $model->model }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="engine">Engine:</label>
				<div class="col-sm-10">
					<select id="engine" name="engine" class="form-control">
						<option value="">-избери-</option>
						@foreach($engines as $engine)
							@if ( old('engine') == $engine->engines)
								<option value="{{ $engine->engines}}" selected="">{{ $engine->engines }}</option>
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
						<option value="">-избери-</option>
						@foreach($colors as $color)
							@if ( old('color') == $color->color)
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
					<input type="number" class="form-control" name="price" id="price" placeholder="Enter price.." min="1" value="1" required>
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

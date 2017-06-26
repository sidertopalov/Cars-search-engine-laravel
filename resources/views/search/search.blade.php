@extends('layouts.app')

@section('css')
<!-- JqueryUI -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<!-- Awesome font icons -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
<!-- Main style -->
<link  rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection

@section('title')
<div class="text-center">
	<h2>Search</h2>
</div>
<hr>
@endsection

@section('content')
<div id="wrap" class="color1-inher">
	<div class="search-1 m-t-sm-40">
		<div class="container">
			<div class="col-xs-12 col-md-1">
									
			</div>

			<div class="col-xs-12 col-md-10">
				<div class="row">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
							</ul>
						</div>
					@endif
						<div class="row">
							<div class="bg-primary text-white col-xs-7 col-sm-6 col-md-5 text-center">
								<div class="fs-21 text-left"><span class="fa fa-search" aria-hidden="true"></span>Търсене на автомобили</div>
							</div>
							
							<div class="col-xs-3 col-sm-5 col-md-6">
								
							</div>

							<div class="bg-success text-white col-xs-2 col-sm-1 col-md-1 text-center">
								<div class="fs-21 text-center" id="carsCount">
									{{ $carsCount }}
								</div>
							</div>

						</div>
				</div>

				<form id="formSearch" name="formSearch" method="post" action="/cars/search">
				{{ csrf_field() }}
				
					<div class="search-option">
						<div class="row">
							<div class="row">
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label class="fs-12" for="brand">Марка:</label>
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

								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label class="fs-12" for="model">Модел:</label>
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

								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label class="fs-12" for="range_input">Ценови диапазон</label>
											<div class="test" name="test" id="test"></div>
											<input type="hidden" id="price" name="price">
											<input name="range_price" id="range_input" type="text" class="slider_amount" readonly>
											<div name="range_div" id="range_div" class="slider-range"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-md-4">

									<div class="form-group">
										<label class="fs-12" for="engine">Двигател:</label>
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

								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label class="fs-12" for="color">Цвят:</label>
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

								<div class="col-xs-12 col-md-4">
									<div class="form-group" style="padding-top: 24px;">
										<button type="submit" class="btn btn-default" id="btn" style="display: inline-block; width: 100%">Стартирай търсене</button>
									</div>
								</div>
							</div>
						</div>

					</div>
				</form>
			</div>

		</div>

		<div class="col-xm-12 col-md-1">
									
		</div>

	</div>
</div>
@endsection

@section('javascript')
<!-- jQuery -->
<script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
<!-- JqueryUI -->
<script src="{{ asset('js/jquery-ui.js') }}"></script>

<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery.chained.min.js') }}"></script>

<script type="text/javascript">
	$("#model").chained("#brand");
</script>
@endsection
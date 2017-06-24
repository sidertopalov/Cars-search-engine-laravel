@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Color template</h2>
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
		
		<form class="form-horizontal" method="post" action="/colors">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-2" for="color">Color:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="color" id="color" placeholder="Enter color name.." required>
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
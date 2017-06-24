@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Create new Engine</h2>
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
		
		<form class="form-horizontal" method="post" action="/engines">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-2" for="engine">Engine:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="engine" id="engine" placeholder="Enter engine name..." required>
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
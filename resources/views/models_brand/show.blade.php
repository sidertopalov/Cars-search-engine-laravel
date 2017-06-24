@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>Model View</h2>
</div>
<hr>
@endsection

@section('content')

<div class="row">
	<div class="col-md-4">
	    
	</div>

	<div class="col-md-4 text-center">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="text-center">Brand</th>
					<th class="text-center">Model</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>{{ $model->brand }}</td>
					<td>{{ $model->model }}</td>					
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-md-4">
	    
	</div>
</div>

@endsection
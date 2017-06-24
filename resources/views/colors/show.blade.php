@extends('layouts.app')

@section('title')
<div class="text-center">
	<h2>View Color</h2>
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
					<th class="text-center">Color Name</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>{{ $color->color }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-md-4">
	    
	</div>
</div>

@endsection
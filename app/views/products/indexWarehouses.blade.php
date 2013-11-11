@extends('layouts.master')

@section('content')

<div class="col-md-12" style="margin-top: 20px">
	<h4 style="margin-top: 40px">Products :: {{ $product->name }} [Warehouses]</h4>
	{{ link_to_route('stockmoves.create', 'Add new Stock Movement', null, array('class' => 'btn btn-primary')) }}
</div>

@if($warehouses->count())
	<div class="col-md-8" style="margin-top: 15px;">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Warehouse</th>
					<th>Stock</th>
					<th>Movements</th>
				</tr>
			</thead>
			<tbody>
				@foreach($warehouses as $warehouse)
				<tr>
					<td>{{ $warehouse->name }}</td>
					<td>{{ $warehouse->pivot->quantity }}</td>
					<td> </td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@else
	<div class="alert alert-info col-md-2" style="margin-top: 15px;"><strong>No Warehouses</strong> for this Produt.</div>
@endif

@stop
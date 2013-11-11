@extends('layouts.master')

@section('content')

<div class="col-md-12" style="margin-top: 20px">
	<h4 style="margin-top: 40px">Warehouses :: {{ $warehouse->name }} [Products]</h4>
	{{ link_to_route('stockmoves.create', 'Add new Stock Movement', null, array('class' => 'btn btn-primary')) }}
</div>

@if($products->count())
	<div class="col-md-8" style="margin-top: 15px;">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Product</th>
					<th>Cost Price</th>
					<th>Stock</th>
					<th>Stock total</th>
					<th>Activo</th>
					<th>Movements</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{ $product->name }}</td>
					<td>{{ $product->price_cost }}</td>
					<td>{{ $product->pivot->quantity }}</td>
					<td>{{ $product->quantity_total }}</td>
					<td>{{ $product->active }}</td>
					<td> </td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@else
	<div class="alert alert-info col-md-2" style="margin-top: 15px;"><strong>No Produts</strong> in this Warehouse.</div>
@endif

@stop
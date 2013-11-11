@extends('layouts.master')

@section('content')

<div class="col-md-12" style="margin-top: 20px">
	<h4 style="margin-top: 40px">Products</h4>
	{{ link_to_route('products.create', 'Add new Product', null, array('class' => 'btn btn-primary')) }}
</div>

@if($products->count())
	<div class="col-md-8" style="margin-top: 15px;">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Product</th>
					<th>Cost Price</th>
					<th>Stock</th>
					<th>Activo</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Warehouses</th>
					<th>Movements</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{ $product->name }}</td>
					<td>{{ $product->price_cost }}</td>
					<td>{{ $product->quantity_total }}</td>
					<td>{{ $product->active }}</td>
					<td>{{ link_to_route('products.edit', 'Edit', array($product->id), array('class' => 'btn btn-warning')) }}</td>
					<td>
							{{ Form::open(array('method' => 'DELETE', 'route' => array('products.destroy', $product->id))) }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
							{{ Form::close() }}
					</td>
					<td>{{ link_to_action('ProductsController@indexWarehouses', 'Warehouses', array($product->id), array('class' => 'btn btn-success')) }}</td>
					<td>{{ link_to_action('ProductsController@indexStockmoves', 'Movements' , array($product->id), array('class' => 'btn btn-info')) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@else
	<div class="alert alert-info col-md-2" style="margin-top: 15px;"><strong>No Products</strong> available.</div>
@endif

@stop
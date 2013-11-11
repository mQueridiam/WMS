@extends('layouts.master')

@section('content')

<div class="col-md-12" style="margin-top: 20px">
	<h4 style="margin-top: 40px">Warehouses</h4>
	{{ link_to_route('warehouses.create', 'Add new Warehouse', null, array('class' => 'btn btn-primary')) }}
</div>

@if($warehouses->count())
	<div class="col-md-8" style="margin-top: 15px;">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>WareHouse</th>
					<th>Created</th>
					<th>Updated</th>
					<th>Edit</th>
					<th>Delete</th>
					<th>Products</th>
					<th>Movements</th>
				</tr>
			</thead>
			<tbody>
				@foreach($warehouses as $wh)
				<tr>
					<td>{{ $wh->name }}</td>
					<td>{{ $wh->created_at }}</td>
					<td>{{ $wh->updated_at }}</td>
					<td>{{ link_to_route('warehouses.edit', 'Edit', array($wh->id), array('class' => 'btn btn-warning')) }}</td>
					<td>
							{{ Form::open(array('method' => 'DELETE', 'route' => array('warehouses.destroy', $wh->id))) }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
							{{ Form::close() }}
					</td>
					<td>{{ link_to_action('WarehousesController@indexProducts'  , 'Products' , array($wh->id), array('class' => 'btn btn-success')) }}</td>
					<td>{{ link_to_action('WarehousesController@indexStockmoves', 'Movements', array($wh->id), array('class' => 'btn btn-info')) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@else
	<div class="alert alert-info col-md-2" style="margin-top: 15px;"><strong>No Warehouses</strong> available.</div>
@endif

@stop
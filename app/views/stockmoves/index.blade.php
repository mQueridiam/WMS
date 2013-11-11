@extends('layouts.master')

@section('content')

<div class="col-md-12" style="margin-top: 20px">
	<h4 style="margin-top: 40px">All Stock Movements</h4>
	{{ link_to_route('stockmoves.create', 'Add new Stock Movement', null, array('class' => 'btn btn-primary')) }}
</div>

@if ($stockmoves->count())
	<div class="col-md-8" style="margin-top: 15px;">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Date</th>
				<th>Warehouse</th>
				<th>Product</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Document</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($stockmoves as $stockmove)
				<tr>
					<td>{{{ $stockmove->date }}}</td>
					<td>{{{ $stockmove->warehouse_id }}}</td>
					<td>{{{ $stockmove->product_id }}}</td>
					<td>{{{ $stockmove->price }}}</td>
					<td>{{{ $stockmove->quantity }}}</td>
					<td>{{{ $stockmove->document }}}</td>
                    <td>{{ link_to_route('stockmoves.edit', 'Edit', array($stockmove->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('stockmoves.destroy', $stockmove->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	</div>
@else
	<div class="alert alert-info col-md-2" style="margin-top: 15px;"><strong>There are no Stock Movements</strong> available.</div>
@endif

@stop

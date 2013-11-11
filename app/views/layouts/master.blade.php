<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title></title>
	{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css') }}
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{{ link_to('/', '_WMS_', array('class' => 'navbar-brand')) }}
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>{{ link_to_route('warehouses.index', 'Warehouses'     ) }}</li>
				<li>{{ link_to_route('products.index'  , 'Products'       ) }}</li>
				<li>{{ link_to_route('stockmoves.index', 'Stock Movements') }}</li>
			</ul>
		</div>
	</div>
</div>
<divclass="row">
	<div class="col-md-12" style="margin-top: 50px;"></div>
</div>
<div class="row">
	<div class="col-md-12">@yield('content')</div>
</div>

{{ HTML::script('http://code.jquery.com/jquery-1.10.1.min.js') }}
{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js') }}

</body>
</html>
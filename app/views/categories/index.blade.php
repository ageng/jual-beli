@extends('layouts.main')

@section('content')

	<div id="admin">

		<h1>Kategori Admin Panel</h1><hr>

		<p>Di sini Anda bisa melihat, menghapus dan menambah kategori baru.</p>

		<h2>Kategori yang ada.</h2><hr>

		<ul>
			@foreach($categories as $category)
				<li>
					{{ $category->name }} - 
					{{ Form::open(array('url'=>'admin/categories/destroy', 'class'=>'form-inline')) }}
					{{ Form::hidden('id', $category->id) }}
					{{ Form::submit('delete') }}
					{{ Form::close() }}
				</li>
			@endforeach
		</ul>

		<h2>Membuat kategori baru</h2><hr>

		@if($errors->has())
		<div id="form-errors">
			<p>The following errors have occurred:</p>

			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div><!-- end form-errors -->
		@endif

		{{ Form::open(array('url'=>'admin/categories/create')) }}
		<p>
			{{ Form::label('name') }}
			{{ Form::text('name') }}
		</p>
		{{ Form::submit('Create Category', array('class'=>'secondary-cart-btn')) }}
		{{ Form::close() }}
	</div><!-- end admin -->

@stop
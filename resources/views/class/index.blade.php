@extends('layouts.app')

@section('title','Class | ')

@section('content')

<!-- begin row -->
<div class="row">
<div class="col-md-4">
	<div class="col-md-12">
			<h3 class="modal-title">
			@if(isset($e_class))
				Edit Class
			@else
				Add New Class
			@endif
			</h3>
		</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
	@can('add_classes')
	<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Data</h4>
			</div>
			<div class="panel-body">
			@if(isset($e_class))
				{!! Form::model($e_class,['method'=>'PUT','route'=>['classes.update',$e_class->id]]) !!}
				<div class="form-group{{ $errors->has('name')?' has-error':''}}">
				{!! Form::label('name','Name') !!}
				{!! Form::text('name',$e_class->name,['class'=>'form-control','placeholder'=>'Class Name']) !!}
				@if ($errors->has('name'))
				<p class="help-block error">
					{{ $errors->first('name') }}
				</p>
				@endif
				</div>
				{!! Form::submit('Update',['class'=>'btn btn-primary m-t-5'])!!}
				{!! Form::close() !!}
			@else
				{!! Form::open(['route'=>'classes.store']) !!}
				<div class="form-group{{ $errors->has('name')?' has-error':''}}">
				{!! Form::label('name','Name') !!}
				{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Class Name']) !!}
				@if ($errors->has('name'))
				<p class="help-block error">
					{{ $errors->first('name') }}
				</p>
				@endif
				</div>
				{!! Form::submit('Create',['class'=>'btn btn-primary m-t-5'])!!}
				{!! Form::close() !!}
			@endif
			</div>
		</div>
	@endcan
	</div>
</div>	
<div class="col-md-8">
		<div class="col-md-5">
			<h3 class="modal-title">{{ $classes->total() }}{{ str_plural('Class',$classes->total() ) }}</h3>
		</div>
		<div class="col-md-7" >
			@can('add_classes')   
                 <!--<a href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Add New Class</a>-->
            @endcan
		</div>
	<div class="clearfix"></div>

	<div class="col-md-12">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">DataTable - Extension Combination</h4>
			</div>
				<div class="panel-body">
   						<table id="data-table" class="table table-striped table-bordered">
						<thead>
							<tr>
							<th>Class Id</th>
							<th>Class Name</th>
							<th>Create At</th>
							@can('edit_classes','delete_classes')
							<th class="text-center" data-sortable="false">Actions</th>
							@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($classes as $gclasst)
							<tr>
							<td>{{ $gclasst->id }}</td>
							<td>{{ $gclasst->name}}</td>
							<td>{{ $gclasst->created_at->toFormattedDateString()}}</td>
							@can('edit_classes','delete_classes')
							<td class="text-center">
								<!--@include('shared._actions',[
									'entity' => 'classes',
									'id' => $gclasst->id
								])-->
							@can('edit_classes')
								<a onclick="edit_action()" href="{{ route('classes.edit',['class'=> $gclasst->id])}}" class="btn btn-success btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
							@endcan

							@can('delete_classes')
								{!! Form::open( ['method' => 'delete', 'url' => route('classes.destroy', ['class' => $gclasst->id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
									<button type="submit" class="btn btn-danger btn-icon btn-circle btn-sm">
										<i class="fa fa-trash"></i>
									</button>
								{!! Form::close() !!}
							@endcan
							</td>
							@endcan
							</tr>
							@endforeach
						</tbody>
						</table>
	 			 </div>
		</div>
	</div>
<!-- end col-10 -->
</div>	
</div>
<script>
	function edit_action(){
		
		document.getElementByClass("modal-title").textContent = "Edit Class";
	}
</script>
@endsection
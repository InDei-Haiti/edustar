@extends('layouts.app')

@section('title',' Subject')

@section('content')

<!-- begin row -->
<div class="row">
<div class="col-md-4">
	<div class="col-md-12">
			<h3 class="modal-title">
			@if(isset($editSubject))
				Edit Subject
			@else
				Add New Subject
			@endif
			</h3>
		</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
	@can('add_subjects')
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
				@if(isset($editSubject))
					{!! Form::model($editSubject,['method'=>'PUT','route'=>['subjects.update',$editSubject->id]]) !!}
					<div class="form-group{{ $errors->has('code')?' has-error':''}}">
					{!! Form::label('code','Code') !!}
					{!! Form::text('code',null,['class'=>'form-control','placeholder'=>'Subject Code']) !!}
					@if ($errors->has('code'))
					<p class="help-block error">
						{{ $errors->first('code') }}
					</p>
					@endif
					</div>
					<div class="form-group{{ $errors->has('name')?' has-error':''}}">
					{!! Form::label('name','Name') !!}
					{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Subject Name']) !!}
					@if ($errors->has('name'))
					<p class="help-block error">
						{{ $errors->first('name') }}
					</p>
					@endif
					</div>
					{!! Form::submit('Update',['class'=>'btn btn-primary m-t-5'])!!}
					{!! Form::close() !!}
				@else
					{!! Form::open(['route'=>'subjects.store']) !!}
					<div class="form-group{{ $errors->has('code')?' has-error':''}}">
					{!! Form::label('code','Code') !!}
					{!! Form::text('code',null,['class'=>'form-control','placeholder'=>'Subject Code']) !!}
					@if ($errors->has('code'))
					<p class="help-block error">
						{{ $errors->first('code') }}
					</p>
					@endif
					</div>
					<div class="form-group{{ $errors->has('name')?' has-error':''}}">
					{!! Form::label('name','Name') !!}
					{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Subject Name']) !!}
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
			<h3 class="modal-title">{{ $subjects->total() }}{{ str_plural(' Class',$subjects->total() ) }}</h3>
		</div>
		<div class="col-md-7" >
			@can('add_subjects')   
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
							<th>Subject Id</th>
							<th>Subject code</th>
							<th>Subject Name</th>
							@can('edit_subjects','delete_subjects')
							<th class="text-center" data-sortable="false">Actions</th>
							@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($subjects as $subject)
							<tr>
							<td>{{ $subject->id }}</td>
							<td>{{ $subject->code}}</td>
							<td>{{ $subject->name}}</td>
							@can('edit_subjects','delete_subjects')
							<td class="text-center">
							@can('edit_subjects')
								<a onclick="edit_action()" href="{{ route('subjects.edit',['subject'=> $subject->id])}}" class="btn btn-success btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
							@endcan

							@can('delete_subjects')
								{!! Form::open( ['method' => 'delete', 'url' => route('subjects.destroy', ['subject' => $subject->id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
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
		
		document.getElementByClass("modal-title").textContent = "Edit Subject";
	}
</script>
@endsection

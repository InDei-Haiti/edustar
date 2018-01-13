@extends('layouts.app')

@section('title',' Academic Years ')

@section('content')

<!-- begin row -->
<div class="row">
<div class="col-md-4">
	<div class="col-md-12">
			<h3 class="modal-title">
				Add Academic Year Details
			</h3>
		</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
	@can('add_academics')
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
					{!! Form::open(['route'=>'academics.store']) !!}
					<div class="form-group{{ $errors->has('academic_startyear')?' has-error':''}}">
					{!! Form::label('academic_startyear','Start Year',['class'=>'req']) !!}
					{!! Form::select('academic_startyear', range(2010, 2030) ,null,['class'=>'form-control','placeholder'=>'Select Start Year']) !!}
					@if ($errors->has('academic_startyear'))
					<p class="help-block error">
						{{ $errors->first('academic_startyear') }}
					</p>
					@endif
					</div>
					<div class="form-group{{ $errors->has('academic_startmonth')?' has-error':''}}">
					{!! Form::label('academic_startmonth','Start Month') !!}
					{!! Form::selectMonth('academic_startmonth',null,['class'=>'form-control','placeholder'=>'Select Start Month']) !!}
					@if ($errors->has('academic_startmonth'))
					<p class="help-block error">
						{{ $errors->first('academic_startmonth') }}
					</p>
					@endif
					</div>
					<div class="form-group{{ $errors->has('academic_endyear')?' has-error':''}}">
					{!! Form::label('academic_endyear','End Year') !!}
					{!! Form::Select('academic_endyear',range(2010, 2030) ,null,['class'=>'form-control','placeholder'=>'Select End Year']) !!}
					@if ($errors->has('academic_endyear'))
					<p class="help-block error">
						{{ $errors->first('academic_endyear') }}
					</p>
					@endif
					</div>
					<div class="form-group{{ $errors->has('academic_endmonth')?' has-error':''}}">
					{!! Form::label('academic_endmonth','End Month') !!}
					{!! Form::selectMonth('academic_endmonth',null,['class'=>'form-control','placeholder'=>'Select End Month']) !!}
					@if ($errors->has('academic_endmonth'))
					<p class="help-block error">
						{{ $errors->first('academic_endmonth') }}
					</p>
					@endif
					</div>
					<div class="form-group{{ $errors->has('status')?' has-error':''}}">
					{!! Form::label('status','Status') !!}
					{!! Form::select('status',['1' => 'Active', '2' => 'Deactive'],null,['class'=>'form-control','placeholder'=>'Select Status']) !!}
					@if ($errors->has('status'))
					<p class="help-block error">
						{{ $errors->first('status') }}
					</p>
					@endif
					</div>
					{!! Form::submit('Save',['class'=>'btn btn-primary m-t-5'])!!}
					{!! Form::close() !!}
			</div>
		</div>
	@endcan
	</div>
</div>	
<div class="col-md-8">
		<div class="col-md-5">
			<h3 class="modal-title">{{ $academics->total() }}{{ str_plural(' Academic',$academics->total() ) }}</h3>
		</div>
		<div class="col-md-7" >
			@can('add_academics')   
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
							<th>Sl.No</th>
							<th>Start Year</th>
							<th>Start Month</th>
							<th>End Year</th>
							<th>End Month</th>
							<th>Status</th>
							@can('edit_academics','delete_academics')
							<th class="text-center" data-sortable="false">Actions</th>
							@endcan
							</tr>
						</thead>
						<tbody>
							@foreach($academics as $academic)
							<tr>
							<td></td>
							<td>{{ $academic->academic_startyear}}</td>
							<td>{{ $academic->academic_startmonth	}}</td>
							<td>{{ $academic->academic_endyear	 }}</td>
							<td>{{ $academic->academic_endmonth}}</td>
							<td>{{ $academic->status}}</td>
							@can('edit_academics','delete_academics')
							<td class="text-center">
							@can('edit_academics')
								<a onclick="edit_action()" href="{{ route('academics.edit',['academic'=> $academic->id])}}" class="btn btn-success btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
							@endcan

							@can('delete_academics')
								{!! Form::open( ['method' => 'delete', 'url' => route('academics.destroy', ['academic' => $academic->id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
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

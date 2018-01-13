@extends('layouts.app')

@section('title','User | ')

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="javascript:;">Home</a></li>
	<li><a href="javascript:;">Tables</a></li>
	<li><a href="javascript:;">Managed Tables</a></li>
	<li class="active">Extension Combination</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">...<small> ...</small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
	<div class="col-md-12 m-b-5">		
		<div class="col-md-5">
			<h3 class="modal-title">{{ $users->total() }}{{ str_plural(' User', $users->count())}}</h3>
		</div>
		<div class="col-md-7 page-action text-right" >
			@can('add_users')
				<a href="{{ route('users.create') }}" class="btn btn-primary"> <i class="fa fa-plus-sign"></i> Create</a>
			@endcan
		</div>
	</div>
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
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Create At</th>
							@can('edit_users','delete_users')
							<th class="text-center" data-sortable="false">Actions</th>
							@endcan
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->roles()->pluck('name')->implode(' ')}}</td>
								<td>{{ $user->created_at->toFormattedDateString() }}</td>
								@can('edit_users')
								<td class="text-center">
								@include('shared._actions',[
								'entity' => 'users',
								'id' => $user->id
								])
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
<!-- end row -->
@endsection
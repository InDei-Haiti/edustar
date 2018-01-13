@can('edit_users')
	<a onclick="edit_action()" href="{{ route($entity.'.edit',[str_singular($entity)=> $id])}}" class="btn btn-success btn-icon btn-circle btn-sm"><i class="fa fa-edit"></i></a>
@endcan

@can('delete_users')
	{!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', ['user' => $id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
		<button type="submit" class="btn btn-danger btn-icon btn-circle btn-sm">
			<i class="fa fa-trash"></i>
		</button>
	{!! Form::close() !!}
@endcan
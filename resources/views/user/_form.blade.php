<!-- Name Form Input-->
<div class="form-group{{ $errors->has('name')? ' has-error' : '' }}">
	{!! Form::label('name','Name') !!}
	{!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Name']) !!}
	@if ($errors->has('name'))
	<p class="help-block error">
		{{ $errors->first('name') }}
	</p>
	@endif
</div>
<!-- Email Form Input-->
<div class="form-group{{ $errors->has('email')?' has-error':''}}">
	{!! Form::label('email','Email') !!}
	{!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Email']) !!}
	@if($errors->has('email'))
	<p class="help-block error">
		{{ $errors->first('email') }}
	</p>
	@endif
</div>
<!-- Email Form Input-->
<div class="form-group{{ $errors->has('password')?' has-error':''}}">
	{{ Form::label('password','Password')}}
	{{ Form::password('password',['class'=>'form-control','placeholder'=>'Password'])}}
	@if($errors->has('password'))
	<p class="help-block error">
		{{ $errors->first('password') }}
	</p>
	@endif
</div>
<div class="form-group{{ $errors->has('roles')?' has-error':''}}">
	{{ Form::label('roles[]','Roles')}}
	{{ Form::select('roles[]',$roles,isset($user)?$user->roles->pluck('id')->toArray():null,['class'=>'form-control','placeholder' => 'Please select role'])}}
	@if($errors->has('roles'))
	<p class="help-block error">
		{{ $errors->first('roles') }}
	</p>
	@endif
</div>
<!-- Permissions -->
@if(isset($user))
	@include('shared._permissions',['close'=>'true','model'=>$user])
@endif










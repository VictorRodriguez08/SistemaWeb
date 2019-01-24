{!! Form::open(array('url'=>'registro/log','method'=>'GET', 'autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar...." value="{{$searchText}}">

		<input type="text" class="form-control" name="searchText1" placeholder="Buscar...." value="{{$searchText1}}">
		
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>

		
	</div>
</div>
{{Form::close()}}
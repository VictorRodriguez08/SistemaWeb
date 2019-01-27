{!! Form::open(array('url'=>'registro/log','method'=>'GET', 'autocomplete'=>'off','role'=>'search', 'id'=>'frmLog')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar...." value="{{$searchText}}">

		<input type="text" class="form-control" name="searchText1" placeholder="Buscar...." value="{{$searchText1}}">
		<input type="hidden" name="esPdf" id="esPdf"/>
		 <a href="#" id="btnBuscarLog" class="btn btn-info">Buscar</a>
		 <a href="#" id="btnVerLog" class="btn btn-warning">Ver R</a>
		
	</div>
</div>
{{Form::close()}}

@section('scripts')
	<script>
		$(document).ready(function(){
			$('#btnBuscarLog').click(function(event){
				event.preventDefault();
				$('#esPdf').val("false");
				$('#frmLog').submit();
			});

			$('#btnVerLog').click(function(event){
				event.preventDefault();
				$('#esPdf').val("true");
				$('#frmLog').submit();
			})
		});
	</script>
@endsection
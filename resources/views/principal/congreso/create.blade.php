@extends ('layouts.admin')
@section ('contenido')
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm6 col-xs-12 ">
                <h3> Nuevo Congreso</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!!Form::Open(array('url'=>'congreso', 'method'=>'POST','autocomplete'=>'off'))!!}
                    {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <h5>* Campo Obligatorio</h5>
                                <label> </label><label> </label>
                            </div></div>

                        <div class="row">
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-7 control-label">Nombre <label>*</label></label>

                                <div class="col-md-5">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre del Congreso">

                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <br>

                            </div>
                        </div>

                    <div class="row">
                        </div>
                        <div class="row">
                            <div class="form-group{{ $errors->has('fecha_ini') ? ' has-error' : '' }}">
                                <label for="fecha_ini" class="col-md-7 control-label">Fecha Inicio <label>*</label></label>
                                <div class="col-md-5">
                                    <input id="fecha_ini" class="datepicker" name="fecha_ini" value="{{ old('fecha_ini') }}">

                                    @if ($errors->has('fecha_ini'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_ini') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <br>

                            </div>
                    </div>

                    <div class="row">
                        </div>
                        <div class="row">
                            <div class="form-group{{ $errors->has('fecha_entrega') ? ' has-error' : '' }}">
                                <label for="fecha_entrega" class="col-md-7 control-label">Fecha de Entrega de Documento <label>*</label></label>
                                <div class="col-md-5">
                                    <input id="fecha_entrega" class="datepicker" name="fecha_entrega" value="{{ old('fecha_entrega') }}" >

                                    @if ($errors->has('fecha_entrega'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_entrega') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <br>

                            </div>
                    </div>

                    <div class="row">
                        </div>
                        <div class="row">
                            <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                                <label for="fecha_fin" class="col-md-7 control-label">Fecha Finalización <label>*</label></label>
                                <div class="col-md-5">
                                    <input id="fecha_fin" class="datepicker" name="fecha_fin" value="{{ old('fecha_fin') }}">

                                    @if ($errors->has('fecha_fin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_fin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br>
                                <br>

                            </div>
                    </div>



                <div class="from-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                    
                </div>

            {!!Form::close()!!}
            </div>
        </div>
@endsection





@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Congreso: {{ $congreso->nombre}}</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        {!!Form::model($congreso,['method'=>'PATCH','route'=>['congreso.update',$congreso->id]])!!}
        {{Form::token()}}
                    <div class="row">
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-6 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $congreso->nombre}}">

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
                            <label for="fecha_ini" class="col-md-6 control-label">Fecha Inicio</label>
                            <div class="col-md-6">
                                <input id="fecha_ini" class="datepicker" name="fecha_ini" value="{{$congreso->fecha_ini}}">

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
                            <label for="fecha_entrega" class="col-md-6 control-label">Fecha de Entrega de Documento</label>
                            <div class="col-md-6">
                                <input id="fecha_entrega" class="datepicker" name="fecha_entrega" value="{{$congreso->fecha_entrega}}">

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
                            <label for="fecha_fin" class="col-md-6 control-label">Fecha Finalización</label>
                            <div class="col-md-6">
                                <input id="fecha_fin" class="datepicker" name="fecha_fin" value="{{$congreso->fecha_fin }}">

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
                 <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        {!!Form::close()!!}
    </div>

@endsection


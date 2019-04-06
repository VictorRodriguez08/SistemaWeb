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

                {!!Form::Open(array('url'=>'autores_scongreso', 'method'=>'POST','autocomplete'=>'off'))!!}
                    {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <h5>* Campo Obligatorio</h5>
                                <label> </label><label> </label>
                            </div></div>





                            <div class="row">
                                
                                <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                                    <label for="carrera" class="col-md-4 control-label">Carrera <label>*</label></label>

                                        <div class="col-md-8">
                                            <input id="carrera" type="text" class="form-control" name="carrera" value="{{ old('carrera') }}" placeholder="Carrera que estudia">

                                            @if ($errors->has('carrera'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('carrera') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    <br>
                                    <br>

                                    </div>
                                </div>

                            <div class="row">
                                <div class="form-group{{ $errors->has('tema') ? ' has-error' : '' }}">
                                    <label for="Tema" class="col-md-4 control-label">Tema <label>*</label></label>

                                    <div class="col-md-8">
                                        <input id="tema" type="text" class="form-control" name="tema" value="{{ old('tema') }}" placeholder="Digite Tema">

                                        @if ($errors->has('tema'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tema') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <br>
                                    <br>

                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label>* Dias de la Semana</label>
                                <select name"dia" class="form-control">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sabado">Sabado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>
                                
                            </div>    
                            


                <div class="from-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                    
                </div>

            {!!Form::close()!!}
            </div>
        </div>
@endsection





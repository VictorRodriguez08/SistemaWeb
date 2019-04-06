@extends ('layouts.admin')
@section ('contenido')
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm6 col-xs-12 ">
                <h3> Autores de Congreso</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!!Form::Open(array('url'=>'autores_congreso', 'method'=>'POST','autocomplete'=>'off'))!!}
                    {{Form::token()}}
                        <div class="row">
                            <div class="col-lg-6">
                                
                                <h5>* Campo Obligatorio</h5>
                                <label> </label><label> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>* Nombre del autor 1</label>
                            <select name="user_id_1" class="form-control" required>
                             <option value="">--Selecione un autor--</option>
                             @foreach($users as $user)

                            <option value="{{$user->id}}"> {{ $user->name}}{{" "}}{{$user->apellidos}}</option>
                            @endforeach
                            </select>
                        </div> 


                        <div class="form-group">
                            <label> Nombre del autor 2</label>
                            <select name="user_id_2" class="form-control">
                             <option value="">--Selecione un autor--</option>
                             @foreach($users as $user)

                            <option value="{{$user->id}}"> {{ $user->name}}{{" "}}{{$user->apellidos}}</option>
                            @endforeach
                            </select>
                        </div> 

                        <div class="form-group">
                            <label> Nombre del autor 3</label>
                            <select name="user_id_3" class="form-control">
                             <option value="">--Selecione un autor--</option>
                             @foreach($users as $user)

                            <option value="{{$user->id}}"> {{ $user->name}}{{" "}}{{$user->apellidos}}</option>
                            @endforeach
                            </select>
                        </div> 

                        <div class="form-group">
                            <label>* Selecione CongresoCongreso</label>
                            <select name="congreso_id" class="form-control">
                             <option value="">--Selecione un congreso--</option>
                             @foreach($congresos as $congreso)

                            <option value="{{$congreso->id}}"> {{ $congreso->nombre}}</option>
                            @endforeach
                            </select>
                        </div> 


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
                                <select name="dia" class="form-control">
                                    <option value="Lunes">Lunes</option>
                                    <option value="Martes">Martes</option>
                                    <option value="Miercoles">Miercoles</option>
                                    <option value="Jueves">Jueves</option>
                                    <option value="Viernes">Viernes</option>
                                    <option value="Sabado">Sabado</option>
                                    <option value="Domingo">Domingo</option>
                                </select>
                                
                            </div>    

                            <div class="row">
                                <div class="form-group{{ $errors->has('url_archivo') ? ' has-error' : '' }}">
                                    <label for="Tema" class="col-md-4 control-label">URL Archivo <label>*</label></label>
                                    <form action="{{URL::action('AutoresCongresoController@uploading')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="file" name="url_archivo" id="url_archivo">
                                        <input type="submit">
                                    </form>
                                    <div class="col-md-8">
                                        <input id="url_archivo" type="text" class="form-control" name="url_archivo" value="{{ old('tema') }}" placeholder="Digite Tema">

                                        @if ($errors->has('url_archivo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('url_archivo') }}</strong>
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





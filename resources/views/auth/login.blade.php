@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col.lgl-12 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Iniciar Sesión</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordar
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in" ></i> Iniciar Sesión
                                </button>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">¿ Olvidaste tu contraseña ?</a>
                                <a class="btn btn-link" href="{{ url('/inicio/create') }}">Registrarse</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <li class="dropdown">
        <a href="http://phpoll.com/login" class="dropdown-toggle" data-toggle="dropdown">Iniciar Sesión <span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
            <div class="col-lg-12">
                <div class="text-center"><h3><b>Iniciar Sesión</b></h3></div>
                <form id="ajax-login-form" role="form" method="POST" action="{{ url('/login') }}" >
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" >Correo Electronico</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" >Contraseña</label>
                            <input id="password" type="password" class="form-control" name="password" />

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Recordar
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                         <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                              <i class="fa fa-btn fa-sign-in" ></i> Iniciar Sesión
                             </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">¿ Olvidaste tu contraseña ?</a>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a class="btn btn-link" href="{{ url('/inicio/create') }}">Registrarse</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" class="hide" name="token" id="token" value="a465a2791ae0bae853cf4bf485dbe1b6" />

                </form>
            </div>
        </ul>
</li>
@endsection

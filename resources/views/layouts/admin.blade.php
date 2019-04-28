<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Web de Gestión y Publicacion de Investigaciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert2.css')}}">
    <link rel="icono-congreso" href="{{asset('img/icono-congreso.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/estilo.css')}}" rel="stylesheet" type="text/css" />

      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SW</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sistema Web</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                @if (Auth::guest())

                   <!-- <li><a href="{{ url('/login') }}">Iniciar Sesión</a></li>-->
                 <li class="dropdown">
                    <a href="http://phpoll.com/login" class="dropdown-toggle" data-toggle="dropdown">Iniciar Sesión <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                        <div class="col-lg-12">
                            <div class="text-center"><h3><b>Iniciar Sesión</b></h3></div>
                            <form id="ajax-login-form" role="form" method="POST" action="{{ url('/login') }}" >
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" >Correo Electronico</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" >Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <div>
                                                <input type="checkbox" name="remember"> Recordar
                                            </div>
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
                                            <a class="btn btn-link" href="{{ url('/administracion/usuario/create') }}">Registrarse</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="a465a2791ae0bae853cf4bf485dbe1b6">
                            </form>
                        </div>
                    </ul>
                </li>

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name." ".Auth::user()->apellidos }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}" style="color:black;"><i class="fa fa-btn fa-sign-out" ></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                @endif
                </ul>
              </li>

            </ul>
          </div>

        </nav>
      </header>

          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
              @if(!Auth::guest())
            <li class="treeview">
              <a href="#">
                <i class="fa fa-lock"></i>
                <span>Administrar</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('administracion/usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="{{url('administracion/rol')}}"><i class="fa fa-circle-o"></i> Roles</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-television"></i>
                <span>Congresos</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('congreso')}}"><i class="fa fa-circle-o"></i> Registrar</a></li>
                <li><a href="{{url('autores_congreso')}}"><i class="fa fa-circle-o"></i> Asginar Autores</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Tesis</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('tesis')}}"><i class="fa fa-circle-o"></i> Registrar</a></li>
                <li><a href=""><i class="fa fa-circle-o"></i> Ver Revisiones</a></li>
              </ul>
            </li>
                       
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Registros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('registro/log')}}"><i class="fa fa-circle-o"></i> Ver Registros</a></li>
                
              </ul>
            </li>
              @endif
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Web</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
                              @yield('contenido')
                        </div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
      </footer>
    </div>
      
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>

     <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
     <script src="https://unpkg.com/gijgo@1.9.11/js/messages/messages.es-es.js" type="text/javascript"></script>
     <script src="{{asset('js/dropzone.js')}}" type="text/javascript"></script>
     <script src="{{asset('js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    @yield('scripts')
    <script>
      $(document).ready(function(){
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        var config = {
          locale: "es-es",
            uiLibrary: 'bootstrap',
            minDate: today,
            format: 'dd-mm-yyyy'     }
        $('#fecha_ini').datepicker(config);
        $('#fecha_entrega').datepicker(config);
        $('#fecha_fin').datepicker(config);
      });
    </script>  
  </body>
</html>

<html>
<head>
    <style>
        @page {
            margin: 0;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 2.8cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0.5cm;
            left: 0;
            right: 0;
            height: 2cm;

            line-height: 1.5cm;
            padding-bottom: 0.1cm;

            text-align: center;

            border-bottom: solid 3px black;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2cm;

            text-align: center;
            font-size: 8px;

            border-top: solid 3px black;
        }

        .fecha{
            text-align: right;
        }

        .destinatario{
            margin-top: 1cm;
        }

        .contenido{
            text-align: justify;
        }

        ul
        {
            display: inline-block;
        }

        ul.izquierda{
            width: 65%;
            text-align: right;
        }

        ul li{
            min-height: 5px;
            list-style: none;
            display: block;
        }

        ul.derecha{
            width: 35%;
            padding-top: 0.5cm;
            text-align: center;
        }

        .pagebreak{
            page-break-after: always;
        }

    </style>
</head>
<body>
@php
    function obtener_mes($id){

        $meses = array(
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        );

        return $meses[$id -1];
    }

    $alumnos = "";
    $total_alumnos_tesis = 0;

    foreach ($tesis->usuario_tesis as $usuario){
        if($usuario->rol == 1){
            if($alumnos != "")
                $alumnos .= ", ";
            $alumnos .= $usuario->user->name . " " . $usuario->user->apellidos;

            $total_alumnos_tesis++;
        }
    }

    $alumnos = str_replace_last(',',' y', $alumnos);

    $ciclo = date('m',strtotime($tesis->fecha_ini)) < 7 ? '01' : '02';
    $anio = date('Y',strtotime($tesis->fecha_ini));

    $decanos = array("Ing. Rubén Alfredo Mendoza Juárez","");
    $cargos = array('Presidente','Primer Vocal','Segundo Vocal');

    $i = 0;
@endphp
    <header>
        <img src="http://www.usonsonate.edu.sv:9091/Laboratorios_CyT_USO/images/logo.jpg" alt="log uso" width="200">
    </header>

    <main>
        @foreach($tesis->obtener_jurados() as $jurado)
                @php
                    $i++;
                @endphp

            <p class="fecha">Sonsonate {{strftime('%d de')}} {{obtener_mes(date('n'))}} de {{date('Y')}}</p>
            <p class="destinatario">
                {{$tesis->obtener_asesor()->user->titulo}}
                <br>
                {{$tesis->obtener_asesor()->user->name}} {{$tesis->obtener_asesor()->user->apellidos}}
                <br>
                {{$tesis->cargo}}
                <br>
                Presente

            </p>
            <p class="contenido">
                Respetable {{$tesis->obtener_asesor()->user->titulo}}:
                <br>
                Por medio de la presente me permito comunicarle que por su experiencia y profesionalismo el DECANATO
                lo ha nombrado ASESOR del trabajo de Graduación que se denomina: "{{$tesis->titulo}}" el cual está siendo desarrollado
                por {{$total_alumnos_tesis > 1 ? "los bachilleres" : "el bachiller" }}: {{$alumnos}}, {{$total_alumnos_tesis > 1 ? "egresados" : "egresado" }}
                de la carrera de {{$tesis->carrera}} de la facultad de {{$tesis->facultad}} de esta Universidad
                <br><br>
                El proceso de asesoría tiene asignado OCHENTA(80) horas y se inicia la etapa de ANTEPROYECTO, el cual en el presente ciclo {{$ciclo}}-{{$anio}}
                está en ejecución. Por lo tanto, el nombramiento entra en vigencia a partir de la aceptación del cargo. El anteproyecto se estructura
                según el protocolo por la facultad, el cual se adjunta.
                <br><br>
                Una vez aprobado el ANTEPROYECTO  {{$total_alumnos_tesis > 1 ? "los alumnnos disponen" : "el alumno dispone" }} de un periodo de 12 meses para
                <strong>desarrollar y defender</strong> el <strong>trabajo de Graduación</strong>. Tiempo durante el cual, en su calidad de asesor deberá apoyar
                y dar seguimiento continuo al desarrollo de éste.
                <br><br>
                Así mismo, se le informa que el trabajo será evaluado por un Tribunal Examinador
                <br><br>
                El decanato realiza monitoreo de la ejecución del proceso, para el cual se incluye un formato de control de avance y seguimiento que deberá completarse
                por ambas partes que permita posteriormente la gestion del pago de asesoría
                <br><br>
                Para conocimiento de las partes involucradas de las regulaciones de que deben ser respetadas y aplicadas, se anexa copia de los capítulos correspondientes
                al reglamento de graduación vigente.
                <br><br>
                Agradeciendo la atención a la presente me suscribo.

                <br><br><br><br><br><br>

                <p style="text-align: center">
                    {{$tesis->facultad == "Ingeniería y Ciencias Naturales" ? $decanos[0] : $decanos[1]}}
                    <br>
                    Decano de la {{$tesis->facultad}}
                </p>
            @if($i<3)
                <div class="pagebreak"></div>
            @endif
        @endforeach
    </main>

</body>
</html>

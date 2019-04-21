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
            float: right;
        }

        .destinatario{
            margin-top: 1cm;
        }

        .contenido{
            text-align: justify;
        }

        ul.izquierda{
            width: 65%;
            float: left;
            text-align: right;
        }

        ul li{
            min-height: 5px;
            display: block;
            list-style: none;
        }

        ul.derecha{
            width: 35%;
            float: right;
            vertical-align: middle;
            padding-top: 0.5cm;
        }
    </style>
</head>
    <body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <img src="http://www.usonsonate.edu.sv:9091/Laboratorios_CyT_USO/images/logo.jpg" alt="log uso" width="200">
    </header>

        <main>
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
            @endphp
            <p class="fecha">Sonsonate {{strftime('%d de')}} {{obtener_mes(date('n'))}} de {{date('Y')}}</p>
            <p class="destinatario">
               Titulo<br>Nombre<br>Presente
            </p>
            <p class="contenido">
                Respetable Titulo:
                <br>
                Por medio de la presente me permito comunicarle que por su experiencia y profecionalismo el DECANATO
                lo ha nombrado CARGO del trabajo de Graduación que se denomina: "TEMA" el cual está siendo desarrollado
                por lo bachilleres: NOMBRES, egresados de la carrera de CARRERA de la facultad de FACULTAD de esta Universidad
                <br><br>
                El proceso de asesoría
            </p>
        </main>

    <footer>
        <ul class="izquierda">
            <li>Calle Ing. Jesús Adalberto Díaz Pineda y Avenida Central - Col. 14 de Diciembre, Sonsonate. El Salvador C.A. </li>
            <li>Teléfono </li>
            <li>Calle Ing. </li>
            <li>Calle Ing. </li>
            <li>Calle Ing. </li>
        </ul>
        <ul class="derecha">
            <li>Recomenda el camino hacia la excelencia</li>
        </ul>
    </footer>
    </body>
</html>

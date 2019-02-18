<?php

namespace sistemaWeb\Http\Controllers;

use sistemaWeb\Http\Controllers\Controllers;
use Mail;
use sistemaWeb\User;

class MailController extends Controller {
    private $asunto = "Sistema Web de Gestión y Publicacion de Investigaciones";
    private $from = "vers0891@gmail.com";
    private $subject = "";
    private $vista="";

    public function notificacion_usuario_nuevo($id) {
        $usuario = User::find($id);
        $data = array('id'=>$id);
        $this->subject = "Notificación nuevo Usuario registrado";
        $this->vista ='administracion.emails.email';

        $this->send_mail($data,$usuario);
    }
    public function notificacion_activacion_usuario($id) {
        $data = array('id'=>$id);
        $usuario = User::find($id);
        $this->subject = "Notificación Activación de Usuario";
        $this->vista ='administracion.emails.notificacion_activacion_usuario';

        $this->send_mail($data,$usuario);
    }

    public function notificacion_agregado_investigacion($id,$nombre_investigacion,$nombre_usuario, $tipo_usuario_investigacion) {
        $data = array('id'=>$id,'nombre_investigacion'=>$nombre_investigacion,'nombre_usuario'=>$nombre_usuario,'tipo'=>$tipo_usuario_investigacion);

        $usuario = User::find($id);
        $this->subject = "Agregado a " . $nombre_investigacion;

        $this->vista ='administracion.emails.notificacion_agregado_investigacion';

        $this->send_mail($data,$usuario);
    }

    private function send_mail($data, $usuario){
        Mail::send($this->vista, $data, function($message) use ($usuario) {
            $message->to($usuario->email, $this->asunto)->subject
            ($this->subject);
            $message->from($this->from,$this->asunto);
        });
    }
}
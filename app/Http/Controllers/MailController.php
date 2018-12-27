<?php

namespace sistemaWeb\Http\Controllers;

use sistemaWeb\Http\Controllers\Controllers;
use Mail;

class MailController extends Controller {
    public function email($id) {
        $data = array('id'=>$id);
        Mail::send('administracion.emails.email', $data, function($message) {
            $message->to('vers0891@gmail.com', 'Email de prueba')->subject
            ('Laravel HTML Testing Mail');
            $message->from('vers0891@gmail.com','Tesis');
        });
    }
}
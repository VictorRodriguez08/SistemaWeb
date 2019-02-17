<div class="modal fade modal-slide-in-right" tabindex="-1" id="modal_lista_usuarios-delete-{{$u->id}}" role="dialog">
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
               
            </div>
            <div class="modal-body">
                <h4>Información del Usuario</h4>
                <div style="width: 50%" class="col-lg-6 col-md-12 col-lg-4">
                       <label style="width: 50%" >ID</label> <p >{{$u->id}}</p>
                       <p></p>
                </div>
                <div style="width: 50%" class="col-lg-6 col-md-12 col-lg-4">
                    <label >Nombre</label>
                    <p >{{$u->name}}</p>
                </div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Apellidos:</label> <p>{{$u->apellidos}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Correo electronico:</label> <p>{{$u->email}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Dirección:</label> <p>{{$u->direccion}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Titulo:</label> <p>{{$u->titulo}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Otros Estudios:</label> <p>{{$u->otros_estudios}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Fecha de Nacimiento:</label> <p>{{ date('d-m-Y',strtotime($u->fecha_nac))}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>DUI :</label> <p>{{$u->dui}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Telefonos:</label> <p>{{$u->telefonos}}</p></div>
                <div style="width: 50%" class="col-lg-6 col-md-6 col-lg-4"><label>Otros Correos Electronicos:</label> <p>{{$u->otros_email}}</p></div>

            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-deault" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    
    
</div>
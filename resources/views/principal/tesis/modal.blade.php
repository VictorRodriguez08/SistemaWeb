<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modalBusqueda">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">X</span>		
				</button>
				<h4 class="modal-title" id="tituloBusqueda">Seleccione un Usuario</h4>
			</div>
			<div class="modal-body">

				<input type="hidden" id="tipoBusqueda" value="0">

				<div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txtModal" placeholder="Buscar...." value="">
                        <span class="input-group-btn">
                            <button id="btnBuscarModal" class="btn btn-primary">Buscar</button>
                        </span>
                    </div>
                </div>

				<div id="divOpciones">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="opcionBusqueda" id="rbnombre" value="nombre">
						<label class="form-check-label" for="rbnombre">
							Nombre
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="opcionBusqueda" id="rbtitulo" value="titulo">
						<label class="form-check-label" for="rbtitulo">
							Título académico
						</label>
					</div>

					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="opcionBusqueda" id="rbespecialidad" value="especialidad">
						<label class="form-check-label" for="rbespecialidad">
							Especialidad
						</label>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-hover table-stripped">
						<thead>
							<tr>
								<th class="hidden"></th>
								<th>Nombre</th>
								<th>Apellido</th>
							</tr>
						</thead>
						<tbody id="modalTablaUsuarios">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-deault" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
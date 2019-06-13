@extends ('principal')
@section ('categorias')

<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Usuarios
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo Usuario
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                              <option value="nombre">Nombre</option>
                              <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Persona</th>
                            <th>Rol</th>
                            <th>Clave</th>
                            <th>Condicion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                  <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>1</td>
                            <td>Admin</td>
                            <td>8345</td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>
                      
                        <tr>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                  <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>2</td>
                            <td>User</td>
                            <td>8346</td>
                            <td>
                                <span class="badge badge-success">Activo</span>
                            </td>
                        </tr>                       
                      
                      
                    </tbody>
                </table>
                
              
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Persona</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Id persona">
                                <span class="help-block">(*) Ingrese el id de la persona</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Rol</label>
                            <div class="col-md-9">
                                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Rol">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Clave</label>
                            <div class="col-md-9">
                                <input type="text" id="clave" name="clave" class="form-control" placeholder="Ingrese Clave">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Condicion</label>
                            <div class="col-md-9">
                                <input type="text" id="condicion" name="condicion" class="form-control" placeholder="Ingrese condicion">
                            </div>
                        </div>
                      
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar el usuario?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Fin del modal Eliminar -->
</main>

<!--Inicio del modal actualizar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Persona</label>
                            <div class="col-md-9">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Id persona">
                                <span class="help-block">(*) Ingrese el id de la persona</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Rol</label>
                            <div class="col-md-9">
                                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Rol">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Clave</label>
                            <div class="col-md-9">
                                <input type="text" id="clave" name="clave" class="form-control" placeholder="Ingrese Clave">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Condicion</label>
                            <div class="col-md-9">
                                <input type="text" id="condicion" name="condicion" class="form-control" placeholder="Ingrese condicion">
                            </div>
                        </div>
                      
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    


  @endsection

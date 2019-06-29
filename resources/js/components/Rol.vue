<template>
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
                <i class="fa fa-align-justify"></i> Roles
                <button type="button" @click="abrirModal('rol','agregar')" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
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
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="rol in arrayRol" :key="rol.idrol">
                            <td>
                                <button type="button" @click="abrirModal('rol','modificar',rol)" class="btn btn-warning btn-sm" >
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                
                             <template v-if="rol.estado">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivar(rol.id)">
                                    <i class="icon-trash"></i>
                                </button>
                            </template>
                            <template v-else>
                                <button type="button" class="btn btn-info btn-sm" @click="activar(rol.id)">
                                    <i class="icon-check"></i>
                                </button>
                            </template>   
                                
                             
                                
                            </td>
                            <td v-text="rol.nombre"></td>
                            <td v-text="rol.descripcion"></td>
                            <td>
                            <div v-if="rol.estado">
                                <span class="badge badge-success">Activo</span>
                            </div>
                            <div v-else>
                                <span class="badge badge-danger">Inactivo</span>
                            </div>
                                
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Ant</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titulo"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del rol">
                                <span class="help-block">(*) Ingrese el nombre del rol</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese descripcion">
                            </div>
                        </div>                        
                        <div v-show="errorRol" class="form-group row div-error">  
                            <div class="text-center text-error">  
                              <div v-for="error in errorMostrar" :key="error" v-text="error">                              
                              </div>                             
                            </div> 
                      </div>                         
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                    
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="agregar()" >Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="modificar()" >Modificar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    
    <!--Fin del modal-->
 
    <!-- Fin del modal Eliminar -->
</main>
</template>


<script>
 
export default {
	name: 'roles',
	data() {
		return {
        rol_id : 0,
  			nombre: '',
        descripcion: '',
        arrayRol: [],
        modal : 0,
        titulo : "",
        tipoAccion : 0,
        errorRol : 0,
        errorMostrar : []
		  }
    },
    mounted() {        
        this.cargar();
    },
	computed: {
 
	},
	methods: {
      cargar() {
        let datos = this;
        axios.get('/rol').then(function (response) {
        datos.arrayRol = response.data;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        }); 
        },
     agregar(){
     
         if(this.validar()){
          return;
         }
         
        let me = this;
        axios.post('/rol/agregar',{
            'nombre': this.nombre,
            'descripcion': this.descripcion
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();
            
        }).catch(function (error) {
            console.log(error.response);
        });
        
     },
     cerrarModal(){
          this.modal = 0;
          this.titulo = "";
          this.nombre = "";
          this.descripcion = "";
     },
     validar(){
          this.errorRol = 0;
          this.errorMostrar = [];
          
          if(!this.nombre) this.errorMostrar.push("No dejar nombre en blanco.");
          if(!this.descripcion) this.errorMostrar.push("No dejar descripcion en blanco.");
          console.log(this.nombre);
          if(this.errorMostrar.length) this.errorRol = 1;
          return this.errorRol;
      },
      modificar(){
        if(this.validar()){
          return;
         }
         
        let me = this;
        axios.put('/rol/actualizar',{
            'nombre': this.nombre,
            'descripcion': this.descripcion,
            'idrol' : this.rol_id
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();            
        }).catch(function (error) {
            console.log(error.response);
        });
      
      },
      desactivar(){
      
        swal({
                title: 'Esta seguro de desactivar este rol?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put(this.ruta + '/rol/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarRol(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
      
      
      },
     abrirModal(modelo,accion,data = []){
        switch(modelo){
            case "rol":{
                switch (accion){
                    case "agregar":{
                    this.titulo = "Registrar"
                        this.modal = 1;
                        this.nombre = "";
                        this.descripcion = "";
                        this.tipoAccion = 1;
                        break;
                    }
                    
                    case "modificar":{
                    console.log(data);
                      this.titulo = "Actualizar"
                        this.modal = 1;
                        this.nombre = data.nombre;
                        this.descripcion = data.descripcion;
                        this.tipoAccion = 2;
                        this.rol_id = data.idrol;
                        break;
                    }
                }
            }
        }
     }
            
		}
	}

</script>

<style> 
  .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style> 




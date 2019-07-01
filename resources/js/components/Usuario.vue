<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Usuarios
                <button type="button" @click="abrirModal('usuario','agregar')" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                              <option value="usuario">Usuario</option>
                              <option value="password">Password</option>
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
                            <th>Usuario</th>
                            <th>Password</th>
                            <th>Condición</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in arrayUsuario" :key="usuario.idpersona">
                            <td>
                                <button type="button" @click="abrirModal('usuario','modificar',usuario)" class="btn btn-warning btn-sm" >
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                
                             <template v-if="usuario.condicion">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivar(usuario.idpersona)">
                                    <i class="icon-trash"></i>
                                </button>
                            </template>
                            <template v-else>
                                <button type="button" class="btn btn-info btn-sm" @click="activar(usuario.idpersona)">
                                    <i class="icon-check"></i>
                                </button>
                            </template>   
                                
                             
                                
                            </td>
                            <td v-text="usuario.nombre"></td>
                            <td v-text="usuario.idrol"></td>
                            <td v-text="usuario.usuario"></td>
                            <td v-text="usuario.password"></td>
                            <td>
                            <div v-if="usuario.condicion">
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
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
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
                            <label class="col-md-3 form-control-label" for="text-input">Persona</label>
                            <div class="col-md-9">
                                <select class="form-control" >
                                       <option value="1">--Seleccione una opción--</option> 
                                       <option v-for="categoria in arrayPersona" v-bind:value="categoria.idpersona">{{ categoria.nombre }}</option>
                                </select>
                                <span class="help-block">(*) Seleccione la persona del usuario</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                            <div class="col-md-9">
                                <select class="form-control" >
                                       <option value="1">--Seleccione una opción--</option> 
                                       <option v-for="rol in arrayRol" v-bind:value="rol.idrol">{{ rol.nombre }}</option>
                                </select>
                                <span class="help-block">(*) Seleccione el rol del usuario</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Usuario</label>
                            <div class="col-md-9">
                                <input type="text" v-model="usuario" class="form-control" placeholder="Usuario de categoría">
                                <span class="help-block">(*) Ingrese el usuario de la categoría</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Password</label>
                            <div class="col-md-9">
                                <input type="text" v-model="password" class="form-control" placeholder="Ingrese password">
                            </div>
                        </div>                        
                        <div v-show="errorUsuario" class="form-group row div-error">  
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
</main>
</template>


<script>
 import vSelect from 'vue-select';
 import 'vue-select/dist/vue-select.css';

export default {
	name: 'users',
	data() {
		return {
        idpersona : 0,
        idrol : 0,
  			usuario: '',
        password: '',
        arrayUsuario: [],
        arrayRol: [],
        arrayPersona: [],
        modal : 0,
        titulo : "",
        tipoAccion : 0,
        errorUsuario : 0,
        errorMostrar : [],
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
        },
        offset : 3,
        criterio : 'usuario',
        buscar : ''
		  }
    },
    mounted() {        
        this.cargar();
        this.selectPersona();
        this.selectRol();
    },
    components:{
      vSelect  
    },
	computed: {
 
    isActived: function(){
        return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function() {
        if(!this.pagination.to) {
            return [];
        }

        var from = this.pagination.current_page - this.offset; 
        if(from < 1) {
            from = 1;
        }

        var to = from + (this.offset * 2); 
        if(to >= this.pagination.last_page){
            to = this.pagination.last_page;
        }  

        var pagesArray = [];
        while(from <= to) {
            pagesArray.push(from);
            from++;
        }
        return pagesArray;             

    }
	},
	methods: {
  
      cargar(page) {
        let datos = this;
        var url = '/usuario?page=' + page;
        axios.get(url).then(function (response) {
        var respuesta = response.data;
        datos.arrayUsuario = respuesta.usuarios.data;
        datos.pagination = respuesta.pagination;
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        }); 
        },
        cambiarPagina(page){
          let me = this;
          //Actualiza la página actual
          me.pagination.current_page = page;
          //Envia la petición para visualizar la data de esa página
          me.cargar(page);
        },
     agregar(){
     
         if(this.validar()){
          return;
         }
         
        let me = this;
        axios.post('/usuario/agregar',{
            'idpersona': this.idpersona,
            'idrol': this.idrol,
            'usuario': this.usuario,
            'password': this.password
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();
            
        }).catch(function (error) {
            console.log(error.response);
        });
        
     },
     cerrarModal(){
          this.modal = 0;
          this.idpersona = "";
          this.idrol = "";
          this.titulo = "";
          this.usuario = "";
          this.password = "";
     },
     validar(){
          this.errorUsuario = 0;
          this.errorMostrar = [];
          
          if(!this.idpersona) this.errorMostrar.push("No dejar persona en blanco.");
          if(!this.idrol) this.errorMostrar.push("No dejar rol en blanco.");
          if(!this.usuario) this.errorMostrar.push("No dejar usuarios en blanco.");
          if(!this.password) this.errorMostrar.push("No dejar password en blanco.");
          console.log(this.usuario);
          if(this.errorMostrar.length) this.errorUsuario = 1;
          return this.errorUsuario;
      },
      modificar(){
        if(this.validar()){
          return;
         }
         
        let me = this;
        axios.put('/usuario/actualizar',{
            'idpersona': this.idpersona,
            'idrol': this.idrol,
            'usuario': this.usuario,
            'password': this.password
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();       
            me.selectPersona();
            me.selectRol();
        }).catch(function (error) {
            console.log(error.response);
        });
      
      },
      desactivar(idpersona){
      
        swal({
                title: '¿desea desactivar este usuario?',
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
                    axios.put('/usuario/desactivar',{
                        'idpersona' : idpersona
                    }).then(function (response) {
                        me.cargar();
                        me.selectPersona();
                        me.selectRol();
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error.error);
                    });
                    
                    
                } else if (
                    // Se cierra al cancelar
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
      
      
      },
      
      activar(idpersona){
      
        swal({
                title: '¿desea activar este rol?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    axios.put('/usuario/activar',{
                        'idpersona' : idpersona
                    }).then(function (response) {
                        me.cargar();        
                        me.selectPersona();
                        me.selectRol();
                        swal(
                        'Activado!',
                        'El registro ha sido activado.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error.error);
                    });
                    
                    
                } else if (
                    // Se cierra al cancelar
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
      
      
      },
      
      
     abrirModal(modelo,accion,data = []){
        switch(modelo){
            case "usuario":{
                switch (accion){
                    case "agregar":{
                    this.titulo = "Registrar"
                        this.modal = 1;
                        this.idpersona = "";
                        this.idrol = "";
                        this.usuario = "";
                        this.password = "";
                        this.tipoAccion = 1;
                        break;
                    }
                    
                    case "modificar":{
                    console.log(data);
                      this.titulo = "Actualizar"
                        this.modal = 1;
                        this.idrol = data.idrol;
                        this.usuario = data.usuario;
                        this.password = data.password;
                        this.tipoAccion = 2;
                        this.idpersona = data.idpersona;
                        break;
                    }
                }
            }
        }
     },
     selectPersona(){
          let me=this;

          var url= '/persona/select';
          axios.get(url).then(function (response) {
              let respuesta = response.data;
              me.arrayPersona=respuesta;
              console.log(respuesta);
          })
          .catch(function (error) {
              console.log("Aqui hay eror1" + error.error);
          });
      },
      selectRol(){
          let me=this;

          var url= '/rol/select';
          axios.get(url).then(function (response) {
              let respuesta = response.data;
              me.arrayRol=respuesta;
              console.log(respuesta);
          })
          .catch(function (error) {
              console.log("Aqui hay eror1" + error.error);
          });
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
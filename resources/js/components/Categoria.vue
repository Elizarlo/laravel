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
                <i class="fa fa-align-justify"></i> Categorías
                <button type="button" @click="abrirModal('categoria','agregar')" class="btn btn-secondary" >
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
                        <tr v-for="categoria in arrayCategoria" :key="categoria.idcategoria">
                            <td>
                                <button type="button" @click="abrirModal('categoria','modificar',categoria)" class="btn btn-warning btn-sm" >
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                
                             <template v-if="categoria.condicion">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivar(categoria.idcategoria)">
                                    <i class="icon-trash"></i>
                                </button>
                            </template>
                            <template v-else>
                                <button type="button" class="btn btn-info btn-sm" @click="activar(categoria.idcategoria)">
                                    <i class="icon-check"></i>
                                </button>
                            </template>   
                                
                             
                                
                            </td>
                            <td v-text="categoria.nombre"></td>
                            <td v-text="categoria.descripcion"></td>
                            <td>
                            <div v-if="categoria.condicion">
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
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                                <span class="help-block">(*) Ingrese el nombre de la categoría</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                            <div class="col-md-9">
                                <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese descripcion">
                            </div>
                        </div>                        
                        <div v-show="errorCategoria" class="form-group row div-error">  
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
 
export default {
	name: 'categories',
	data() {
		return {
        categoria_id : 0,
  			nombre: '',
        descripcion: '',
        arrayCategoria: [],
        modal : 0,
        titulo : "",
        tipoAccion : 0,
        errorCategoria : 0,
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
        criterio : 'nombre',
        buscar : ''
		  }
    },
    mounted() {        
        this.cargar();
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
        var url = '/categoria?page=' + page;
        axios.get(url).then(function (response) {
        var respuesta = response.data;
        datos.arrayCategoria = respuesta.categorias.data;
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
        axios.post('/categoria/agregar',{
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
          this.errorCategoria = 0;
          this.errorMostrar = [];
          
          if(!this.nombre) this.errorMostrar.push("No dejar categorias en blanco.");
          if(!this.descripcion) this.errorMostrar.push("No dejar descripcion en blanco.");
          console.log(this.nombre);
          if(this.errorMostrar.length) this.errorCategoria = 1;
          return this.errorCategoria;
      },
      modificar(){
        if(this.validar()){
          return;
         }
         
        let me = this;
        axios.put('/categoria/actualizar',{
            'nombre': this.nombre,
            'descripcion': this.descripcion,
            'idcategoria' : this.categoria_id
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();            
        }).catch(function (error) {
            console.log(error.response);
        });
      
      },
      desactivar(idcategoria){
      
        swal({
                title: '¿desea desactivar esta categoría?',
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
                    axios.put('/categoria/desactivar',{
                        'idcategoria' : idcategoria
                    }).then(function (response) {
                        me.cargar();
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
      
      activar(idcategoria){
      
        swal({
                title: '¿desea activar esta categoría?',
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
                    axios.put('/categoria/activar',{
                        'idcategoria' : idcategoria
                    }).then(function (response) {
                        me.cargar();
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
            case "categoria":{
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
                        this.categoria_id = data.idcategoria;
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




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
                <i class="fa fa-align-justify"></i> Ingresos
                <button type="button" @click="mostrarDetalle()" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <template v-if="listado">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                              <option value="proveedor">Proveedor</option>
                              <option value="tipo_comprobante">Tipo comprobante</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre Usuario</th>
                            <th>Proveedor</th>
                            <th>Tipo Comprobante</th>
                            <th>Serie Comprobante</th>
                            <th>Número Comprobante</th>
                            <th>Fecha Hora</th>
                            <th>Total Compra</th>
                            <th>Impuesto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ingreso in arrayIngreso" :key="ingreso.idingreso">
                            <td>
                                <button type="button" @click="abrirModal('ingreso','modificar',ingreso)" class="btn btn-success btn-sm" >
                                  <i class="icon-eye"></i>
                                </button> &nbsp;
                                
                             <template v-if="ingreso.estado == 'Registrado' ">
                                <button type="button" class="btn btn-danger btn-sm" @click="desactivar(ingreso.idingreso)">
                                    <i class="icon-trash"></i>
                                </button>
                            </template>
                            <template v-else>
                                <button type="button" class="btn btn-info btn-sm" @click="activar(ingreso.idingreso)">
                                    <i class="icon-check"></i>
                                </button>
                            </template>  
                            </td>
                            <td v-text="ingreso.usuario"></td>
                            <td v-text="ingreso.nombre"></td>
                            <td v-text="ingreso.tipo_comprobante"></td>
                            <td v-text="ingreso.serie_comprobante"></td>
                            <td v-text="ingreso.num_comprobante"></td>
                            <td v-text="ingreso.fecha_hora"></td>
                            <td v-text="ingreso.total_compra"></td>
                            <td v-text="ingreso.impuesto"></td>
                                        
                                        
                            <td>
                            <div v-if="ingreso.estado == 'Registrado'">
                                <span class="badge badge-success">Registrado</span>
                            </div>
                            <div v-else>
                                <span class="badge badge-danger">Nulado</span>
                            </div>
                                
                            </td>
                        </tr>                        
                    </tbody>
                </table>
                </div>
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
            </template>
            <!--Fin listado-->
            <!-- Inicio Detalle-->
            <template v-else>
            <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Proveedor(*)</label>
                                    <select class="form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Impuesto(*)</label>
                                <input type="text" class="form-control" v-model="impuesto">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo Comprobante(*)</label>
                                    <select class="form-control" v-model="tipo_comprobante">
                                        <option value="0">Seleccione</option>
                                        <option value="Boleta">Boleta</option>
                                        <option value="Factura">Factura</option>
                                        <option value="Ticket">Ticket</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Serie Comprobante</label>
                                    <input type="text" class="form-control" v-model="serie_comprobante" placeholder="000x">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Número Comprobante(*)</label>
                                    <input type="text" class="form-control" v-model="num_comprobante" placeholder="000xx">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Artículo</label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" v-model="idarticulo" placeholder="Ingrese artículo">
                                        <button class="btn btn-primary">...</button>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input type="number" value="0" step="any" class="form-control" v-model="precio">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" value="0" class="form-control" v-model="cantidad">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Artículo</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Artículo n
                                            </td>
                                            <td>
                                                <input type="number" value="3" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" value="2" class="form-control">
                                            </td>
                                            <td>
                                                $ 6.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td>
                                                Artículo n
                                            </td>
                                            <td>
                                                <input type="number" value="3" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" value="2" class="form-control">
                                            </td>
                                            <td>
                                                $ 6.00
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Parcial:</strong></td>
                                            <td>$ 5</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>$ 1</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ 6</td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarIngreso()">Registrar Compra</button>
                            </div>
                        </div>
                    </div>
            </template>
            <!-- Fin Detale-->
            
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
        ingreso_id: 0,
        idproveedor:0,
        proveedor:'',
        fecha_hora:'',
        nombre : '',
        tipo_comprobante : 'Boleta',
        serie_comprobante : '',
        num_comprobante : '',
        impuesto: 0.18,
        total:0.0,
        totalImpuesto: 0.0,
        totalParcial: 0.0,
        arrayIngreso : [],
        arrayProveedor: [],
        arrayDetalle : [],
        listado:0,
                
        modal : 0,
        titulo : "",
        tipoAccion : 0,
        errorIngreso : 0,
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
        criterio : 'num_comprobante',
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
        var url = '/ingreso?page=' + page;
        axios.get(url).then(function (response) {
        var respuesta = response.data;
        datos.arrayIngreso = respuesta.ingresos.data;
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
      
     mostrarDetalle(){
          this.listado=0;
      },
      ocultarDetalle(){
          this.listado=1;
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
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }
</style> 




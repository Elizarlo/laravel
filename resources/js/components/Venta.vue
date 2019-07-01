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
                <i class="fa fa-align-justify"></i> Ventas
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
                              <option value="persona">Persona</option>
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
                            <th>Persona</th>
                            <th>Tipo Comprobante</th>
                            <th>Serie Comprobante</th>
                            <th>Número Comprobante</th>
                            <th>Fecha Hora</th>
                            <th>Total Venta</th>
                            <th>Impuesto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="venta in arrayVenta" :key="venta.idventa">
                            <td>
                                                               
                             <template v-if="venta.estado == 'Registrado' ">
                                <button type="button" class="btn btn-success btn-sm" >
                                    <i class="icon-check"></i>
                                </button>
                            </template>
                            <template v-else>
                                <button type="button" class="btn btn-info btn-sm" >
                                    <i class="icon-eye"></i>
                                </button>
                            </template>  
                            </td>
                            <td v-text="venta.usuario"></td>
                            <td v-text="venta.nombre"></td>
                            <td v-text="venta.tipo_comprobante"></td>
                            <td v-text="venta.serie_comprobante"></td>
                            <td v-text="venta.num_comprobante"></td>
                            <td v-text="venta.fecha_hora"></td>
                            <td v-text="venta.total_venta"></td>
                            <td v-text="venta.impuesto"></td>
                                        
                                        
                            <td>
                            <div v-if="venta.estado == 'Registrado'">
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
                                    <label for="">Persona(*)</label>
                                    <select class="form-control" ref="personaSelect">
                                       <option v-for="persona in arrayPersona" v-bind:value="persona.idpersona">{{ persona.nombre }}</option>
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
                            <div class="col-md-12">
                                <div v-show="errorMostrar" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrar" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Artículo (Seleccione codigo)</label>
                                    <div class="form-inline">
                                        <select class="form-control" ref="articuloSelect">
                                           <option v-for="articulo in arrayArticulo" v-bind:value="articulo.idarticulo">{{ articulo.codigo }}</option>
                                        </select>
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
                                    <button  @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
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
                                            <th>Descuento</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.iddetalle_venta">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.articulo">
                                            </td>
                                            <td>
                                                <input v-model="detalle.precio_venta" type="number" class="form-control">
                                            </td>
                                            <td>
                                                <input v-model="detalle.cantidad" type="number" class="form-control">
                                            </td>
                                            <td>
                                                <input v-model="detalle.descuento" type="number" class="form-control">
                                            </td>
                                            <td>
                                                {{(detalle.precio_venta*detalle.cantidad-detalle.descuento)}}
                                            </td>
                                        </tr>
                                        
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="5" align="right"><strong>Total Parcial:</strong></td>
                                            <td>$ {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="5" align="right"><strong>Total Impuesto:</strong></td>
                                            <td>$ {{totalImpuesto=((total*impuesto)/(1+impuesto)).toFixed(2)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="5" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{total=calcularTotal}}</td>
                                        </tr>
                                    </tbody>     
                                    
                                    <tbody v-else>     
                                      <tr>  
                                        <td colspan="6">
                                            No hay datos
                                        </td>
                                      </tr>
                                    </tbody>     
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarVenta()">Registrar Compra</button>
                            </div>
                        </div>
                    </div>
            </template>
            <!-- Fin Detale-->
            
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    
</main>
</template>


<script>
 import vSelect from 'vue-select';
 import 'vue-select/dist/vue-select.css';

export default {
	name: 'categories',
	data() {
		return {
        venta_id: 0,
        idpersona:0,
        persona:'',
        fecha_hora:'',
        nombre : '',
        tipo_comprobante : 'Boleta',
        serie_comprobante : '',
        num_comprobante : '',
        impuesto: 0.18,
        total:0.0,
        totalImpuesto: 0.0,
        totalParcial: 0.0,
        arrayVenta : [],
        arrayPersona: [],
        arrayArticulo: [],
        arrayDetalle : [],
        listado:1,
        
        idarticulo: 0,
        codigo: '',
        articulo: '',
        descuento: 0,
        precio: 0,
        cantidad:0,

        
                
        modal : 0,
        titulo : "",
        tipoAccion : 0,
        errorVenta : 0,
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
        buscar : '',
        x : 0
		  }
    },
    mounted() {        
        this.cargar();
        this.selectPersona();
        this.selectArticulo();
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

    },
    calcularTotal: function(){
        var resultado=0.0;
        for(var i=0;i<this.arrayDetalle.length;i++){
            resultado=resultado+(this.arrayDetalle[i].precio_venta*this.arrayDetalle[i].cantidad-this.arrayDetalle[i].descuento)
        }
        return resultado;
    }
    
    
	},
	methods: {
      cargar(page) {
        let datos = this;
        var url = '/venta?page=' + page;
        axios.get(url).then(function (response) {
        var respuesta = response.data;
        datos.arrayVenta = respuesta.ventas.data;
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
      
     registrarVenta(){
        if (this.validar()){
            return;
        }

        let me = this;

        console.log( this.$refs.articuloSelect.value + " this.tipo_comprobante " + this.serie_comprobante + " " + 
       this.num_comprobante + " " + this.impuesto + " " + this.total  + " " + this.arrayDetalle);
        axios.post('/venta/agregar',{
            'idpersona': this.$refs.personaSelect.value,
            'tipo_comprobante': this.tipo_comprobante,
            'serie_comprobante' : this.serie_comprobante,
            'num_comprobante' : this.num_comprobante,
            'impuesto' : this.impuesto,
            'total_venta' : this.total,
            'data': this.arrayDetalle

        }).then(function (response) {
            me.listado=1;
            me.cargar();
            me.idpersona=0;
            me.tipo_comprobante='Boleta';
            me.serie_comprobante='';
            me.num_comprobante='';
            me.impuesto=0.18;
            me.total=0.0;
            me.idarticulo=0;
            me.articulo='';
            me.cantidad=0;
            me.precio=0;
            me.descuento=0;
            me.arrayDetalle=[];

        }).catch(function (error) {
            console.log("Error" + error.message);
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
                    
          
          if (this.serie_comprobante==0) this.errorMostrar.push("Seleccione el serie comprobante");
          if (this.tipo_comprobante==0) this.errorMostrar.push("Seleccione el comprobante");
          if (!this.num_comprobante) this.errorMostrar.push("Ingrese el número de comprobante");
          if (!this.impuesto) this.errorMostrar.push("Ingrese el impuesto de venta");
          if (this.arrayDetalle.length<=0) this.errorMostrar.push("Ingrese detalles");

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
          this.idpersona=0;
          this.tipo_comprobante='Boleta';
          this.serie_comprobante='';
          this.num_comprobante='';
          this.impuesto=0.18;
          this.total=0.0;
          this.idarticulo=0;
          this.articulo='';
          this.cantidad=0;
          this.descuento=0;
          this.precio=0;
          this.arrayDetalle=[];
      },
     ocultarDetalle(){
          this.listado=1;
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
              console.log("Aqui hay ero2r" + error.error);
          });
      },
      
     selectArticulo(){
          let me=this;

          var url= '/articulo/select';
          axios.get(url).then(function (response) {
              let respuesta = response.data;
              me.arrayArticulo=respuesta;
              console.log(respuesta);
          })
          .catch(function (error) {
              console.log("Aqui hay eror1" + error.error);
          });
      },
     
     agregarDetalle(){
        let me = this;
        
        for (me.x=0 ; me.x < me.arrayArticulo.length ; me.x++ ){
            if( me.arrayArticulo[me.x].idarticulo == me.$refs.articuloSelect.value){
              me.articulo =  me.arrayArticulo[me.x].nombre;
            }
        }
        
        if(me.cantidad == 0 || me.precio_venta == 0){
          swal({
            type: 'error',
            title: 'Error...',
            text: 'Agrega Precio o Cantidad!',
          })
          return;
        }else{
            if(me.encuentra(me.$refs.articuloSelect.value)){
                swal({
                    type: 'error',
                    title: 'Error...',
                    text: 'Ese artículo ya se encuentra agregado!',
                    })
            }else{
              me.arrayDetalle.push({
                  idarticulo : me.$refs.articuloSelect.value,
                  articulo : me.articulo,
                  cantidad : me.cantidad,
                  descuento : me.descuento,
                  precio_venta : me.precio
              });
            }
        }
     },
     encuentra(id){
        var sw=0;
        for(var i=0;i<this.arrayDetalle.length;i++){
            console.log("Datos" + this.arrayDetalle[i].idarticulo + " " +  id);
            if(this.arrayDetalle[i].idarticulo==id){
                sw=true;
            }
        }
        return sw;
    },
      eliminarDetalle(index){
        let me = this;
        me.arrayDetalle.splice(index, 1);
    },
     
           
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




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
                <i class="fa fa-align-justify"></i> Proveedor
                <button type="button" @click="abrirModal('persona','agregar')" class="btn btn-secondary" >
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
                            <th>Tipo Documento</th>
                            <th>Número</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="persona in arrayPersona" :key="persona.idpersona">
                            <td>
                                <button type="button" @click="abrirModal('persona','modificar',persona)" class="btn btn-warning btn-sm">
                                  <i class="icon-pencil"></i>
                                </button>
                            </td>
                            <td v-text="persona.nombre"></td>
                            <td v-text="persona.tipo_documento"></td>
                            <td v-text="persona.num_documento"></td>
                            <td v-text="persona.direccion"></td>
                            <td v-text="persona.telefono"></td>
                            <td v-text="persona.email"></td>
                            <td v-text="persona.contacto"></td>
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
                                    <label class="col-md-3 form-control-label" >Datos de persona (Proveedor)</label>
                                </div>
                        <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Nombre </label>
                              <div class="col-md-9">
                                  <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la persona">                                        
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Tipo Documento</label>
                              <div class="col-md-9">
                                  <select v-model="tipo_documento" class="form-control">
                                      <option value="INE" selected>INE</option>
                                      <option value="CURP">CURP</option>
                                      <option value="VISA">VISA</option>
                                  </select>                                    
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Número de documento</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="num_documento" class="form-control" placeholder="Número de documento">                                        
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Dirección</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="direccion" class="form-control" placeholder="Dirección">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Teléfono</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="telefono" class="form-control" placeholder="Teléfono">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Email</label>
                              <div class="col-md-9">
                                  <input type="email" v-model="email" class="form-control" placeholder="Email">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" >Datos del proveedor</label>
                          </div>

                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Contacto</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="contacto" class="form-control" placeholder="Nombre del contacto">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Teléfono de contacto</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="telefono_contacto" class="form-control" placeholder="Teléfono del contacto">
                              </div>
                          </div>
                        
                        
                        <div v-show="errorPersona" class="form-group row div-error">  
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
        persona_id: 0,
        nombre : '',
        tipo_documento : 'INE',
        num_documento : '',
        direccion : '',
        telefono : '',
        email : '',
        contacto : '',
        telefono_contacto : '',
        arrayPersona: [],
        
        
        modal : 0,
        titulo : "",
        tipoAccion : 0,
        errorPersona : 0,
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
        var url = '/proveedor?page=' + page;
        axios.get(url).then(function (response) {
        var respuesta = response.data;
        datos.arrayPersona = respuesta.personas.data;
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
        axios.post('/proveedor/agregar',{
             'nombre': this.nombre,
              'tipo_documento': this.tipo_documento,
              'num_documento' : this.num_documento,
              'direccion' : this.direccion,
              'telefono' : this.telefono,
              'email' : this.email,
              'contacto': this.contacto,
              'telefono_contacto': this.telefono_contacto
                    
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();
            
        }).catch(function (error) {
            console.log(error.response);
        });
        
     },
    
    cerrarModal(){
          this.modal=0;
          this.tituloModal='';
          this.nombre='';
          this.tipo_documento='RUC';
          this.num_documento='';
          this.direccion='';
          this.telefono='';
          this.email='';
          this.contacto='';
          this.telefono_contacto='';
          this.errorPersona=0;
     },
 
    validar(){
          this.errorPersona = 0;
          this.errorMostrar = [];
          
          if(!this.nombre) this.errorMostrar.push("No dejar nombre en blanco.");
          if(!this.tipo_documento) this.errorMostrar.push("No dejar Tipo documento en blanco.");
          if(!this.num_documento) this.errorMostrar.push("No dejar numero documento en blanco.");
          if(!this.direccion) this.errorMostrar.push("No dejar direccion en blanco.");
          if(!this.telefono) this.errorMostrar.push("No dejar telefono en blanco.");
          if(!this.email) this.errorMostrar.push("No dejar email en blanco.");
          if(!this.contacto) this.errorMostrar.push("No dejar contacto en blanco.");
          if(!this.telefono_contacto) this.errorMostrar.push("No dejar telefono contacto en blanco.");
          
          if(this.errorMostrar.length) this.errorPersona = 1;
          return this.errorPersona;
      },
 
    modificar(){
        if(this.validar()){
          return;
         }
         
        let me = this;
        axios.put('/proveedor/actualizar',{
             'nombre': this.nombre,
              'tipo_documento': this.tipo_documento,
              'num_documento' : this.num_documento,
              'direccion' : this.direccion,
              'telefono' : this.telefono,
              'email' : this.email,
              'contacto': this.contacto,
              'telefono_contacto': this.telefono_contacto,
              'idpersona': this.persona_id
        }).then(function (response) {
            me.cerrarModal();
            me.cargar();            
        }).catch(function (error) {
            console.log(error.response);
        });
      
      },
    
      
    abrirModal(modelo,accion,data = []){
        switch(modelo){
            case "persona":{
                switch (accion){
                    case "agregar":{
                      this.titulo = "Registrar"
                      this.modal = 1;
                      this.nombre= '';
                      this.tipo_documento='INE';
                      this.num_documento='';
                      this.direccion='';
                      this.telefono='';
                      this.email='';
                      this.contacto='';
                      this.telefono_contacto='';
                      this.tipoAccion = 1;
                        break;
                    }
                    
                    case "modificar":{
                    console.log(data);
                        this.titulo = "Actualizar"
                        this.modal = 1;
                        this.tipoAccion = 2;                        
                        this.persona_id=data['idpersona'];
                        this.nombre = data['nombre'];
                        this.tipo_documento = data['tipo_documento'];
                        this.num_documento = data['num_documento'];
                        this.direccion = data['direccion'];
                        this.telefono = data['telefono'];
                        this.email = data['email'];
                        this.contacto = data['contacto'];
                        this.telefono_contacto = data['telefono_contacto'];

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




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
                        <i class="fa fa-align-justify"></i> Artículos
                        <button type="button" @click="abrirModal('product','registrar')" class="btn btn-secondary">
                            <i class="fas fa-plus"></i>&nbsp;Nuevo
                        </button>
                        <!--
                        <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Reporte 
                        </button>
                        -->
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProducto(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProducto(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th></th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio Venta</th>
                                    <th>Stock Actual</th>
                                    <th>Stock Minimo</th>
                                    <th>Stock Maximo</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in arrayProducto" :key="product.id">
                                    <td>
                                        <button type="button" @click="abrirModal('product','actualizar',product)" class="btn btn-warning btn-sm">
                                          <i class="fas fa-pen"></i>
                                        </button> &nbsp;
                                        <template v-if="product.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarProducto(product.id)">
                                                 <i class="fas fa-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarArticulo(product.id)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td><img v-bind:src="'/storage/'+product.thumbnail"></td>
                                    <td v-text="product.codigo"></td>
                                    <td v-text="product.nombre"></td>
                                    <td v-text="product.nombre_categoria"></td>
                                    <td v-text="product.precio"></td>
                                    <td v-text="product.stockactual"></td>
                                    <td v-text="product.stockminimo"></td>
                                    <td v-text="product.stockmaximo"></td>
                                    <td v-text="product.descripcion"></td>
                                    <td>
                                        <div v-if="product.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
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
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div v-if="!next">
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Categoría</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Código</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="codigo" class="form-control" placeholder="Código de barras"> 
                                        <barcode :value="codigo" :options="{ format: 'EAN-13' }">
                                            Generando código de barras.    
                                        </barcode>                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de artículo">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio Venta</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="precio" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <textarea cols="30" class="form-control" placeholder="Ingrese descripción" v-model="descripcion"  rows="1" style="min-height:100px;overflow: hidden;resize: none;"></textarea>
                                    </div>
                                </div>
                                <div v-show="errorArticulo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjArticulo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="nextPage()">Seguiente</button>
                            </div>
                        </div>
                         <div v-if="next">
                             <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Stock Minimo</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="stockMinimo" class="form-control" placeholder="">                                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Stock Maximo</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="stockMaximo" class="form-control" placeholder="">                                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Stock Actual</label>
                                        <div class="col-md-9">
                                            <input type="number" v-model="stockActual" class="form-control" placeholder="">                                        
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12" >
                                            <div class="Jcontainer">
                                                <input type="file" @change="onFileSelected" id="file" class="form-control Jinputfile" placeholder=""> 
                                                <label class="form-control-label" for="file" v-bind:style="{ background: 'url('+image.url+')'}">
                                                    <i class="fas fa-file-upload"></i><br>
                                                    <span class="JfileLabel" v-if="!isImage">Subir imagen</span>
                                                    <span class="JfileLabel--image" v-if="isImage">{{image.name}}</span>
                                                </label>  
                                            </div>                                
                                        </div>
                                    </div>
                                    
                                    <div v-show="errorArticulo" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjArticulo" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="nextPage()">{{nameNextPage}}</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="onUpload(0)">Guardar</button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="updateData()">Actualizar</button>
                            </div>
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
    import VueBarcode from 'vue-barcode';
    export default {
        data (){
            return {
                producto_id: 0,
                idcategoria : 0,
                nombre_categoria : '',
                codigo : '',
                nombre : '',
                precio : 0,
                selectedFile:null,
                image:{
                    name:'',
                    url:'',
                },
                new_image:{
                    thumbnail:'',
                    medium:'',
                    large:'',
                    full:'',
                    checked: false,
                },
                stockMaximo : 0,
                stockMinimo : 0,
                stockActual : 0,
                descripcion : '',
                arrayProducto : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorArticulo : 0,
                next: false,
                nameNextPage: "Seguiente",
                errorMostrarMsjArticulo : [],
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
                buscar : '',
                arrayCategoria :[]
            }
        },
        components: {
        'barcode': VueBarcode
    },
        computed:{
            isImage(){
                if(!this.image.url==''){
                    return true;
                }
                return false;
            },
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
        methods : {
            nextPage: function(){
                this.next=!this.next;
                if(this.next==true){
                    this.nameNextPage="Atras"
                }
                else{
                    this.nameNextPage="Seguiente"
                }
            },
            onFileSelected: function(event){
                this.image.name=event.target.files[0].name;
                var fileReader=new FileReader()
                fileReader.readAsDataURL(event.target.files[0]);
                fileReader.onload=(e)=>{
                    this.image.url=e.target.result;
                    console.log(e.target);
                }
                /*
                this.selectedFile=event.target.files[0];
                console.log(this.selectedFile);
                */
            },
            onUpload: function(action){
                axios.post('/dashboard/upload-image',{
                    'fileUpload': this.image.url,
                },
                {
                    onUploadProgress: uploadEvent=>{
                        console.log('Upload profess: '+Math.round(uploadEvent.loaded/uploadEvent.total*100))
                    }
                }).then(response=>{
                    this.new_image.thumbnail=response.data.thumbnail;
                    this.new_image.large=response.data.large;
                    this.new_image.medium=response.data.medium;
                    this.new_image.full=response.data.full;
                    this.new_image.checked=true;
                    console.log(this.new_image.thumbnail,response);
                   
                    if(action==0){
                        this.registrarProducto();
                    }
                    else{
                        this.actualizarProducto();
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            listarProducto (page,buscar,criterio){
                let me=this;
                var url= '/dashboard/producto?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.productos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cargarPdf(){
                window.open('http://localhost:8000/producto/listarPdf','_blank');
            },
            selectCategoria(){
                let me=this;
                var url= '/dashboard/categoria/selectCategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarProducto(page,buscar,criterio);
            },
            registrarProducto(){
                if (this.validarProducto()){
                    return;
                }
                let me = this;
                if(this.new_image.checked==true){
                    axios.post('/dashboard/producto/registrar',{
                    'idcategoria': this.idcategoria,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'stockminimo': this.stockMinimo,
                    'stockmaximo': this.stockMaximo,
                    'stockactual': this.stockActual,
                    'precio': this.precio,
                    'descripcion': this.descripcion,
                    'thumbnail': this.new_image.thumbnail,
                    'medium': this.new_image.medium,
                    'large': this.new_image.large,
                    'full': this.new_image.full,
                    }).then(function (response) {
                        this.new_image.checked=false;
                        me.cerrarModal();
                        me.listarProducto(1,'','nombre');
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            updateData(){
                 if(this.image.url!=='/storage/'+this.new_image.full){
                    this.onUpload(1);
                    console.log('diferente')
                }
                else{
                    this.actualizarProducto();
                }
            },
            actualizarProducto(){
               if (this.validarProducto()){
                    return;
                }
                
                let me = this;
               
                axios.put('/dashboard/producto/actualizar',{
                    'idcategoria': this.idcategoria,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'stockminimo': this.stockMinimo,
                    'stockmaximo': this.stockMaximo,
                    'stockactual': this.stockActual,
                    'precio': this.precio,
                    'descripcion': this.descripcion,
                    'thumbnail': this.new_image.thumbnail,
                    'medium': this.new_image.medium,
                    'large': this.new_image.large,
                    'full': this.new_image.full,
                    'id': this.producto_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProducto(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarProducto(id){
               swal({
                title: 'Esta seguro de desactivar este artículo?',
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

                    axios.put('/dashboard/producto/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProducto(1,'','nombre');
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
            activarArticulo(id){
               swal({
                title: 'Esta seguro de activar este artículo?',
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

                    axios.put('/dashboard/producto/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProducto(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
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
            validarProducto(){
                this.errorArticulo=0;
                this.errorMostrarMsjArticulo =[];

                if (this.idcategoria==0) this.errorMostrarMsjArticulo.push("Seleccione una categoría.");
                if (!this.nombre) this.errorMostrarMsjArticulo.push("El nombre del artículo no puede estar vacío.");
                if (!this.stockMaximo) this.errorMostrarMsjArticulo.push("El stock maximo del artículo debe ser un número y no puede estar vacío.");
                if (!this.stockMinimo) this.errorMostrarMsjArticulo.push("El stock  minimo del artículo debe ser un número y no puede estar vacío.");
                if (!this.precio) this.errorMostrarMsjArticulo.push("El precio venta del artículo debe ser un número y no puede estar vacío.");

                if (this.errorMostrarMsjArticulo.length) this.errorArticulo = 1;

                return this.errorArticulo;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idcategoria= 0;
                this.nombre_categoria = '';
                this.codigo = '';
                this.nombre = '';
                this.precio = 0;
                this.stockMinimo = 0;
                this.stockMaximo = 0;
                this.stockActual = 0;
                this.descripcion = '';
		        this.errorArticulo=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "product":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Artículo';
                                this.idcategoria=0;
                                this.nombre_categoria='';
                                this.codigo='';
                                this.nombre= '';
                                this.precio=0;
                                this.stockMaximo=0;
                                this.stockMinimo=0;
                                this.stockActual=0;
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Artículo';
                                this.tipoAccion=2;
                                this.producto_id=data['id'];
                                this.idcategoria=data['idcategoria'];
                                this.codigo=data['codigo'];
                                this.nombre = data['nombre'];
                                this.stockMaximo=data['stockmaximo'];
                                this.stockMinimo=data['stockminimo'];
                                this.stockActual=data['stockactual'];
                                this.precio=data['precio'];
                                this.descripcion= data['descripcion'];
                                this.new_image.thumbnail=data['thumbnail'];
                                this.new_image.medium=data['medium'];
                                this.new_image.large=data['large'];
                                this.new_image.full=data['image'];
                                this.image.url='/storage/'+data['image'];
                                break;
                            }
                        }
                    }
                }
                this.selectCategoria();
            }
        },
        mounted() {
            this.listarProducto(1,this.buscar,this.criterio);
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
    .Jcontainer{
        width: 30%;
        min-width: 250px;
        text-align: center;
        margin: 0 auto;
        height: 250px;
    }
    .Jinputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .Jinputfile + label {
            position: relative;
            font-size: 70px;
            width: 100%;
            text-align: center;
            cursor: pointer;
            height: 100%;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            color: #151b1f;
            background-repeat: round !important;
            display: flex;
    }
    .JfileLabel{
        position: absolute;
        bottom: 30px;
        font-size:18px;
    }
    .JfileLabel--image{
        position: absolute;
        bottom: 30px;
        font-size:18px;
        min-width: 200px;
        max-width: 200px;
        overflow: hidden;
    }
    

    .Jinputfile:focus + label,
    .Jinputfile + label:hover {
        outline: 1px dotted #000;
	    outline: -webkit-focus-ring-color auto 5px;
    }
</style>

<template>
        <main>
            <div class="modal fade" id="validar">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> Agregar  {{producto.nombre}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="block1 hov-img-zoom pos-relative m-b-30">
                            <img v-bind:src="'/storage/'+producto.large" alt="IMG-BENNER">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" name="btnAceptar" @click="guardarDatosVenta()" id="btnaceptar" data-dismiss="modal">
                        <i class="fa fa-check"></i>Agregar</button>
                    </div>

                    </div>
                </div>
            </div>
            <div class="row" v-if="tabs[0].active">
                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto"  v-for="product in arrayProducto" :key="product.id">
                    <!-- block1 -->
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <img v-bind:src="'/storage/'+product.large" alt="IMG-BENNER">
                        <div class="block1-wrapbtn w-size2">
                            <!-- Button -->
                            <a @click="addProducto(product)" data-toggle="modal" data-target="#validar" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                {{product.nombre}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="row" v-if="tabs[1].active">
                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                    <!-- block1 
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <img v-bind:src="'/storage/'+producto.large" alt="IMG-BENNER">
                        <div class="block1-wrapbtn w-size2">
                             {{producto.nombre}}
                        </div>
                    </div>
                </div>
            </div>
            -->
        </main>
</template>

<script>
    import VueBarcode from 'vue-barcode';
    export default {
        data (){
            return {
                tabs:[
                    {key:1,title:'tab1',active:true,isvalidate:false},
                    {key:2,title:'tab2',active:false,isvalidate:false},
                    {key:3,title:'tab3',active:false,isvalidate:false},
                    {key:4,title:'tab4',active:false,isvalidate:false},
                    {key:5,title:'tab5',active:false,isvalidate:false},
                    ],
                producto:{},
                producto_id: 0,
                idcategoria : 0,
                nombre_categoria : '',
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
                arrayProducto : [],
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
            addProducto: function(product){
                this.producto=product;
                //this.isTabsActive(1);
            },
            isTabsActive: function(index){
                for(var i=0; i<this.tabs.length;i++){
                this.tabs[i].active=false;
                }
                this.tabs[index].active=true;
            },
            nextPage: function(){
                this.next=!this.next;
                if(this.next==true){
                    this.nameNextPage="Atras"
                }
                else{
                    this.nameNextPage="Seguiente"
                }
            },
            guardarDatosVenta:function(){
                console.log(this.producto);
                var url='/add-producto-carrito';
                axios.post(url,{
                    'producto':this.producto,
                })
                .then(response=>{
                    console.log(response);
                    this.producto=[];
                })
                .catch(error=>{
                    console.log(error);
                }); 
            },
            listarProducto (page,buscar,criterio){
                let me=this;
                var url= '/producto?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
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
        },
        mounted() {
            this.listarProducto(1,this.buscar,this.criterio);
        }
    }
</script>
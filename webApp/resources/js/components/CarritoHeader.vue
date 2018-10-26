<template>
    <main>
        <div class="header-icons">
					<a href="/login" class="header-wrapicon1 dis-block">
						<img src="/cliente/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<img @click="abrirCarrito()" src="/cliente/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">{{count}}</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown" v-bind:class="{'header-cart header-dropdown show-header-dropdown':isActiveDrop}">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item"  v-for="product in arrayProducto" :key="product.id">
									<div class="header-cart-item-img" @click="deleteProduct(product.id)">
                                        
										<img v-if="product.attributes.medium" v-bind:src="'/storage/'+product.attributes.medium" alt="IMG">
                                        <img v-if="!product.attributes.medium" src="/cliente/images/item-cart-01.jpg" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
                                            {{product.name}}
                                        </a>

										<span class="header-cart-item-info">
											{{product.quantity}} x S/. {{product.price}}
										</span>
									</div>
								</li>
							</ul>

							<div class="header-cart-total">
								S/. {{total}}
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="/carrito" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Ver carrito
									</a>
								</div>

							</div>
						</div>
					</div>
				</div>
    </main>
</template>
<script>
    import login from './login.vue';
    import toastr from 'toastr';
    export default {
        data (){
            return {
                count:0,
                isActiveDrop:false,
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
                total:0,
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
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayCategoria :[],
                idUser:false,
                dataUser:[],
            }
        },
        components: {
        'login-component': login
    },
        computed:{
            isImage(){
                if(!this.image.url==''){
                    return true;
                }
                return false;
            },
        },
        methods : {
            abrirCarrito: function(){
                this.isActiveDrop=!this.isActiveDrop;
                this.listarProducto();
            },
            addSum:function(product){
                var url='/action-producto-carrito';
                axios.post(url,{
                    'producto':product,
                    'accion':'sum'
                })
                .then(response=>{
                    console.log(response);
                    this.listarProducto();
                })
                .catch(error=>{
                    console.log(error);
                }); 
            },
            addRest:function(product){
                 var url='/action-producto-carrito';
                axios.post(url,{
                    'producto':product,
                    'accion':'rest'
                })
                .then(response=>{
                    console.log(response);
                    this.listarProducto();
                })
                .catch(error=>{
                    console.log(error);
                }); 
            },
            deleteProduct: function(id){
                var url='/delete-producto-carrito';
                axios.post(url,{
                    'id':id,
                })
                .then(response=>{
                    this.listarProducto();
                })
                .catch(error=>{
                    console.log(error);
                })
            },
            realizarCompra:function(){
                var url='/procesar-compra-producto-carrito';
                axios.post(url,{})
                .then(response=>{
                    toastr.success('Comprar realizada','Exito');
                    this.isTabsActive(0);
                    this.idUser=false;
                    this.listarProducto()
                })
                .catch(error=>{
                    toastr.error('Comprar no realizada','Error')
                }); 
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
            checkedUser:function(){
                let me=this;
                var url= '/ckecked-user-login';
                axios.get(url).then(response=>{
                   
                    if(!response.data.error){
                        this.dataUser=response.data.data
                    }
                    this.idUser=!response.data.error
                    console.log(this.idUser)
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                var url= 'list-producto-carrito';
                axios.get(url).then(response=>{
                    this.arrayProducto = response.data;
                    var total=0;
                    var count=0;
                    console.log(this.arrayProducto)
                    for(var product in this.arrayProducto){
                        total+=this.arrayProducto[product].price*this.arrayProducto[product].quantity;
                        count++;
                    }
                    this.count=count;
                    this.total=total;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },
        mounted() {
            this.listarProducto(1,this.buscar,this.criterio);
        }
    }
</script>
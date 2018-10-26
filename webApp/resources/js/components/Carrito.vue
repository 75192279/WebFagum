<template>
        <main>
            <div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Producto</th>
							<th class="column-3">Precio</th>
							<th class="column-4 p-l-70">Cantidad</th>
							<th class="column-5">Total</th>
						</tr>

						<tr class="table-row"  v-for="product in arrayProducto" :key="product.id">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="/cliente/images/item-10.jpg" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">{{product.name}}</td>
							<td class="column-3">S/. {{product.price}}</td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" @click="addRest(product)">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>
									<input class="size8 m-text18 t-center num-product" v-model="product.quantity" type="number" name="num-product1" value="1">
									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" @click="addSum(product)">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5">S/. {{product.quantity*product.price}}</td>
						</tr>
					</table>
				</div>
			</div>
            <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Volver
					</button>
				</div>
			</div>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<div v-show="tabs[0].active">
                    <h5 class="m-text20 p-b-24">
                        Totales del carrito
                    </h5>

                    <!--  -->
                    <div class="flex-w flex-sb-m p-b-12">
                        <span class="s-text18 w-size19 w-full-sm">
                            Subtotal:
                        </span>

                        <span class="m-text21 w-size20 w-full-sm">
                            S/. {{total}}
                        </span>
                    </div>

                    <!-- 
                    <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                        <span class="s-text18 w-size19 w-full-sm">
                            Envío:
                        </span>

                        <div class="w-size20 w-full-sm">
                            <p class="s-text8 p-b-23">
                                No hay métodos de envío disponibles. Por favor revise su dirección o contáctenos si necesita ayuda.
                            </p>

                            <span class="s-text19">
                            Calcular costo de envío
                            </span>

                            <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
                                <select class="selection-2" name="country">
                                    <option>Select a country...</option>
                                    <option>US</option>
                                    <option>UK</option>
                                    <option>Japan</option>
                                </select>
                            </div>

                            <div class="size13 bo4 m-b-12">
                            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
                            </div>

                            <div class="size13 bo4 m-b-22">
                                <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
                            </div>

                            <div class="size14 trans-0-4 m-b-10">
                                <!-- Button --
                                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Update Totals
                                </button>
                            </div>
                        </div>
                        
                    </div>
    -->
                    <!--  -->
                    <div class="flex-w flex-sb-m p-t-26 p-b-30">
                        <span class="m-text22 w-size19 w-full-sm">
                            Total:
                        </span>

                        <span class="m-text21 w-size20 w-full-sm">
                            S/. {{total}}
                        </span>
                    </div>

                    <div class="size15 trans-0-4">
                        <!-- Button -->
                        <button @click="isTabsActive(1),checkedUser()" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                            Procesar compra
                        </button>
                    </div>
                </div>
                <div v-show="tabs[1].active">
                    <div v-if="idUser==false">
                        <login-component></login-component>
                    </div>
                    <div v-if="idUser==true">
                        
                         <div class="flex-w flex-sb-m p-t-26 p-b-30">
                            <button @click="realizarCompra()" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Realizar compra
                            </button>
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
    import login from './login.vue';
    import toastr from 'toastr';
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
                    console.log(this.arrayProducto)
                    for(var product in this.arrayProducto){
                        total+=this.arrayProducto[product].price*this.arrayProducto[product].quantity;
                    }
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
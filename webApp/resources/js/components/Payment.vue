<template>
  <div>
        <ul class="nav">
            <li class="pasoList" v-for="(data,i) in listActiveTabs"  v-bind:class="{'active':data.active,'selected':data.selected==true}" >
                <a :disabled="true" class="nav-link" v-on:click="tabCheckedSlected(i,-1,data.route)">{{data.name}}
                   <span v-html="data.icon">
                    </span>
                </a>
            </li>
        </ul>
        <div>
            <div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" v-bind:class="{'show active':selected.tab1}" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="">
                            <div>
                                <h2>Formas de entrega</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="ul">
                                        <li class="li">
                                            <input type="radio" v-model="formData.entrega" value="0" id="f-option" name="entrega">
                                            <label for="f-option">Lo acuerdo con el vendedor.</label>
                                            <div class="check"></div>
                                        </li>
                                        <li class="li">
                                            <input type="radio" v-model="formData.entrega" value="1" id="s-option" name="entrega">
                                            <label for="s-option">Envío a mi domicilio</label>
                                            
                                            <div class="check"><div class="inside"></div></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-12" v-if="formData.entrega==1">
                                   <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección </label>
                                            <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateDirection,'is-invalid':!isValidateDirection}" v-model="formData.direccion" placeholder="EJ.: Av. Real" type="text" size="50">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Número</label>
                                            <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateNumero,'is-invalid':!isValidateNumero}" v-model="formData.numero" placeholder="Ej.:921" type="text" size="50">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nº interior u otro dato</label>
                                            <input class="form-control inputColor" v-model="formData.adicionainfo" placeholder="Ej.: Nro. Int. 44, Urbanización Naranjal." type="text" size="50">
                                            <span class="small">(Opcional)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Referencia</label>
                                            <input class="form-control inputColor"  v-model="formData.referencia" placeholder="Ej.: Frente a facultad de Psicología." type="text" size="50">
                                            <span class="small">(Opcional)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Departamento</label>
                                            <input class="form-control inputColor"  v-model="formData.departamento" placeholder="Departamento" type="text" size="50">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Provincia</label>
                                            <input class="form-control inputColor"  v-model="formData.provincia" placeholder="Provincia" type="text" size="50">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Distrito</label>
                                            <input class="form-control inputColor"v-model="formData.distrito" placeholder="Distrito" type="text" size="50">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre y apellido(s):</label>
                                            <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateEncargado,'is-invalid':!isValidateEncargado}" v-model="formData.encargado" type="text" size="50">
                                            <span class="small">Ingresa el nombre y apellido(s) de quién recibirá el producto.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Teléfono de contacto:</label>
                                            <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateTelf,'is-invalid':!isValidateTelf}" v-model="formData.numero_contacto" type="text" size="50">
                                            <span class="small">Puede ser fijo o móvil.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="containerDetailButton">  
                                        <button type="button"  v-on:click="tabMove('tab2'),tabCheckedSlected(0,1,'none')" class="btn btn-info btn-lg">Siguiente</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" v-bind:class="{'show active':selected.tab2}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div>
                                <h2>Pagar tu venta</h2>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-12">
                                    <div class="trajetasContainer">
                                         <img class="tarjetasImg" v-for="tarjeta in tarjetas" v-bind:src="tarjeta.img">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-3 col-sm-12">
                                    <div class="card" style="padding: 15px;">
                                        <form action="" v-on:submit.prevent="pagarCulqi" id="culqi-card-form" novalidate>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Correo Electrónico</label>
                                                        <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateEmail,'is-invalid':!isValidateEmail}" v-model="formData.email" placeholder="Correo Electrónico" type="text" size="50" id="card[email]" data-culqi="card[email]">
                                                      
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Número de tarjeta</label>
                                                        <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateTarget,'is-invalid':!isValidateTarget}" v-model="formData.targetNumber" placeholder="Número de tarjeta" type="text" value="" size="20" id="card[number]" data-culqi="card[number]">
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Número de seguridad</label>
                                                        <div class="input-group">
                                                            <input class="form-control inputColor" v-bind:class="{'is-valid':isValidateTargetCvv,'is-invalid':!isValidateTargetCvv}" v-model="formData.targetSecurity" placeholder="Número de tarjeta" type="text"  size="4" id="card[cvv]" data-culqi="card[cvc]">
                                                            <div class="input-group-prepend">
                                                                <img class="seguridadImg" src="/img/cvv.png">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Fecha expiración (MM/YYYY)</label>
                                                        <div class="input-group">
                                                            <div class="form-group col-md-6 mb-3" style="padding: 0;">
                                                                <select style="width: 100%;" v-bind:class="{'is-valid':isValidateTargetMount,'is-invalid':!isValidateTargetMount}"  v-model="formData.fechExpirationMount" class="custom-select custom-select-lg mb-1">
                                                                    <option disabled value="">Mes</option>
                                                                    <option v-for="(each, i) in formData.dataExpirationMount" v-bind:value="each.value">{{each.name}}</option>
                                                                </select>
                                                                
                                                            </div>
                                                            <div class="form-group col-md-6 mb-3" style="padding: 0;">
                                                                <select v-model="formData.fechExpirationYear"  v-bind:class="{'is-valid':isValidateTargetYear,'is-invalid':!isValidateTargetYear}" style="width: 100%;" class="custom-select custom-select-lg mb-1">
                                                                    <option disabled value="">Año</option>
                                                                    <option v-for="(each, i) in formData.dataExpirationYear" v-bind:value="each.value">{{each.name}}</option>
                                                                </select>
                                                            </div>
                                                            <input class="form-control mx-sm-6 is-valid" v-model="formData.fechExpirationMount" placeholder="" type="hidden" size="2" id="card[exp_month]" data-culqi="card[exp_month]">
                                                            <input class="form-control mx-sm-6 is-valid" placeholder="" type="hidden" size="4" id="card[exp_year]" v-model="formData.fechExpirationYear" data-culqi="card[exp_year]">
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-6">
                                                <div class="containerDetailButton">
                                                    
                                                    <button type="submit"  class="btn btn-info btn-lg">Pagar</button><br>
                                                    <img class="reloadPayment" src="/img/reloader.gif" id="reloadPayment">
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="listData">
                                            <input type="hidden" id="idCitaPayment" >
                                            <input type="hidden" id="precioPayment" v-model="precio">
                                            <input type="hidden" id="data" v-bind:value="JSON.stringify(formData)" >

                                            <input type="hidden" id="messageCitaPayment">
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                    <div class="tab-pane fade" v-bind:class="{'show active':selected.tab3}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                       <div class="row" style="margin-top: 15px">
                            <div class="col-xl-12 col-lg-3 col-sm-12">
                                <div class="card-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="alert alert-success" role="alert">
                                                    Su compra se realizo con exito
                                            </div>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>
<script>
  
</script>
<script>
    import axios from 'axios';
    import toast from 'toastr';
    import moment from 'moment';
    moment.locale('es');
    export default {
        data(){
            return{
                
                isActive: false,
                selected: {
                    tab1:true,
                    tab2:false,
                    tab3:false,
                },
                messageCulqi:'',
                formData:{
                    entrega: 0,
                    direccion:'',
                    numero:'',
                    referencia:'',
                    adicionainfo:'',
                    encargado:'',
                    provincia:'',
                    distrito:'',
                    email:'',
                    numero_contacto:'',
                    targetNumber:'4111111111111111',
                    targetSecurity:'123',
                    dataExpirationMount:[],
                    fechExpirationMount:moment().format('MM'),
                    dataExpirationYear:[],
                    fechExpirationYear:moment().format('YYYY'),
                },
                formDataValidate:{
                    email:false,
                    targetNumber:false,
                    targetSecurity:false,
                    fechExpirationMount:false,
                    fechExpirationYear:false,
                },
                listActiveTabs:[],
                data:[],
                dataPago:[],
                dataPayment:false,
                tarjetas:[
                    {
                        title:"visa",
                        img:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE4AAAAcCAMAAAD4MnnTAAABSlBMVEUAAAAAXJ0AY50AVaEAVaEAVaEAVaEAVaL/rgAAVKEAVqAAVKEAVqMAVaIAVaEAWaEAVqEAVaIAVaH/pgAAVaEAVaIAVaIAVaEAVKIAVaEGWKgAWKcAVaIAVaEAVaEAVaEAVaEAVKEAVaIAVaIAVaIAVaEAVaIAVqQAVqUAV6X8pwAAVqIAVaEAVqIAVaEAVqMAVKEAVaAAVqIAVKEAVKIAUqIAVaEAVaEAVaEAVaEAVaEAVaIAV6IAVaIAU6QAVqEAVaL9qAAAVaIAVaIAVqH+owD/ogCJgkr9qAD+pwD8qAD7pgD8qAD8qAAAVKH+qwD0pQhxeVv9qQD9pwA0ZoDIlSQAVKD7pgD2qgD/ogAAVaEAWKgAVaIAV6QAV6YAVqP/qAD/qwD9pwAAVKT/rgAAWaoAUqchYpOXhkEMWJw3aIGzkC/OmyLhoRRQDXePAAAAWnRSTlMABwIlIvr18gWAGBH7W0YODPdiItDFt6+NhQX26eHUnYlyb2pRNS8g/vv17+Xf28zAVzsqHhTs16qik3kcppZMSvy6fXYvDvzhwLyHXUlB49/SpI6EVENCGxaYJBWzAAADsElEQVRIx61VV2MaMQz2HQEadigzAcIKkBJKIdCmO2ma7r2LFyvd/f+vtWTfndvnfi9IsvRZ1uDIf8YFC4HVdRCesB3Y09NQN55xyL++rlY+n1308CBwmW4gXBLH35hndzqj0+qw2Q65gW+6Cy5xrXx88+jk5BLi5VMvP/fKTiQS2Sm4pI7CdW3ubtYSgkpOxdYw5bmeDqLgcoMYfHr2eL6eKyzWz41pLyEZYzRLSIEq4byM1laFcjZDsPOkcc2ec6Yghla+z58s5svlcv3W6HWqQuRBnDjXuJIoxLp1IWc+Eh3z+hxHXfZjJMD269+L5XLxRGuZy0hSImQSZZDLHqQhMDNOKRVcVkx0qmf45Qti4c7Xn4vl/JHuxl0OHJDAWIIEN08P0Chzu6UbxQGtmbcdUUNHGzZdm86+zecnZ6jcBh9xT0VkQeI1NShJjEs0HWzmcYsgQpA9Y0B33aa7FV2tHi7Wz0COXZVAN/KKKIpKKiHxNfI3NpWVRYCT57btWcxztvq2fgqyTmmQVmKRmiKS6yCx6JjYSA843HYk4Khrn5TpbPX912McOgEcdegQ9o1mdXYKvJK1k0ii56iJ9x/bdCkV+OXHK9WLwy2ox9ah/2w5Nucgi3zbdMFcLK/G8YzetOmmFan4Hp7pesxEAcd5hi+cQKIF00PO73X8aWfYg24UfovERkHdtPr6njg1DnRtsI0ExF92sFk5fyb6STNd5pHbEMKvOTbdfaz6O/KhhxQZbJyeGIKIFQU3Ce63zQQYz9sUyhOy6XBiaYHsIu1mMIDU2243WaNc8w3iSm9Sr2UNqh9kIV3FuyYHEkYphPFDrHHL98m0BkK/N4nr6rVs3ANb2abDfWH9MiZZDNoz4yl73Asc6UpmXWXlfqPRKIcZds9GC0uNO8/voqWTYDpTC5M+MwUooj+jAJBkNWM7dsLgiGymSW3uecX9rsUrUg9ZKAKuFli4Y7HhfxsAnK1miytKujlsbbjYzV104i9gjSyYgtrAnuLcblgGugsbe06j+ds3SkcH2AqRc9JVjk81YLqgNpKGjh75fwugNbTEOIRJrNL+sV5XdrW8iShHGb7DxoapRi9ljQ62JQ3T44P3GriumLlBnuuvgQV3KJgCz5m6H4ZBDR8qSQpTd0jy8gjXVSGYoTsU9D1io76zpbDTNGoqEQ6HE1V1Zfw035cUwKP55hTC99XZfs0fjSzqLWIjgx/gruPtSQgwcfXG7t3N3myOxre0OsGzWBCK+q0/rX9GKK+20N4AAAAASUVORK5CYII="
                    },{
                        title:"master card",
                        img:"data:image/png;base64,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"
                    },
                    {
                        title:"american express",
                        img:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAiCAMAAAAuwqolAAAAulBMVEUql9srltksl9ssl9sxktsAAAArl9gsmNwrltkrltsrltorltoqltktltotl9sum+H///8jktksmN2XzO0oldolk9pBod/8/v/v9/w8n944nd0ekNmp1fF3vOhYreP3+/7p9PwvneRTquIymdyfz++RyexfsOTy+f3S6fjM5vbG4/a22/Oj0e+EwupwuOdntOVNp+GKxex6vehks+VIpODX6/jA3/Sv2PJtt+Y0m9zP5/fi8frf7/ovmNuMTKNLAAAADnRSTlOp5eOkBQBVVOfl0c+sVV0Yk20AAAG4SURBVDjL3ZVZb6MwEIDZTdLu0ZJxPbYxdyDcZ4Ccbf//31rYVim8hYdKVb+HsQT6ZHvGHiur5f3iQbmJh8XjcqUsF5v1zWwWS+Vxo85gc6f8Wc8R1n+VX09zhKffyo95ws/vJZAeZP+jimQEvv0jbCrIgFJ62tGejp3oiJDwYBh3/lhgBfRoYoi56sKIyDsACIACJzNcRCXtCDLOA3cHOedm5PEe6T07YMoA8smS0BYJ1iQDk6DUHKdmZKv5nWVZJXrOgXlR4k82zXJozsm5hSO2xIQUW9xqr4UQAqgR6vLZ7XAi6K52tsBS3SM76rawpNnPoPtSyguUhp+Ilk3SyizIjSqojG1G4qZ3itTYaue6aawXzSN+LMKpgAewGRJE2yRxgrq6H4TXHQA4lWFx7r7oOBKwFhdS7vfxCUuWCM8I4dALvrRtuzZOkBmtMNlIIBSoTN0YUl53MZh6Bql8TysPNQcKPYdylFbdhZ6Q7WFAA3Ac+CCzo6FwWnctHPK3ymM1jEFJaVPQK4FOKjoQjir9fraQDPSRMfLB9fvXv0CfJcxuZPNb5d3MZjy/3Q8PinIji/vl6h9LsG5x4GqVDwAAAABJRU5ErkJggg=="
                    }
                ]
            }
        },
        count:0,
        props: {
            id:'',
            precio:'',
        },
        created: function(){
            this.listTabs();
            this.listDataMount();
            this.listDataYear();
            this.listaCompraPayment();
            console.log(this.dataCompra);
        },
        computed:{
            isActived: function(){
               
            },
            isValidateDirection:function(){
                if(this.formData.direccion){
                    if(!this.formData.direccion==""&&this.formData.direccion.length<=3){
                        console.log(this.formData.direccion)
                        return false;
                    }
                    else if(!this.formData.direccion==""){
                            return true;
                    }
                }
            },
            isValidateNumero:function(){
                if(this.formData.numero){
                    if(!this.formData.numero==""&&this.formData.numero.length<=1){
                        console.log(this.formData.numero)
                        return false;
                    }
                    else if(!this.formData.numero==""){
                            return true;
                    }
                }
            },
            isValidateEncargado:function(){
                if(this.formData.encargado){
                    if(!this.formData.encargado==""&&this.formData.encargado.length<=4){
                        console.log(this.formData.encargado)
                        return false;
                    }
                    else if(!this.formData.encargado==""){
                            return true;
                    }
                }
            },
            isValidateTelf:function(){
                if(this.formData.numero_contacto){
                    if(!this.formData.numero_contacto==""&&this.formData.numero_contacto.length<=4){
                        console.log(this.formData.numero_contacto)
                        return false;
                    }
                    else if(!this.formData.numero_contacto==""){
                            return true;
                    }
                }
            },
            isValidateEmail:function(){
                if(this.formData.email){
                    if(!this.formData.email==""&&this.formData.email.length<=4){
                        console.log(this.formData.email)
                        return false;
                    }
                    else if(!this.formData.email==""){
                            return true;
                    }
                }
            },
            isValidateEmail:function(){
                if(this.formData.email){
                    if(!this.formData.email==""&&this.formData.email.length<=4){
                        console.log(this.formData.email)
                        return false;
                    }
                    else if(!this.formData.email==""){
                            return true;
                    }
                }
            },
            isValidateTarget:  function(){
                if(this.formData.targetNumber){
                    if(this.formData.targetNumber!==""&&this.formData.targetNumber.length<16){
                        return false;
                    }
                    else if(!this.formData.targetNumber==""){
                        return true;
                    }
                }
            },
            isValidateTargetCvv:  function(){
                if(this.formData.targetSecurity){
                    if(this.formData.targetSecurity!==""&&this.formData.targetSecurity.length<3){
                        return false;
                    }
                    else if(!this.formData.targetSecurity==""){
                        return true;
                    }
                }
            },
            isValidateTargetMount:  function(){
                if(this.formData.fechExpirationMount){
                    var now=this.formData.fechExpirationYear+"/"+this.formData.fechExpirationMount;
                    var dataMount=moment(now).format('MM');
                    var dataYear=moment(now).format('YYYY');

                    var newDataMount=moment().format('MM');
                    var newDataYear=moment().format('YYYY');

                    console.log(dataMount,dataYear,newDataMount,newDataYear);
                    if(this.formData.fechExpirationMount==""){
                        return false;
                    }
                    else if(dataYear==newDataYear){
                        if(dataMount<newDataMount){
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                    else if(!this.formData.fechExpirationMount==""){
                        return true;
                    }
                }
            },
            isValidateTargetYear:  function(){
                if(this.formData.fechExpirationYear){
                    if(this.formData.fechExpirationYear==""||this.formData.fechExpirationYear<moment().format('YYYY')){
                        return false;
                    }
                    else if(!this.formData.fechExpirationYear==""){
                        return true;
                    }
                }
            }
        },
        methods:{
            checkedPrecio:function(num){
                var newnNum=parseFloat(num);
                var newPrecio=newnNum.toFixed(2);
                return newPrecio;
            },
            listaCompraPayment: function(){
                var url='/users/compraclientepayment';
                axios.get(url).then(response=>{
                    //console.log(response);
                    if(response.data[0].estado==1){
                        this.tabSelectedReservado();
                        this.dataPayment=true;
                    }
                })
                .catch(function (error) {
                    //console.log(error);
                });
            },
            listaCompraPaymentComplete: function(){
                var url='/users/compraclientepaymentcomplete';
                axios.get(url).then(response=>{
                    console.log(this.response);
                    this.dataPago=response.data;
                })
                .catch(function (error) {
                    //console.log(error);
                });
            },
            convertedDate: function(date,tipo){
                switch(tipo){
                    case "date":
                        return moment(date).format('DD/MM/YYYY');
                        
                    case "time":
                        return moment(date).format('HH:mm');
                }
            },
            checkedDateTime: function(date){
                var dateRest=moment(date).fromNow();
                return dateRest;
            },
            redirect: function(url){
                window.location.href = "/"+url;
            },
            listDataYear:function(){
                var newDate=moment().format('YYYY');
                var yearDate=parseInt(newDate);
                var yearNew=0;
                for(let y=0;y<=10;y++){
                    yearNew=yearDate++;
                    this.formData.dataExpirationYear.push(
                        {'value':yearNew,'name':yearNew}
                    )
                }
            },
            listDataMount:function(){
               
                for(let y=1;y<=12;y++){
                    var newMount=('0'+Math.floor(y)).slice(-2)
                     this.formData.dataExpirationMount.push(
                         {'value': newMount,'name':newMount}
                     );
                }
            },
            listTabs:function(){
                this.listActiveTabs=[];
                var data=[
                    {name:"Paso 1",route:"tab1",active:true,disabled:false,selected:false,icon:"<i class='fa fa-times'></i>"},
                    {name:"Paso 2",route:"tab2",active:false,disabled:true,selected:false,icon:"<i class='fa fa-times'></i>"},
                    {name:"Paso 3",route:"tab3",active:false,disabled:true,selected:false,icon:"<i class='fa fa-times'></i>"}
                ];
                this.listActiveTabs=data;
            },
            tabCheckedSlected: function(index,value,route){
                if(value==-1){
                    if(this.listActiveTabs[index].disabled===false){
                        if(this.listActiveTabs[index].selected==true){
                            this.tabMove(route);
                            this.activeTabsSelected(index);
                            this.listActiveTabs[index].icon='<i class="fa fa-check"></i>';
                        }
                        else{
                            this.tabMove(route);
                            this.activeTabsSelected(index);
                            this.listActiveTabs[index].selected=true;
                        }
                    }
                    else if(this.listActiveTabs[index].selected==true){
                        this.listActiveTabs[index].icon='<i class="fa fa-check"></i>';
                    }
                }
                else{
                    this.activeTabsSelected(value)
                    this.listActiveTabs[index].selected=true;
                    this.listActiveTabs[index].icon='<i class="fa fa-check"></i>';
                }
            },
            activeTabsSelected: function(index){
                 this.listActiveTabs.map((data,i)=>{
                    this.listActiveTabs[i].active=false;
                })
                this.listActiveTabs[index].active=true;
            },
            pagarCulqi:function(){
                var me=this;
                if(this.formData.email==""){
                    return false;
                }
                enviarData();
                var timerMessage=setInterval(function(){
                    if(me.dataPayment==true){
                        me.tabSelectedReservado();
                        clearInterval(timerMessage);
                        
                    }
                    me.listaCompraPayment();
                },5000);
            },
            tabSelectedReservado(){
                if(this.dataPayment==true){
                    this.listaCompraPaymentComplete();
                    this.listActiveTabs.map((data,i)=>{
                        this.listActiveTabs[i].selected=true;
                        this.listActiveTabs[i].disabled=true;
                        if(i==2){
                            this.listActiveTabs[i].disabled=false;
                        }
                        this.tabCheckedSlected(i,-1,data.route);
                    })
                }
                
            },
            tabMove: function(tabs){
                console.log(tabs);
                switch (tabs){
                    case "tab1":
                        this.selected.tab1=true;
                        this.selected.tab2=false;
                        this.selected.tab3=false;
                        
                        break;
                    case "tab2":
                        this.selected.tab2=true;
                        this.selected.tab1=false;
                        this.selected.tab3=false;
                        
                        break;
                    case "tab3":
                        this.selected.tab3=true;
                        this.selected.tab1=false;
                        this.selected.tab2=false;
                        break;
                }
            }
        },
        mounted() {
        }
    }
</script>
<style>
    .containerDetailIcon{
        margin: 0 auto;
        text-align: center;
    }
    .reloadPayment{
        visibility:hidden;
        text-align:center;
        width: 100px;
    }
    .iconTitle{
        font-size: 20px;
    }
    .iconDetail{
        font-size: 40px;
        color: #28C0DE;
    }
    .containerTabs{
        height:auto;
        width: auto;
        position: relative;
        overflow-x: auto;
        overflow-y: hidden;
    }
    .containerDetail{
        position: relative;
        height: 200px;
        width: 100%;
    }
    .containerDetailButton{
        text-align:center;
    }
    .textDetail{
        text-align:center;
        font-size: 20px;
    }
    .pasoList{
        background-color: #FF4C52;
        border-radius: 15px;
        color: #fff;
    }
    .pasoList>a{
        cursor: pointer;
        color: #fff;
    }
    .pasoList>a:hover{
        border-radius: 15px;
        background-color: transparent;
        opacity: .5;
        cursor: pointer;
        color: #fff !important;
        
    }
    .pasoList.active{
        opacity: .7;
    }
    .pasoList.selected{
        background-color: rgb(8, 168, 133);
    }
    .trajetasContainer{
        text-align: center;
    }
    .tarjetasImg{
        margin: 15px;
    }
    .seguridadImg{
        width: 50px;
        margin-left: 19px;
        margin-top: -8px;
    }
    .containerPaymentCom{
        margin: 15px 0;
    }
    .titlePaymentCom{
        color: rgb(8, 168, 133);
        font-weight: 500;
    }
    .inputColor{
        background-color: #F5F5F5;
    }

.ul .li{
  color: #AAAAAA;
  display: block;
  position: relative;
  float: left;
  width: 100%;
  height: 100px;
	border-bottom: 1px solid #333;
}

.ul .li input[type=radio]{
  position: absolute;
  visibility: hidden;
}

.ul .li label{
  display: block;
  position: relative;
  font-weight: 300;
  font-size: 1.35em;
  padding: 25px 25px 25px 80px;
  margin: 10px auto;
  height: 30px;
  z-index: 9;
  cursor: pointer;
  -webkit-transition: all 0.25s linear;
}

.ul .li:hover label{
	color: #FFFFFF;
}

.ul .li .check{
  display: block;
  position: absolute;
  border: 5px solid #AAAAAA;
  border-radius: 100%;
  height: 25px;
  width: 25px;
  top: 38px;
  left: 20px;
	z-index: 5;
	transition: border .25s linear;
	-webkit-transition: border .25s linear;
}

.ul .li:hover .check {
  border: 5px solid #FFFFFF;
}

.ul .li .check::before {
  display: block;
  position: absolute;
	content: '';
  border-radius: 100%;
      height: 13px;
    width: 13px;
    top: 1px;
    left: 1px;
  margin: auto;
	transition: background 0.25s linear;
	-webkit-transition: background 0.25s linear;
}

input[type=radio]:checked ~ .check {
  border: 5px solid #0DFF92;
}

input[type=radio]:checked ~ .check::before{
  background: #0DFF92;
}

input[type=radio]:checked ~ label{
  color: #0DFF92;
}

.signature {
	margin: 10px auto;
	padding: 10px 0;
	width: 100%;
}

.signature p{
	text-align: center;
	font-family: Helvetica, Arial, Sans-Serif;
	font-size: 0.85em;
	color: #AAAAAA;
}

.signature .much-heart{
	display: inline-block;
	position: relative;
	margin: 0 4px;
	height: 10px;
	width: 10px;
	background: #AC1D3F;
	border-radius: 4px;
	-ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
}

.signature .much-heart::before, 
.signature .much-heart::after {
	  display: block;
  content: '';
  position: absolute;
  margin: auto;
  height: 10px;
  width: 10px;
  border-radius: 5px;
  background: #AC1D3F;
  top: -4px;
}

.signature .much-heart::after {
	bottom: 0;
	top: auto;
	left: -4px;
}

.signature a {
	color: #AAAAAA;
	text-decoration: none;
	font-weight: bold;
}


/* Styles for alert... 
by the way it is so weird when you look at your code a couple of years after you wrote it XD */

.alert {
	box-sizing: border-box;
	background-color: #0DFF92;
	width: 100%;
	position: relative; 
	top: 0;
	left: 0;
	z-index: 300;
	padding: 20px 40px;
	color: #333;
}

.alert h2 {
	font-size: 22px;
	color: #232323;
	margin-top: 0;
}

.alert p {
	line-height: 1.6em;
	font-size:18px;
}

.alert a {
	color: #232323;
	font-weight: bold;
}
</style>
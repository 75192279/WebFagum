<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar</div>
                    <div class="panel-body">
                        <form method="POST">
                            <input type="text" v-model="formRegister.usuario" placeholder="Usuario" class="form-control inputMargin">
                            <input type="email" v-model="formRegister.correo" placeholder="Correo" class="form-control inputMargin">
                            <input type="password" v-model="formRegister.password" placeholder="Password" class="form-control inputMargin">
                            <div class="text-center">
                                 <button type="button" v-on:click="registrar()" class="btn btn-danger">Enviar</button>
                                 <button type="button" v-on:click="registro()" class="btn btn-danger">resgistro</button>
                                <!--<button type="button" class="btn btn-success">Prueba1</button>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import toastr from "toastr"
    import axios from "axios"
    
    export default {
        data(){
            return{
                formRegister:{
                    usuario:'',
                    correo:'',
                    password:'',
                },  
            }
        },
        mounted() {
            console.log('Component mounted.')
            toastr.error('Al guardar', 'Error')
            toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!')
        },
        create(){
            
        },
        methods: {
            registrar: function(){
                axios.post(`/usuario`, {
                    usuario: this.formRegister.usuario,
                    correo: this.formRegister.correo,
                    password: this.formRegister.password
                    })
                    .then(response => {
                        toastr.success('Al guardar', 'Exito')
                    })
                    .catch(e => {
                    this.errors.push(e)
                    toastr.error('Al guardar', 'Error')
                })
                
            },
            registro: function(){
               toastr.error('Al guardar', 'Error') 
            },

        }
        
    }
</script>

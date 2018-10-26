<template>
        <div class="container-fluid wrapper fadeInDown">
            <div v-if="login">
                <div id="formContent">
                    <div class="fadeIn first">
                        <img src="https://www.b-cube.in/wp-content/uploads/2014/05/aditya-300x177.jpg" id="icon" alt="User Icon" />
                        <h1>Ingresar</h1>
                    </div>    
                    <form v-on:submit.prevent="ingresar">
                        <input type="email" id="login" class="inputLogin fadeIn second" v-model="formData.correo" placeholder="correo">
                        <input type="password" id="password" class="inputLogin fadeIn third" v-model="formData.password" placeholder="contraseña">
                        <input type="submit" class="fadeIn fourth" value="Ingresar">
                    </form>
               
                    <div id="formFooter">
                        <a class="underlineHover" v-on:click="formLogin" >Registrase</a>
                    </div>
                </div>
             </div>
            <div v-if="!login">
                <div id="formContent">
                    <div class="fadeIn first">
                        <img src="https://www.b-cube.in/wp-content/uploads/2014/05/aditya-300x177.jpg" id="icon" alt="User Icon" />
                        <h1>Ingresar</h1>
                    </div>    
                    <form v-on:submit.prevent="register">
                        <input type="text" id="usuario" class="inputLogin fadeIn second" v-model="formDataSend.usuario" placeholder="usuario">
                        <input type="email" id="correo" class="inputLogin fadeIn second" v-model="formDataSend.correo" placeholder="correo">
                        <input type="password" id="password" class="inputLogin fadeIn third" v-model="formDataSend.password" placeholder="contraseña">
                        <input type="password" id="password_confirm" class="inputLogin fadeIn third" v-model="formDataSend.password_confirm" placeholder="confirmar contraseña">
                        <input type="submit" class="fadeIn fourth" value="Registrarse">
                    </form>
               
                    <div id="formFooter">
                        <a class="underlineHover" v-on:click="formLogin" href="#">Ingresar</a>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import axios from "axios";
    import toastr from "toastr";
    import "toastr/build/toastr.css";
    export default {
        mounted: {
           isValidateLogin:function(){
             return false;
           },
           isValidateRegister:function(){
              return false;
           }
        },
        props:{
          redirect:true,
        },
        data()
        {
            return {
                login: true,
                formData:{
                    correo:'',
                    password:'',
                },
                formDataSend:{
                    usuario:'',
                    correo:'',
                    password:'',
                    password_confirm:'',
                }
            }
        },
        methods:{
            formLogin:function(){
                this.login= !this.login;
            },
            ingresar: function(){
                var correo=this.formData.correo;
                var password=this.formData.password;
                console.log('correo',correo,'password',password);
                var url="/login-autenticate";
                axios.post(url,{
                    'correo':correo,
                    'password':password
                }).then(response=>{
                  var data=response.data;
                  toastr.success(data.usuario, 'Bienvenido');
                  if(!this.redirect){
                      return true;
                  }
                  switch(data.idRol){
                    case 1:
                      this.redirect("/dashboard");
                      break;
                    case 2:
                      break;
                    case 3:
                      this.redirect("/");
                      break;
                    default:
                      this.redirect("/");
                  }
                }).catch(error=>{
                    toastr.error('Correo electrónico o contraseña no coincide', 'Error');
                    console.log(error)
                });
            },
            register: function(){
                var usuario=this.formDataSend.usuario;
                var correo=this.formDataSend.correo;
                var password=this.formDataSend.password;
                var password_confirm=this.formDataSend.password_confirm;
                if(password!==password_confirm){
                  toastr.error('Contraseña no coincide', 'Error');
                  return false;
                }
                if(usuario==''){
                  toastr.error('Usuario no valido', 'Error');
                  return false;
                }
                if(correo==''){
                  toastr.error('Correo no valido', 'Error');
                  return false;
                }
                var url="/login-register";
                axios.post(url,{
                    'correo':correo,
                    'usuario':usuario,
                    'password':password
                }).then(response=>{
                    toastr.success('Se guardo exitosamente', 'Exito');
                    this.formDataSend.usuario='';
                    this.formDataSend.password='';
                    this.formDataSend.correo='';
                    this.formDataSend.password_confirm='';
                    this.formLogin();
                }).catch(error=>{
                    toastr.success('No se guardo', 'Error');
                    console.log(error)
                });
            },
            redirect: function(url){
                window.location.href = url;
            },
        
        }
    }
</script>
<style>

/* BASIC */

html {
  background-color: #56baed;
}

body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 97%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #56baed;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

  .inputLogin  {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 75%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder {
  color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}

h1{
    color:#60a0ff;
}

/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:30%;
}

</style>

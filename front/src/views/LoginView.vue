<template>
  
    <div class="sidenav">
         <div class="login-main-text">
            <h2>ToDo<br> Login</h2>
            <p>Accede o registrate en la APP desde aquí.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="alert alert-danger" v-if="errorLogin" role="alert">
              {{ errorLoginMsg }}
            </div>

            <div class="login-form">
               <form>
                  <div class="form-group">
                     <label>Email</label>
                     <input type="email" v-model="email" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                     <label>Contraseña</label>
                     <input type="password" v-model="password" class="form-control" placeholder="contraseña" required>
                  </div>
                  <button v-on:click.prevent="login()" type="submit" class="btn btn-primary">Login</button>
                  <button v-on:click.prevent="register()" type="submit" class="btn btn-secondary">Register</button>
               </form>
            </div>

            


         </div>
      </div>
  </template>
  
  <style>
    body {
      font-family: "Lato", sans-serif;
    }

    .main-head{
      height: 150px;
      background: #FFF;
    }

    .sidenav {
      height: 100%;
      background-color: #6ee8f4;
      overflow-x: hidden;
      padding-top: 20px;
    }

    .main {
      padding: 30px 10px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
    }

    @media screen and (max-width: 450px) {
      .login-form{
        margin-top: 10%;
      }

      .register-form{
        margin-top: 10%;
      }
    }

    @media screen and (min-width: 768px){
      .main{
        margin-left: 40%; 
      }

      .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
      }

      .login-form{
        margin-top: 80%;
      }

      .register-form{
        margin-top: 20%;
      }
    }

    .login-main-text{
      /*margin-top: 20%;*/
      padding: 60px;
      /*color: #fff;*/
    }

    .login-main-text h2{
      font-weight: 300;
    }

    .btn-black{
      background-color: #000 !important;
      color: #fff;
    }

  </style>


<script>
import axios from "axios";


export default{
    name: 'LoginView',
    data(){
    return{
      email:'',
      password:'',
      apiUri: 'http://localhost:8000/api/',
      userLogged: false,
      errorLogin: false,
      errorLoginMsg: ''
    }
  },
  methods:{
    login(){
        let endPoint=this.apiUri+'login';
        let dataLogin={
            'email' :    this.email,
            'password' : this.password
        }
    
        axios
        .post(endPoint,dataLogin)
        .then(
            function(response){
              
                if (response.status === 201 && response.data.data.rememberToken !== undefined) {
                  
                  localStorage.setItem('token',response.data.data.rememberToken);
                  localStorage.setItem('logIn',true);
                  this.$router.push({name: 'home'}); //not work
                  window.location.href = '/';
                }
                
            }
        )
        .catch(error => {
            if (error.response !== undefined) {

                let errorMessage = error.response.data.message;
                this.errorLogin=true;
                this.errorLoginMsg=errorMessage;

            }
            
        });
        
    },
    register(){
        let endPoint=this.apiUri+'register';
        let dataLogin={
            'email' :    this.email,
            'password' : this.password
        }
    
        axios
        .post(endPoint,dataLogin)
        .then(
            function(response){

                if (response.status === 201 && response.data.data.rememberToken !== undefined) {
                   
                    localStorage.setItem('token',response.data.data.rememberToken);
                    localStorage.setItem('logIn',true);
                    //this.$router.push({name: 'TodoView'}); not work
                    window.location.href = '/';
                }
                
            }
        )
        .catch(error => {

            this.errorLoginMsg='';
            let errorMessage = error.response.data.message;
            this.errorLoginMsg=errorMessage;
            this.errorLogin=true;
               
        });
    }
  },
  mounted(){
    this.userLogged=localStorage.getItem('logIn');
    if (this.userLogged) {
      this.$router.push({name: 'home'});
    }
  }

}
</script>
  
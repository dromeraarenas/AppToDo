<template>
    <div class="sidenav">
  
  
           <div class="login-main-text">
              <h2>Aañde tu nota</h2>
              <div>
                <input v-model="name" class="todoTitle" type="text" placeholder="Escribe el título de tu nota">
                <p>
                  <textarea v-model="description" class="todoDescription" rows="10" cols="50" placeholder="Escribe tu nota aqui"></textarea>
                </p>
                
  
                <label class="todo-list__label">
                  <input v-model="status" type="checkbox" />
                  <i class="check"></i>
                  <span>Completado</span>
                </label>
  
                <select  id="addCategories" name="addCategories" multiple>
                  <option v-for="category in categories" :key="category.id" :value="category.id" >{{ category.name }}</option>
                </select>
               
                <button class="addToDo" v-on:click="addToDo()">Añadir Nota</button>
              </div>
           </div>
        </div>
  
        <div class="main">
          <div class="alert alert-danger" v-if="error" role="alert">
            {{ errorMsg }}
          </div>
  
          <div class="alert alert-success" v-if="success" role="alert">
            {{ successMsg }}
          </div>
  
          <div class="row align-items-start">
            <div class="col" v-for="ToDo in ToDos" :key="ToDo.id" :id="ToDo.id">
                <div class="todo_item">
  
                  <div :class="ToDo.status">
                  <span v-on:click="deleteToDo(ToDo.id)">
  
                    <img class="deleteImg" src="../assets/img/delete.png">
                  
                  </span>
                  <input v-model="ToDo.name" class="todoTitle" type="text" placeholder="titulo">
  
                  <textarea v-model="ToDo.description" class="todoDescription" rows="10" cols="50" placeholder="Escribe tu nota aqui"></textarea>
  
                  <label class="todo-list__label">
                    <input v-on:change="changeStatus(ToDo)" class="chkStatus" type="checkbox" />
                    <i class="check"></i>
                    <span>Completado</span>
                  </label>
  
  
                  <select :data-todoid="ToDo.id" v-model="ToDo.categories" name="selectedCategories" class="selectedCategories" multiple>
  
                    <option
                      v-for="category in categories" :key="category.id" 
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
  
                  </select>
  
                  <button v-on:click="editToDo(ToDo)" class="editToDo">Editar Nota</button>
  
                </div>
  
                </div>
                
                
            </div>
     
          </div>
  
        </div>
  </template>
  
  <style>
  
  select {
    height: 43px;
    text-align: center;
    display: block;
    white-space: normal;
    overflow: hidden;
    border: none;
    background-color: transparent;
    margin: 0 auto !important;
  }
  
  
  option {
    width: 50px;
    margin: 5px;
    padding: 3px 5px;
    border: 1px solid #d2cdcd;
    border-radius: 5px;
    display: inline-block;
  }
  
  option:checked{
    background-color:aqua
  }
  
  .todo_item{
    margin-bottom: 20px;
  }
  
  .todoTitle, .todoDescription{
    width: 100%;
    border: 1px solid #d2cdcd;
    margin-bottom: 10px;
    background-color: transparent;
  }
  
  .deleteImg{
    width: 32px;
    height: 32px;
  
  }
  
  .deleteImg:hover{
    cursor: pointer;
  }
  
  .addToDo{
    background-color: transparent;
    border-radius: 10px;
    border: 1px solid #d2cdcd;
    padding: 10px;
    margin-left: 40%;
  }
  
  .editToDo{
    background-color: transparent;
    border-radius: 10px;
    border: 1px solid #d2cdcd;
    padding: 10px;
    margin-left: 34%;
  }
  
  .completed,.pending{
    padding: 15px;
  }
  
  .completed{
    background-color: rgb(23, 233, 205);
  }
  
  .pending{
    background-color: #4fedfd3b;
  }
  
  
  @media screen and (max-width: 768px) {
  
      .addToDo{
        margin-left: 30%;
      }
  
    }
  
  </style>
  
  <script>
    import axios from "axios";
  
    const token=localStorage.getItem('token');
    const axiosConfig = {
      headers: { Authorization: `Bearer ${token}` }
    };
  
    export default{
      name: "HomeView",
      //components: { Multiselect },
      data(){
        return {
          userLogged: false,
          apiUri: 'http://localhost:8000/api/',
          name: '',
          description: '',
          status: '',
          ToDos: [{categories: []}],
          categories: [],
          error: false,
          errorMsg: '',
          success: false,
          successMsg: '',
        }
      },
      methods:{
        addToDo(){
  
          if (this.name.length === 0 || this.description.length === 0) {
            this.error=true;
            this.errorMsg=" El nombre y la descripción de la nota son campos obligatorios";
            setTimeout(() => {
              this.error = false;
            }, 5000);
            return false;
          }
          
          let ListToDos=this.ToDos;
          if (this.status === true) {
            this.status='completed';
          }else{
            this.status='pending';
          }
          
          let endPoint=this.apiUri+'todo';
          
          let dataToDo={
              'name' :    this.name,
              'description' : this.description,
              'status': this.status
          }
  
          let options = document.getElementById('addCategories').options;
          var selectedCategories = [];
         
  
          for (let item of options) {
            if (item.selected) {
              selectedCategories.push(item.value);
            }
          }
  
          if (selectedCategories.length > 0) {
            dataToDo.categories=selectedCategories
          }
  
          
          axios
          .post(endPoint,dataToDo,axiosConfig)
          .then(
              function(response){
  
                  console.log(response.status);
  
                  if (response.status === 200) {
                    ListToDos.push(response.data[0])
                    console.log(ListToDos);
                  }
              }
          )
          .catch(error => {
              if (error.response !== undefined) {
  
                  let errorMessage = error.response.data.message;
                  this.error=true;
                  this.errorMsg=errorMessage;
  
              }
              
          });
  
  
        },
        editToDo(ToDo){
  
          let self=this;
  
          let dataToDo={
              'name' :    ToDo.name,
              'description' : ToDo.description,
              'status': ToDo.status
          }
  
          if (ToDo.categories !== undefined && ToDo.categories.length > 0) {
            dataToDo.categories= ToDo.categories
          }
          
          let endPoint=this.apiUri+'todo/'+ToDo.id;
  
          axios
          .put(endPoint,dataToDo,axiosConfig)
          .then(
              function(response){
  
                if (response.status === 201) {
  
                  self.success=true;
                  self.successMsg="Actualizado correctamente";
                  setTimeout(() => {
                    self.success = false;
                  }, 5000);
                }
              }
          )
          .catch(error => {
              if (error.response !== undefined) {
  
                  let errorMessage = error.response.data.message;
                  this.error=true;
                  this.errorMsg=errorMessage;
                  setTimeout(() => {
                    this.error = false;
                  }, 5000);
              }
              
          });
  
        },
        deleteToDo(id){
  
          let ListToDos=this.ToDos;
          let endPoint=this.apiUri+'todo/'+id;
          let deleteId=id;
  
          console.log(ListToDos);
          axios
          .delete(endPoint,axiosConfig)
          .then(
              function(response){
  
                  if (response.status === 200) {
                    let ToDoFound = ListToDos.findIndex(({ id }) => id === deleteId);
                    ListToDos.splice(ToDoFound, 1);
                  }
              }
          )
          .catch(error => {
              if (error.response !== undefined) {
  
                  let errorMessage = error.response.data.message;
                  this.error=true;
                  this.errorMsg=errorMessage;
  
                  setTimeout(() => {
                    this.error = false;
                  }, 5000);
  
              }
              
          });
  
        },
        changeStatus(ToDo){
          let chkStatus=document.getElementById(ToDo.id).querySelector('.chkStatus');
  
          console.log(chkStatus.checked);
  
          if (chkStatus.checked  === true) {
            ToDo.status='completed'
          }else{
            ToDo.status='pending'
          }
  
        },
       
         
        
      },
      mounted(){
        
        this.userLogged=localStorage.getItem('logIn');
  
        if (!this.userLogged) {
          this.$router.push('/login');
        }
  
        let endPoint=this.apiUri+'categories';
        
        axios
        .get(endPoint, axiosConfig)
        .then((response) => {
  
          this.categories= response.data
        
        })
        .catch(error => {
          console.log(error);
        });
  
  
        endPoint=this.apiUri+'todos';
        
        axios
        .get(endPoint, axiosConfig)
        .then((response) => {
  
          this.ToDos= response.data
      
          //SET CATEGORY SELECTED
          waitForElm('.selectedCategories').then(function(){
  
            for(let todoData of response.data ){
              let todoId=todoData.id;
              let selectFound=document.querySelector("[data-todoid='"+todoId+"']");
              //console.log(selectFound);
  
              if (todoData.categories !== undefined && todoData.categories.length > 0) {
                for(let cateogry of todoData.categories){
                  let categoryId=cateogry.id;
                  
                  let optionFound=selectFound.querySelector("[value='"+categoryId+"']");
                  
                  if (optionFound !== null) {
                    optionFound.setAttribute('selected',true);
                  }
                  //optiontFound.setAttribute('selected',true);
                }
                
              }
  
            }
  
          });
  
          function waitForElm(selector) {
      return new Promise(resolve => {
            if (document.querySelector(selector)) {
              return resolve(document.querySelector(selector));
            }
  
            const observer = new MutationObserver(function (){
              
              if (document.querySelector(selector)) {
                  resolve(document.querySelector(selector));
                  observer.disconnect();
              }
  
            });
  
            observer.observe(document.body, {
              childList: true,
              subtree: true
            });
          });
    }
  
        })
        .catch(error => {
          console.log(error);
        });
  
        
  
        
        
      }
    }
  
  </script>
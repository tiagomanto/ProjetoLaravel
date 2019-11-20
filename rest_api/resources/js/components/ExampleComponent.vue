<template>
  <div id="app">

<!--      <nav>
      <div class="nav-wrapper blue darken-1">
        <a href="#" class="brand-logo center">Front of Products</a>
      </div>
    </nav> -->
 
     <!-- <div class="container">  -->

<!--        <ul>
        <li v-for="(erro, index) of errors" :key="index">
          campo <b>{{erro.field}}</b> - {{erro.defaultMessage}}
        </li>
      </ul>  -->
 
  <!-- :method="method.toUpperCase() == 'GET' ? 'GET' : 'POST'" -->

      <form @submit.prevent="salvar" >
       <!--  <input-hidden :value="csrfToken" name="_token"/> -->
           <!-- <input-hidden
              v-if="['GET', 'POST'].indexOf(method.toUpperCase()) === -1"
              :value="method"
              name="_method"
              /> -->
          
          <label>Nome</label>{{errors}}
           <input type="text" placeholder="Nome" v-model="produto.name" >
          <label>Descrição</label>{{errors}}
          <textarea rows="50" placeholder="Descrição" v-model="produto.description">
          </textarea>
          <!-- <input type="text" placeholder="Descrição" v-model="produto.descricao" >-->
          <label>Valor</label>{{errors}}
          <input type="text" placeholder="Valor" v-model="produto.price" > 

          <button class="waves-effect waves-light btn-small">Salvar<i class="material-icons left">save</i></button>

      </form>

      <table>

        <thead>

          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>OPÇÕES</th>
          </tr>

        </thead>

        <tbody>

          <tr v-for="produto of produtos" :key="produto.id">

            <td>{{ produto.name }}</td>
            <td>{{ produto.description }}</td>
            <td>{{ produto.price }}</td> 
<!--             <td>{{ produto.created_at }}</td> 
            <td>{{ produto.updated_at }}</td>  -->
            <td>
              <button @click="editar(produto)" class="waves-effect btn-small blue darken-1"><i class="material-icons">create</i></button>
              <button @click="remover(produto)" class="waves-effect btn-small red darken-1"><i class="material-icons">delete_sweep</i></button>
            </td>

          </tr>

        </tbody>
      
      </table>

    </div>
</template>

<script>

import Produto from '../services/produtos' 
import { http } from '../services/config'

    export default {
     // props: { method: { default: 'POST' }},


      data(){
        return {          
          
          produto: {
            id:'',
            name: '',
            description:'',
            price: ''
          },

          produtos: [],
          errors: []
        }
      },

/*       created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
 */
        mounted() {
          this.listar()  
            
        },

        methods:{

          listar(){
            Produto.listar().then(resposta => {
              this.produtos = resposta.data.data
            })

          },

          salvar(){
            if (!this.produto.id){
                
                Produto.salvar(this.produto).then(resposta =>{
                  console.log(resposta)
                this.produto={}
                alert('O produto Salvo com sucesso')
                this.listar()
                this.errors=[]
              }).catch(e => {
              console.log(e.response)
              this.errors='- Campo obrigatório'
              //this.errors=e.response.data.errors
            })  
            } else{
                
                Produto.atualizar(this.produto).then(resposta =>{
                console.log(resposta)
                this.produto={}
                alert('O produto atualizado com sucesso')
                
                this.listar()
                this.errors=[]
              }).catch(e => {
                console.log(e.response)
                this.errors='- Campo obrigatório'
              })

            }
            
          },
          
          editar(produto){
            this.produto = produto

          },

          remover(produto){

            if(confirm('Deseja excluir o produto?')){
              Produto.apagar(produto).then(resposta =>{
              console.log(resposta)
              this.listar();
              this.errors=[]
            }).catch(e => {
              console.log(e.response)
              this.errors='- Campo obrigatório'
              //this.errors=e.response.data.errors
            })
            }
          }
        }    
      }

</script>
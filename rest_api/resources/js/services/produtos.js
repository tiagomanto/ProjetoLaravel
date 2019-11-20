import {http} from './config'

export default {

    listar:() =>{
        return http.get('products')
    },

    salvar:(produto) => {
        return http.post('products',produto)
        /* .then((res) => console.log(res.data))
        .catch((err) => console.log(err)); */
        
    },
    atualizar:(produto) => {
        return http.put('products/'+produto.id+'/',produto)
        
      },

    apagar:(produto) => {
        return http.delete('products/'+ produto.id)

      }


}
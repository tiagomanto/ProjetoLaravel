import {http} from './config'

export default {

    listar:() =>{
        return http.get('products')
    },

    salvar:(produto) => {
        return http.post('products',produto)
        /* .then((res) => console.log(res.data))
        .catch((err) => console.log(err)); */
        
    }


}
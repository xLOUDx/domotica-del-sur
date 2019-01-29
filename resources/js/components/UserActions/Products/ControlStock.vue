<template>
    <div class="container">

    <table class="table table-hover">
    <thead>
        <tr>
            <th class="table-primary" scope="col">ID</th>
            <th class="table-primary" scope="col">Modelo</th>
            <th class="table-primary" scope="col">Precio</th>
            <th class="table-primary" scope="col">Stock</th>
            <th class="table-primary" scope="col">Último movimiento</th>
            <th class="table-primary" scope="col">Ver</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="pro in products">
            <th>{{ pro.id }}</th>
            <td>{{ pro.model }}</td>
            <td>{{ pro.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
            <td>{{ pro.stock }}</td>
            <td>{{ moment(pro.updated_at).format('l') }}</td>
            <td> <button @click="getDetail(pro.id, pro.model)" class="btn btn-primary">Ver</button> </td>
        </tr>
    </tbody>
    </table>

    </div>
</template>

<script>
import moment from 'moment';

export default {
    data(){
        return{
            products: {

            },
            plusStock: 0,
            lessStock: 0
        }
    },
    created(){
        this.getData();
    },
    methods: {
        getData(){
            axios.get('/items')
                .then((response) => this.products = response.data)
                .catch((error) => console.log(error));
        },
        addStock(id){
            axios.post('/addstock', { id: id, number: this.plusStock })
                .then((response) => {
                    //console.log(response.data);
                    this.getData();
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        getDetail(id, model){            
            this.$router.push({ name: 'StockDetail', params: { id: id, model: model }});  
        },
        deleteStock(id){
            axios.post('/deletestock', { id: id, number: this.lessStock })
                .then((response) => {
                    //console.log(response.data);
                    this.getData();
                })    
                .catch((error) => {
                    console.log(error);
                })
        },
        moment(date) {
            moment.locale('es');
            return moment(date);
        },
    }
}
</script>

<style>

</style>

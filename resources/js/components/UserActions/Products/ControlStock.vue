<template>
    <div class="container">

    <table class="table table-hover">
    <thead>
        <tr>
            <th class="table-primary" scope="col">ID</th>
            <th class="table-primary" scope="col">Modelo</th>
            <th class="table-primary" scope="col">Precio</th>
            <th class="table-primary" scope="col">Stock</th>
            <th class="table-primary" scope="col">Fecha de ultima entrada</th>
            <th class="table-primary" scope="col">Ver</th>
            <th class="table-primary" scope="col">Agregar</th>
            <th class="table-primary" scope="col">Quitar</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="pro in products">
            <th>{{ pro.id }}</th>
            <td>{{ pro.model }}</td>
            <td>{{ pro.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
            <td>{{ pro.stock }}</td>
            <td>{{ pro.updated_at }}</td>
            <td> <input type="number" @change="addStock(pro.id)" v-model="plusStock" placeholder="Numero de ingresos" class="form-control"> </td>
            <td> <input type="number" @change="deleteStock(pro.id)" v-model="lessStock" placeholder="Numero de salidas" class="form-control"> </td>
            <td> <button @click="getDetail(pro.id)" class="btn btn-primary">Ver</button> </td>
        </tr>
    </tbody>
    </table>

    </div>
</template>

<script>
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
                    console.log(response.data);
                    this.getData();
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        getDetail(id){            
            this.$router.push({ name: 'StockDetail', params: { id: id }});  
        },
        deleteStock(id){
            axios.post('/deletestock', { id: id, number: this.lessStock })
                .then((response) => {
                    console.log(response.data);
                    this.getData();
                })    
                .catch((error) => {
                    console.log(error);
                })
        }
    }
}
</script>

<style>

</style>

<template>
    <div class="container">

        <table v-if="this.tipo == 'transaction'" class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th class="table-primary" scope="col">ID</th>
                <th class="table-primary" scope="col">Metodo de pago</th>
                <th class="table-primary" scope="col">Orden de compra</th>
                <th class="table-primary" scope="col">Monto</th>
                <th class="table-primary" scope="col">Fecha</th>
                <th class="table-primary" scope="col">Detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="sal in sales">
                <th>{{ sal.id }}</th>
                <td>{{ sal.payment }}</td>
                <td>{{ sal.buyorder }}</td>
                <td>{{ sal.ammount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
                <td>{{ sal.created_at }}</td>
                <td> <button class="btn btn-link" @click="getDetails(sal.id, sal.ammount)">Ver detales</button> </td>
            </tr>
        </tbody>
        </table>

        <table v-if="this.tipo == 'sale'" class="table table-hover table-responsive-sm">
        <thead>
            <tr>
                <th class="table-primary" scope="col">ID</th>
                <th class="table-primary" scope="col">Cliente</th>
                <th class="table-primary" scope="col">Rut de cliente</th>
                <th class="table-primary" scope="col">Empresa</th>
                <th class="table-primary" scope="col">Rut empresa</th>
                <th class="table-primary" scope="col">Modo de pago</th>
                <th class="table-primary" scope="col">Monto</th>
                <th class="table-primary" scope="col">Descuento</th>
                <th class="table-primary" scope="col">Detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="sal in sales">
                <th> {{ sal.id }} </th>
                <td>{{ sal.client }}</td>
                <td>{{ sal.rutclient }}</td>
                <td>{{ sal.company }}</td>
                <td>{{ sal.rutcompany }}</td>
                <td>{{ sal.payment }}</td>
                <td>{{ sal.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
                <td>{{ sal.discount }}</td>
                <td> <button class="btn btn-link" @click="getDetails(sal.id, sal.amount)">Ver detales</button> </td>
            </tr>
        </tbody>
        </table>

    </div>        
</template>

<script>
export default {
    props:['type'],
    data(){
        return{
            sales: {

            },
            tipo: ''
        }
    },
    watch: {
        '$props':{
        handler: function (val, oldVal) { 
            this.getType();
        },
        deep: true
        }
    },
    created(){
        this.getType();
    },
    methods: {
        getDetails(id, monto){
            this.$router.push({ name: 'SalesDetail', params: { id: id, total: monto }});
        },
        getType(){
            this.tipo = this.type;
            this.getData();
        },
        getData(){
            axios.post('/sales', { type: this.type })
                .then((response) => {
                    this.sales = response.data
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

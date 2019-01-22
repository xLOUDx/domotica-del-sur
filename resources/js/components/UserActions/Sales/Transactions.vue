<template>
    <div class="container">

        <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
            <th class="table-primary" scope="col">ID</th>
            <th class="table-primary" scope="col">Código de autorización</th>
            <th class="table-primary" scope="col">Metodo de pago</th>
            <th class="table-primary" scope="col">Aprovada</th>
            <th class="table-primary" scope="col">Cuotas</th>
            <th class="table-primary" scope="col">Monto</th>
            <th class="table-primary" scope="col">Orden de compra</th>
            <th class="table-primary" scope="col">Fecha</th>
            <th class="table-primary" scope="col">Detalles</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="tran in transactions">
                <th scope="row">{{ tran.id }}</th>
                <td>{{ tran.authorizationcode }}</td>
                <td>{{ tran.payment }}</td>
                <td style="background-color:#DAF7A6;">{{ tran.approved }}</td>
                <td>{{ tran.sharesNumber }}</td>
                <td style="background-color:#FFC300;">$ {{ tran.ammount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
                <td>{{ tran.buyorder }}</td>
                <td>{{ tran.created_at }}</td>
                <th> <button @click="getDetails(tran.id, tran.ammount)" type="button" class="btn btn-link">Ver detalles...</button> </th>
            </tr>
        </tbody>
        </table>

    </div>        
</template>

<script>
export default {
    data(){
        return{
            transactions: {

            }
        }
    },
    created(){
        axios.post('/sales', { type: 'transaction' })
            .then((response) => {
                this.transactions = response.data
            })
            .catch((error) => {
                console.log(error);
            })
    },
    methods: {
        getDetails(id, monto){
            this.$router.push({ name: 'SalesDetail', params: { id: id, total: monto }});
        }
    }
}
</script>

<style>

</style>

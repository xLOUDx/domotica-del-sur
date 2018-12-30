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
            </tr>
        </thead>
        <tbody>
            <tr v-for="tran in transactions">
                <th scope="row">{{ tran.id }}</th>
                <td>{{ tran.authorizationcode }}</td>
                <td>{{ tran.payment }}</td>
                <td>{{ tran.approved }}</td>
                <td>{{ tran.sharesNumber }}</td>
                <td>{{ tran.ammount }}</td>
                <td>{{ tran.buyorder }}</td>
                <td>{{ tran.created_at }}</td>
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
        axios.get('/transactions')
            .then((response) => {
                this.transactions = response.data;
                //console.log(response.data);
            })
            .catch((error) => {
                console.log(error);
            })
    }
}
</script>

<style>

</style>

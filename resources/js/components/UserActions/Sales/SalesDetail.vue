<template>
    <div class="container">

        <table class="table table-hover table-responsive-sm">
        <thead>
            <tr>
            <th class="table-primary" scope="col">Producto</th>
            <th class="table-primary" scope="col">Precio</th>
            <th class="table-primary" scope="col">Cantidad</th>
            <th class="table-primary" scope="col">Fecha</th>
            <th class="table-primary" scope="col">Total</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="det in details">
                <td>{{ det.model }}</td>
                <td>{{ det.price }}</td>
                <td>{{ det.quantity }}</td>
                <td>{{ det.created_at }}</td>
                <td style="display:none;">{{ getDiscount(det.discount)}}</td>
                <td style="background-color:#FFC300;">{{ det.total }}</td>
            </tr> 
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>Total: </th>
                <th>${{ this.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <th>Total con descuento: </th>
                <th>${{ (this.total * this.discount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</th>
            </tr>
        </tfoot>
        </table>
    </div>
</template>

<script>
export default {
    props: ['id', 'total'],
    data(){
        return{
            details: {

            },
            discount: ''
        }
    },
    created(){
        this.getData();
    },
    methods:{
        getData(){
            axios.post('/details', { id: this.id })
                .then((response) => {
                    this.details = response.data;                
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        getDiscount(d){
            this.discount = d;            
        }
    }

}
</script>

<style>

</style>

<template>
    <div class="container-fluid">

        <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col-md-4">
                        Usuario: {{ this.detail.name }}
                    </div>
                    <div class="col-md-4">
                        Rut: {{ this.detail.rut }}
                    </div>
                    </div>
                </div>
                <div class="card-body" style="align-text:center;">
    
                <div class="form-group row">
                    <div class="col-md-6">
                        <h6 for="exampleInputEmail1">Rol: {{ this.detail.rol }}</h6>
                    </div>
                    <div class="col-md-6">
                    <div>
                        <h6 class="typo__label">Creado en: {{ moment(this.detail.created_at).format('l') }}</h6>
                    </div>
                    </div>
                </div>     

                <div class="form-group row">
                    <div class="col-md-6">
                        <h6 for="exampleInputEmail1"> {{ this.detail.rol == 'Cliente' ? `Número de compras: ${this.detail.numberSales}`: `Número de ventas: ${this.detail.numberSales}`}}</h6>
                    </div>
                    <div class="col-md-6">
                    <div>
                        <!-- <h6 class="typo__label">Ultima venta: 10/01/2019</h6> -->
                        <h6 for="exampleInputEmail1">Dinero recaudado: {{ this.detail.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</h6>
                    </div>
                    </div>
                </div> 
            
                <div class="form-group row">
                    <div class="col-md-6">
                        <h6 for="exampleInputEmail1">Dinero recaudado: {{ this.detail.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</h6>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div> 

                </div>
                  <div class="card-footer">
                    <div>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="table-primary" scope="col">Orden de compra</th>
                            <th class="table-primary" scope="col">Vendedor</th>
                            <th class="table-primary" scope="col">Modo pago</th>
                            <th class="table-primary" scope="col">Monto</th>
                            <th class="table-primary" scope="col">Descuento</th>
                            <th class="table-primary" scope="col">Fecha</th>
                            <th class="table-primary" scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="it in sales">
                            <th scope="row">{{ it.buyorder }}</th>
                            <td>{{ it.seller }}</td>
                            <td>{{ it.Payment }}</td>
                            <td>{{ it.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
                            <td>{{ it.discount }}</td>
                            <td>{{ moment(it.created_at).format('l') }}</td>
                            <td> <button class="btn btn-link" @click="getDetails(it.id, it.amount)">Ver detales</button> </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        </div>
      

    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: ['id'],
    data(){
        return {
            detail: {
                name: '',
                rut: '',
                amount: 0,
                rol: '',
                created: '',
                lastSale: '',
                numberSales: ''
            },
            sales: {

            },
            type: ''
        }
    },
    created(){
        this.getData();
    },
    methods:{
        getData(){
            axios.post('/detailsclient', { id: this.id })
                .then((response) => {
                    this.detail.rol = response.data[1];
                    this.detail.created = response.data[0].created_at;
                    this.detail.numberSales = response.data[2].length;

                    let amount = 0;
                    response.data[2].map(x => {
                        this.detail.amount += parseInt(x.amount);
                        //amount += parseInt(x.amount); 
                    });
                    //console.log( amount );

                    this.sales = response.data[2];
                })
                .catch((error) => { console.log(error) });
        },
        getDetails(id, monto){
            this.$router.push({ name: 'SalesDetail', params: { id: id, total: monto }});
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

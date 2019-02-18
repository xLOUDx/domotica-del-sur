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
                        <h6 for="exampleInputEmail1">Dinero recaudado: ${{ this.detail.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</h6>
                    </div>
                    </div>
                </div> 

                </div>
                  <div class="card-footer">
                    <!-- TABLA --> 
                    <div>
                        <vue-good-table
                        :columns="columns"
                        :rows="rows"
                        :pagination-options="{
                            enabled: true,
                            perPage: 5,
                            nextLabel: 'Siguente',
                            prevLabel: 'Anterior',
                            rowsPerPageLabel: 'Registros por página',
                            ofLabel: 'De',
                            allLabel: 'Todo',
                            pageLabel: 'Página'
                        }"
                        @on-cell-click="onCellClick">

                        <div slot="emptystate">
                            No hay datos para mostrar
                        </div>
                        </vue-good-table>
                    </div> 
                    <!-- END -->
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
            columns: [
{
                    label: 'Orden de compra',
                    field: 'buyorder',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Vendedor',
                    field: 'seller',
                    filterOptions: { enabled:true },
                }, 
                {
                    label: 'Modo pago',
                    field: 'payment',
                    filterOptions: { enabled:true }
                }, 
                {
                    label: 'Monto',
                    field: 'amount',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Descuento',
                    field: 'discount',
                    filterOptions: { enabled:true },
                    type: 'percentage'
                },
                {
                    label: 'Fecha',
                    field: 'created_at',
                    filterOptions: { enabled:true },
                }, 
                {
                    label: 'Detalles',
                    field: 'details',
                    html: true,
                }, 
            ],
            detail: {
                name: '',
                rut: '',
                amount: 0,
                rol: '',
                created: '',
                lastSale: '',
                numberSales: ''
            },
            rows: [],
            type: ''
        }
    },
    created(){
        this.getData();
    },
    methods:{
        onCellClick(params){
            let exp = params.event.toElement.className;
            let id = params.row.id;
            let amount = params.row.amount
            console.log(exp);
            if(exp == 'btn btn-link'){
                this.getDetails(id, amount);
            } 
        },
        getData(){
            axios.post('/detailsclient', { id: this.id })
                .then((response) => {
                    this.detail.rol = response.data[1];
                    this.detail.created = response.data[0].created_at;
                    this.detail.numberSales = response.data[2].length;

                    let amount = 0;
                    let data = [];

                    response.data[2].map(x => {
                        let details = {
                            details: '<button class="btn btn-link" @click="getDetails(it.id, it.amount)">Ver detales</button>'         
                        }
                        this.detail.amount += parseInt(x.amount);
                        x.amount = x.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                        x.created_at = moment(x.created_at).format('l');
                        
                        var obj = Object.assign({}, x, details);
                        data.push( obj );
                    });
                    this.rows = data;
                })
                .catch((error) => { console.log(error) });
        },
        getDetails(id, monto){
            monto = monto.replace('.', '');
            monto = parseInt(monto);
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

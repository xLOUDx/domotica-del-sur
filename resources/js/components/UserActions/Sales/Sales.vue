<template>
    <div class="container-fluid">

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
</template>

<script>
import moment from 'moment';

export default {
    data(){
        return{
            sales: {

            },
            tipo: '',
        columns: [
            {
                label: 'Vendedor',
                field: 'seller',
                filterOptions: {
                    enabled: true,
                },
            },
            {
                label: 'Orden de compra',
                field: 'buyorder',
                type: 'number',
                filterOptions: {
                    enabled: true,
                },
                type: 'number'
            },
            {
                label: 'Cliente',
                field: 'client',
                filterOptions: {
                    enabled: true,
                },
            },
            {
                label: 'Rut de cliente',
                field: 'rutclient',
                filterOptions: {
                    enabled: true,
                },
                type: 'percentage',
                type: 'number'
            },
            {
                label: 'Empresa',
                field: 'company',
                filterOptions: {
                    enabled: true,
                },
            },
            {
                label: 'Rut empresa',
                field: 'rutcompany',
                filterOptions: {
                    enabled: true,
                },
                type: 'number'
            },
            {
                label: 'Modo de pago',
                field: 'payment',
                filterOptions: {
                    enabled: true,
                },
            },
            {
                label: 'Monto',
                field: 'amount',
                filterOptions: {
                    enabled: true,
                },
                type: 'percentage',
                type: 'number'
            },
            {
                label: 'Descuento',
                field: 'discount',
                filterOptions: {
                    enabled: true,
                },
                type: 'percentage',
            },
            {
                label: 'Fecha',
                field: 'created_at',
                filterOptions: {
                    enabled: true,
                },
            },
            {
                label: 'Detalles',
                field: 'see',
                html: true
            },
        ],
        rows: [],
        }
    },
    created(){
        this.getData();
    },
    methods: {
        getDetails(id, monto){
            monto = monto.replace('.', '');
            monto = parseInt(monto);
            this.$router.push({ name: 'SalesDetail', params: { id: id, total: monto }});
        },
        onCellClick(params){
            let exp = params.event.toElement.className;
            let id = params.row.id;
            let amount = params.row.amount
            
            if(exp == 'btn btn-link'){
                this.getDetails(id, amount);
            } 
        },
        getData(){
            axios.post('/sales', { type: 'sale' })
                .then((response) => {
                    this.sales = response.data
                    let data = [];
                    response.data.map( x => {
                        let see = {
                            see: '<button @click="getDetails(tran.id, tran.ammount)" type="button" class="btn btn-link">Ver detalles...</button>'
                        };

                        x.amount = x.amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
                        x.created_at = moment(x.created_at).format('l');
                        var obj = Object.assign({}, x, see);
                        data.push( obj );
                    });
                this.rows = data;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        moment(date) {
            moment.locale('es');
            return moment(date);
        },
        filterTable(){

        }
    }
}
</script>

<style>

</style>

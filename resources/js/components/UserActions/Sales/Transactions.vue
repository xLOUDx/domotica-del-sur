<template>
    <div class="container">

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
            transactions: {

            },
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Código de autorización',
                    field: 'authorizationcode',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Metodo de pago',
                    field: 'payment',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                },
                {
                    label: 'Aprobado',
                    field: 'approved',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Cuotas',
                    field: 'sharesNumber',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Monto',
                    field: 'ammount',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Orden de compra',
                    field: 'buyorder',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
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
                }
            ],
            rows: []
        }
    },
    created(){
        axios.post('/sales', { type: 'transaction' })
            .then((response) => {
                this.transactions = response.data
                let data = [];
                response.data.map( x => {
                    let see = {
                        see: '<button @click="getDetails(tran.id, tran.ammount)" type="button" class="btn btn-link">Ver detalles...</button>'
                    };

                    x.ammount = x.ammount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); 
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
    methods: {
        getDetails(id, monto){
            monto = monto.replace('.', '');
            monto = parseInt(monto);
    
            this.$router.push({ name: 'SalesDetail', params: { id: id, total: monto }});
        },
        onCellClick(params){
            let exp = params.event.toElement.className;
            let id = params.row.id;
            let amount = params.row.ammount;
            
            if(exp == 'btn btn-link'){
                this.getDetails(id, amount);
            } 
        },
        moment(date) {
            moment.locale('es');
            return moment(date);
        }
    }
}
</script>

<style>

</style>

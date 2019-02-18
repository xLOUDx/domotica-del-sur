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
            products: {

            },
            plusStock: 0,
            lessStock: 0,
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
                    label: 'Modelo',
                    field: 'model',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Precio',
                    field: 'price',
                    filterOptions: {
                        enabled: true,
                    },
                    type: 'number',
                },
                {
                    label: 'Stock',
                    field: 'stock',
                    filterOptions: {
                        enabled: true,
                    },
                    type: 'number',                  
                },
                {
                    label: 'Último movimiento',
                    field: 'created_at',
                    //dateInputFormat: 'YYYY-MM-DD ',
                    //dateOutputFormat: '',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Ver',
                    field: 'see',
                    html: true,
                },
                {
                    
                }
            ],
            rows: [

            ]
        }
    },
    created(){
        this.getData();
    },
    methods: {
        onCellClick(params){
            let exp = params.event.toElement.className;
            let id = params.row.id;
            
            if(exp == 'btn btn-primary'){
                this.getDetail(id);
            } 
            
        },
        getData(){
            axios.get('/items')
                .then((response) => {
                    let data = [];
                    response.data.map( x => {
                        let see = {
                            see: '<button class="btn btn-primary">Ver</button>'
                        };
                        x.price = x.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                        x.created_at = moment(x.created_at).format('l');
                        //console.log( x.data );
                        var obj = Object.assign({}, x, see);
                        data.push( obj );
                    });
                    this.rows = data;
                })
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

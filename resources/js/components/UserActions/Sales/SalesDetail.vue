<template>
    <div class="container">


        <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Detalle de compra
                </div>

                <div class="card-body" style="align-text:center;">
                    <div class="form-group row">
                    <div class="col-md-6">
                        <h6 for="exampleInputEmail1">Monto: $ {{ this.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</h6>
                    </div>
                    <div class="col-md-6">
                    <div>
                        <h6 class="typo__label"> Monto con descuento: $ {{ (this.total - (this.total * this.discount)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }} </h6>
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
                        }">

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
    props: ['id', 'total'],
    data(){
        return{
            details: {

            },
            discount: '',
            columns: [
                {
                    label: 'Producto',
                    field: 'model',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                },
                {
                    label: 'Precio',
                    field: 'price',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Cantidad',
                    field: 'quantity',
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
                    placeholder: "Filtro por ID",
                },
                {
                    label: 'Total',
                    field: 'total',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                
            ],
            rows: []
        }
    },
    created(){
        this.getData();
    },
    methods:{
        getData(){
            axios.post('/details', { id: this.id })
                .then((response) => {
                    response.data.map( x => {
                        x.price = x.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        x.created_at = moment(x.created_at).format('l');
                    });
                    this.details = response.data;     
                    this.rows = response.data;     
                    this.discount = response.data[0].discount;    
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

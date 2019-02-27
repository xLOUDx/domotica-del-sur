<template>
    <div class="container">

    <h1>Historial de inventario: {{ this.model }}</h1> <br>
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label>Ingreso de stock</label>
                <input type="number" v-model="stock.enter" class="form-control" placeholder="Entrada de stock">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Salida de stock</label>
                <input type="number" v-model="stock.outsale" class="form-control" placeholder="Salida de stock">
            </div>
        </div>
        <div class="col"> 
            <button style="visibility:hidden;">waaaaaa</button> <br>
            <button @click= "addStock" class="btn btn-primary">Guardar</button>
        </div>
    </div> <br>

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
</template>

<script>
import moment from 'moment';
export default {
    props: ['id', 'model'],
    data(){
        return{
            stock: {
                enter: 0,
                outsale: 0,
                total: 0
            },
            stocked: {

            },
            columns: [
                {
                    label: 'Fecha',
                    field: 'name',
                    filterOptions: { enabled:true },
                },
                {
                    label: 'Ingresos',
                    field: 'enter',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Salidas',
                    field: 'outsales',
                    filterOptions: { enabled:true },
                    type: 'number'
                },
                {
                    label: 'Total',
                    field: 'total',
                    filterOptions: { enabled:true },
                    type: 'number'
                }
            ],
            rows: []
        }
    },
    created(){
        this.fetchData();
    },
    methods: {
        addStock(){
            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            if(this.stock.enter == ''){
                this.stock.enter = 0;
            }
            if(this.stock.outsale == ''){
                this.stock.outsale = 0;
            }

            this.stock.total = this.stock.enter - (this.stock.outsale);
            axios.post('/addstock', { id: this.id, numbers: this.stock })
                .then((response) => {
                    console.log(response.data);
                    if(response.data == false){
                    toast({
                        type: 'error',
                        title: 'No tiene stock'
                    });
                    } else {
                    this.stock = {
                        enter: 0,
                        outsale: 0,
                        total: 0
                    }
                    this.fetchData();
                    toast({
                        type: 'success',
                            title: 'Stock cargado con éxito'
                    });
                    }
                })
                .catch((error) => {
                    toast({
                        type: 'error',
                        title: 'Ocurrió un problema al cargar stock'
                    });
                });
        },
        moment(date) {
            moment.locale('es');
            return moment(date);
        },
        fetchData(){

            axios.post('/stock', { id: this.id })
                .then((response) => {
                    this.stocked = response.data;
                    //console.log( response.data );
                })
                .then((response) => this.prueba())
                .catch((error) => {
                    console.log(error);
                })
        },
        prueba(){

        let result = [];    
        
        this.stocked.forEach(function (a) {
            if (!this[moment(a.created_at).format('l')]) {
                this[moment(a.created_at).format('l')] = { name: moment(a.created_at).format('l'), enter: 0, outsales: 0, total: 0 };
                result.push(this[moment(a.created_at).format('l')]);
            }
            this[moment(a.created_at).format('l')].enter += a.enter;
            this[moment(a.created_at).format('l')].outsales += a.outsales;
            //this[moment(a.created_at).format('l')].before = a.before;
            this[moment(a.created_at).format('l')].total = a.total;
            
        }, Object.create(null));
        //this.stocked = result;
        let arreglo = [];
        //console.log(result);
        result.map(x => {
            var total = {
                total: ''
            }

            total.total = x.total;
            var obj = Object.assign({}, x, total);
            arreglo.push(obj)
        });
        arreglo = arreglo.reverse();
        this.rows = arreglo;

        } 
    }
}
</script>

<style>

</style>

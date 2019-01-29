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

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="table-primary" scope="col">Fecha</th>
                <th class="table-primary" scope="col">Ingresos</th>
                <th class="table-primary" scope="col">Salidas</th>
                <th class="table-primary" scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="stock in stocked">
                <th scope="row">{{ stock.name }}</th>
                <td>{{ stock.enter }}</td>
                <td>{{ stock.outsales }}</td>
                <td>{{ stock.enter - stock.outsales }}</td>
            </tr>
        </tbody>
    </table>
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

            }
        }
    },
    created(){
        this.fetchData();
    },
    methods: {
        addStock(){
            this.stock.total = this.stock.enter - (this.stock.outsale);
            axios.post('/addstock', { id: this.id, numbers: this.stock })
                .then((response) => {
                   //console.log(response.data);
                    this.stock = {
                        enter: 0,
                        outsale: 0,
                        total: 0
                    }
                    this.fetchData();
                })
                .catch((error) => console.log(error));
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
                this[moment(a.created_at).format('l')] = { name: moment(a.created_at).format('l'), enter: 0, outsales: 0, before: 0 };
                result.push(this[moment(a.created_at).format('l')]);
            }
            this[moment(a.created_at).format('l')].enter += a.enter;
            this[moment(a.created_at).format('l')].outsales += a.outsales;
            this[moment(a.created_at).format('l')].before += a.before;
        }, Object.create(null));
        this.stocked = result;
        //console.log(result);

        } 
    }
}
</script>

<style>

</style>

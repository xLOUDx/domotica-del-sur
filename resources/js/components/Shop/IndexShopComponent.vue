<template>
    <div class="container-fluid">

        <div class="row h-100" >

        <!-- Sidebar Category start -->
        <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2 bg-white rounded" align="center" style="text-align:center;">
           

            <div class="list-group col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <a href="/" class="list-group-item h5" style="background-color:#C3E1F1;">Inicio</a>
            </div> <br> <br>
        <h3> <strong> Categorias </strong> </h3> 
            <div class="list-group col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <a href="#" class="list-group-item active"> <span>Todas</span></a>
                <a href="#" class="list-group-item"> <span>Domo</span></a>
                <a href="#" class="list-group-item"> <span>IP</span></a>
                <a href="#" class="list-group-item" @click="newItem"> <span>DVR</span></a>
                <!--Cart Modal start -->
                <cart-shop class="alert alert-success" :type="type"> </cart-shop>                 
                <!--Cart Modal end -->
            </div>
        </div>
        <!-- Sidebar Category end -->

        <!-- Shop items start -->
        <div class="col-sm-12 col-md-9 col-lg-10 col-xl-10">
            <div class="row">

                <details-item v-show="detOpen"> </details-item>
                <div v-for="prod in data" class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <!-- PROD es el detalle que se envia a la cajita -->
                    <!-- Si quieres agregar un producto cambia "v-show=true por false" -->
                    <item-shop class="align-self: center !important;" v-show="indexProd" :prod="prod"> </item-shop> 
                </div>
                <new-item v-if="itemNew"> </new-item>
            </div>
        </div>

        </div>

</div>
</template>
<script>
import EventBus from '../../event-bus';

export default {
    data(){
        return{
            type: 'Carrito',
            data: {
            },
            detOpen: false,
            indexProd: true,
            itemNew: false
        }
    },

    created(){
        axios.get('/items')
            .then((response) => {
                this.data = response.data;
            })
            .catch((error) => console.log(error));

        EventBus.$on('details', data => {
            this.detOpen = !this.detOpen;
            this.indexProd = !this.indexProd;
        });

        EventBus.$on('backStore', data => {
            this.detOpen = !this.detOpen;
            this.indexProd = !this.indexProd;
        });

    },
    methods:{
        newItem(){
            this.indexProd = !this.indexProd;
            this.itemNew = !this.itemNew;
        }
    }
}

</script>
<style>
    
</style>



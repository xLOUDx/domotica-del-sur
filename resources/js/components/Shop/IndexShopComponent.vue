<template>
    <div class="container-fluid d-flex h-100" >

        <div class="row h-100 d-flex justify-content-center" >

        <!-- Sidebar Category start -->
        <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2 shadow p-3 mb-5 bg-white rounded" align="center" style="text-align:center;">
           

            <div class="list-group col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <a href="/" class="list-group-item" style="background-color:#C3E1F1;">Inicio</a>
            </div> <br> <br> <br>
        <h3>Categorias</h3> 
            <div class="list-group col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <a href="#" class="list-group-item active"> <span>Todas</span></a>
                <a href="#" class="list-group-item"> <span>Domo</span></a>
                <a href="#" class="list-group-item"> <span>IP</span></a>
                <a href="#" class="list-group-item"> <span>DVR</span></a>
                <!--Cart Modal start -->
                <button class="alert alert-success"> 
                    <cart-shop :type="type"> </cart-shop> 
                </button>
                <!--Cart Modal end -->
            </div>
        </div>
        <!-- Sidebar Category end -->

        <!-- Shop items start -->
        <div class="col-sm-12 col-md-9 col-lg-10 col-xl-10">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <item-shop> </item-shop>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <item-shop> </item-shop>
                </div> 
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <item-shop> </item-shop>
                </div>
            </div>
        </div>

        </div>

</div>
</template>
<script>
export default {
    data(){
        return{
            type: 'Carrito',
            data: {

            }
        }
    },
    created(){
        axios.get('/items')
            .then((response) => {
                this.data = response.data;
            })
            .catch((error) => console.log(error))
            
    },
    methods:{
        
    }
}

</script>
<style>
    
</style>



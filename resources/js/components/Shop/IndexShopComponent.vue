<template>
    <div class="container-fluid">
        <div class="row">

        <!-- Sidebar Category start -->
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2" >
            <div class="list-group col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <a href="/" class="list-group-item" style="background-color:#C3E1F1;">Inicio</a>
            </div> <br> <br> <br>
        <h3>Categorias</h3> 
            <div class="list-group col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <a href="#" class="list-group-item active"> <span>Todas</span></a>
                <a href="#" class="list-group-item"> <span>Domo</span></a>
                <a href="#" class="list-group-item"> <span>IP</span></a>
                <a href="#" class="list-group-item"> <span>DVR</span></a>
            </div>
        </div>
        <!-- Sidebar Category end -->

        <!-- Shop items start -->
        <div class="col-10">
            <div class="row">
                <div class="col-4">
                    <item-shop> </item-shop>
                </div>
                <div class="col-4">
                    <item-shop> </item-shop>
                </div> 
                <div class="col-4">
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
        products: {

        }
    },
    created(){
        
    }

}
</script>
<style>

</style>



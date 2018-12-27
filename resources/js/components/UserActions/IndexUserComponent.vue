<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menú</div>

                <div class="card-body" style="align-text:center;">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary active">
                        <router-link to='/user/new/item' type="radio" class="text-white" name="options" id="option1" autocomplete="off" checked> Productos </router-link>        
                    </label>
                    <label class="btn btn-secondary">
                        <router-link to='/user/new/client' type="radio" class="text-white" name="options" id="option2" autocomplete="off"> Manejo de cuentas </router-link>
                    </label>
                    <label class="btn btn-secondary">
                        <router-link to='/user/new/transactions' class='text-white' type="radio" name="options" id="option3" autocomplete="off"> Transacciones </router-link>
                    </label>
                    </div>
                </div>

            </div>
        </div>
        </div> <br>

            <shop-finish> </shop-finish>
            <router-view> </router-view>
    </div>
</template>

<script>
export default {
    created(){
        this.$router.push({ path: '/user' })
    }
}
</script>

<style>

</style>

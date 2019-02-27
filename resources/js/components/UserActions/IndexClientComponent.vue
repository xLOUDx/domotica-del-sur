<template>
    <div class="container-fluid">
        
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                
                <ul class="navbar-nav">
                    <li class="nav-item align-items-end">
                        <router-link to="/" class="nav-link">Tienda</router-link>
                    </li>
                    <li class="nav-item align-items-end">
                        <router-link to="/user/sales" class="nav-link">Historial de compras</router-link>
                    </li>
                    <li class="nav-item align-items-end">
                        <router-link to="/user/updatepass" class="nav-link">Cambio de clave</router-link>
                    </li>

                </ul>
            </div>
        </nav> <br>
            <router-view> </router-view>
    </div>
</template>

<script>
export default {
    created(){
        //this.$router.push({ path: '/user' })
    }
}
</script>

<style>

</style>

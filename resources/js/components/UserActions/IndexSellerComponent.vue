<template>
    <div class="container-fluid">
        
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Usuarios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <router-link to="/user/clients" class="dropdown-item">Ver usuarios</router-link>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ventas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <router-link to='/user/new/sale' class="dropdown-item">Ingresar venta</router-link>
                            <router-link to="/user/sales" class="dropdown-item">Historial de ventas</router-link>
                        </div>
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
        this.$router.push({ path: '/user' })
    }
}
</script>

<style>

</style>

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
                        Productos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <router-link to='/user/new/item' class="dropdown-item">Agregar nuevo producto</router-link>        
                        <router-link to='/user/all/item' class="dropdown-item">Ver productos</router-link>        
                        <a class="dropdown-item" href="#">Control de stock</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Clientes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <router-link to='/user/new/client' class="dropdown-item">Nuevo cliente</router-link>
                        <a class="dropdown-item" href="#">Ver clientes</a>
                        <a class="dropdown-item" href="#">Editar cliente</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ventas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <router-link to='/user/new/sale' class="dropdown-item">Ingresar venta</router-link>
                        <a class="dropdown-item" href="#">Ver ventas</a>
                        <router-link to='/user/new/transactions' class="dropdown-item"> Historial de transacciones </router-link>

                        </div>
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

<template>
    <div class="container">

    <table class="table table-hover">
    <thead>
        <tr>
            <th class="table-primary" scope="col">ID</th>
            <th class="table-primary" scope="col">Rol</th>
            <th class="table-primary" scope="col">Nombre</th>
            <th class="table-primary" scope="col">Rut</th>
            <th class="table-primary" scope="col">Email</th>
            <th class="table-primary" scope="col">Dirección</th>
            <th class="table-primary" scope="col">Empresa</th>
            <th class="table-primary" scope="col">Rut empresa</th>
            <th class="table-primary" scope="col">Descuento</th>
            <th class="table-primary" scope="col">Detalles</th>
        </tr>
    </thead>
    <tbody>
        <!--<tr v-for="pro in products">
            <th>{{ pro.id }}</th>
            <td>{{ pro.model }}</td>
            <td>{{ pro.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
            <td>{{ pro.stock }}</td>
            <td>{{ moment(pro.updated_at).format('l') }}</td>
            <td> <button @click="getDetail(pro.id, pro.model)" class="btn btn-primary">Ver</button> </td>
        </tr> -->
    </tbody>
    </table>

    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>

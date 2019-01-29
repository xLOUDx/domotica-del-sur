<template>
    <div class="container">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agregar nuevo cliente</div>

                <div class="card-body" style="align-text:center;">
                <!-- <form> -->
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Nombre</h5>
                    <input placeholder="Ejemplo: Juan" v-model="client.name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Apellidos</h5>
                    <textarea placeholder="Ejemplo: Perez Alboran" v-model="client.lastname" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut</h5>
                    <textarea placeholder="Ejemplo: 11.111.111" v-model="client.rut" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Email</h5>
                    <input placeholder="Ejemplo: juan@algunmail.com" v-model="client.email" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Dirección</h5>
                    <input placeholder="Ejemplo: Los nogales 33 Coronel" v-model="client.address" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Empresa</h5>
                    <input placeholder="Ejemplo: Fierros san juan" v-model="client.company" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut empresa</h5>
                    <input placeholder="Ejemplo: 11.111.111-1" v-model="client.rutcompany" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Descuento</h5>
                    <input placeholder="Ejemplo: 0.50" v-model="client.discount" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Clave</h5>
                    <input placeholder="Ejemplo: primeros cuatro dígitos del rut" v-model="client.password" type="password" class="form-control">
                </div>
                <hr>
            <button 
                v-html="this.status"
                @click="Create" 
                :disabled="this.disb"
                class="btn btn-success"/>

    </div>
</template>

<script>
export default {
    data(){
        return{
            client: {
                name: '',
                lastname: '',
                rut: '',
                email: '',
                address: '',
                company: '',
                rutcompany: '',
                discount: '',
                password: '',
            }
        }
    },
    methods:{
        Create(){
            axios.post('/createuser', { client: this.client })
                .then((response) => console.log(response.data))
                .catch((error) => console.log(error));
        }
    }
}
</script>

<style>

</style>

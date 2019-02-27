<template>
    <div class="container">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Actualizar clave</div>

                <div class="card-body" style="align-text:center;">
                <!-- <form> -->
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Ingrese nueva clave</h5>
                    <input placeholder="Ejemplo: primeros cuatro dígitos del rut" v-model="password" type="password" class="form-control">
                </div>
                <hr>
            <button @click="updatePass" class="btn btn-success"> Actualizar </button>
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
            password: ''
        }
    },
    methods: {
        updatePass(){

            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            axios.post('/updatepass', { pass: this.password })
                .then((response) => {
                    toast({
                        type: 'success',
                        title: 'Clave actualizada con éxito'
                    });
                 })
                .catch((error) => { 
                    toast({
                        type: 'error',
                        title: 'Error inesperado'
                    });
                 });
        }
    }
}
</script>

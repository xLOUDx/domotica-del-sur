<template>
<div class="container">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo cliente</div>
                <div class="card-body" style="align-text:center;">

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Nombre</h5>
                    <input type="text" class="form-control" v-model="client.name" placeholder="Ejemplo: Pedro Gonzales Reyes" rows="3" />
                </div>

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Email</h5>
                    <input type="email" class="form-control" v-model="client.email" placeholder="Ejemplo: preyes@mail.com" rows="3" />
                </div>

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Password</h5>
                    <input type="password" class="form-control" v-model="client.password" rows="3" />
                </div>

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut</h5>
                    <input type="text" class="form-control" v-model="client.rut" placeholder="Ejemplo: 11.111.111-1" rows="3" />
                </div>

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Dirección</h5>
                    <input type="text" class="form-control" v-model="client.address" placeholder="Ejemplo: P. SHERMAN, CALLE WALLABY 42, SYDNEY" rows="3" />
                </div>

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Empresa</h5>
                    <input type="text" class="form-control" v-model="client.company" placeholder="Ejemplo: Fierros San Juan" rows="3" />
                </div>

                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut Empresa</h5>
                    <input type="text" class="form-control" v-model="client.companyRut" placeholder="Ejemplo: 1.111.111-1" rows="3" />
                </div>
            
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Descuento en %</h5>
                    <input class="form-control" v-model="client.discount" placeholder="Ejemplo: 0.25" rows="3" />
                </div> <hr>
                    <button class="btn btn-success" @click="newClient">Guardar</button>
                </div>
            </div> 
        </div>
        </div> <br>

</div>
</template>

<script>
export default {
    data(){
        return{
            client: {
                name: '',
                rut: '',
                email: '',
                address: '',
                company: '',
                companyRut: '',
                discount: '',
                password: ''
            }
        }
    },
    methods: {
        newClient(){

        const toast = this.$swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        let validates = true;

        for (var it in this.client) {
            if (this.client[it] == ''){
                validates = false;
            }
        }

        if( validates == false ){
            toast({
                type: 'warning',
                title: 'Complete TODOS los campos'
            });
        } else {
            axios.post('/clients', this.client)
                .then((response) => {
                    this.client = [];
                    console.log( response.data );
                    
                        toast({
                            type: 'success',
                            title: 'Cliente agregado con exito!'
                        });
                })
                .catch((error) => {
                    console.log(error);
                    toast({
                        type: 'error',
                        title: 'Algo salió mal'
                    });
                })
        }
        }
    }
}
</script>

<style>

</style>

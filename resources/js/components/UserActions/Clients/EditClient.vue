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
                    <input placeholder="Ejemplo: Perez Alboran" v-model="client.lastname" class="form-control" rows="3" />
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut</h5>
                    <input placeholder="Ejemplo: 11.111.111" v-model="client.rut" class="form-control" rows="3" />
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Email</h5>
                    <input placeholder="Ejemplo: juan@algunmail.com" v-model="client.email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Dirección</h5>
                    <input placeholder="Ejemplo: Los nogales 33 Coronel" v-model="client.address" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Empresa</h5>
                    <input placeholder="Ejemplo: Fierros san juan" v-model="client.company" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut empresa</h5>
                    <input placeholder="Ejemplo: 11.111.111-1" v-model="client.company_rut" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Descuento</h5>
                    <input placeholder="Ejemplo: 0.50" v-model="client.discount" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Permisos</h5>
                    <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ client.privileges }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" @click="permission(1)">Cliente</button>
                        <button class="dropdown-item" @click="permission(2)">Ventas</button>
                        <button class="dropdown-item" @click="permission(3)">Gerente</button>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Clave</h5>
                    <input placeholder="Ejemplo: primeros cuatro dígitos del rut" v-model="client.password" type="password" class="form-control">
                </div>
                <hr>
            <button 
                v-html="this.status"
                @click="Update" 
                :disabled="this.disb"
                class="btn btn-success"/>
                </div> 
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['id'],
    data(){
        return{
            client: {
                //id: '',
                name: '',
                email: '',
                lastname: '',
                rut: '',
                address: '',
                company: '',
                company_rut: '',
                discount: '',
                privileges: '',
                password: ''
            },
            status: 'Guardar',
            disb: false
        }
    },
    created(){    
        axios.post(`/getclient`, { id: this.id })
            .then((response) => {     
                this.client.id = this.id;         
                this.client.name = response.data[0].name;
                this.client.email = response.data[0].email;
                this.client.lastname = response.data[0].lastname;
                this.client.rut = response.data[0].rut;
                this.client.address = response.data[0].address;
                this.client.company = response.data[0].company;
                this.client.company_rut = response.data[0].company_rut;
                this.client.discount = response.data[0].discount;
                this.client.privileges = response.data[0].privileges;
            })
            .catch((error) => console.log(error))
    },
    methods: {
        Update(){
            
            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            axios.post('/updateclient', { data: this.client, id: this.id })
                .then((response) => {
                    toast({
                        type: 'success',
                        title: 'Actualizado correctamente'
                    });
                }).catch((error) => {
                    toast({
                        type: 'error',
                        title: 'No se pudo completar la operación'
                    });
                }); 
        },
        permission(id){
            if(id == 1){
                this.client.privileges = 'Cliente';    
            } 
            if(id == 2){
                this.client.privileges = 'Ventas'
            }
            if(id == 3){
                this.client.privileges = 'Gerente';    
            }
        }
    }
}
</script>

<style>

</style>

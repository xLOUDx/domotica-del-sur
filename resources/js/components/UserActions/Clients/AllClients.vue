<template>
    <div class="container-fluid">

    <table class="table table-hover table-sm">
    <thead>
        <tr>
            <th class="table-primary" scope="col">ID</th>
            <th class="table-primary" scope="col">Rol</th>
            <th class="table-primary" scope="col">Nombre</th>
            <th class="table-primary" scope="col">Apellidos</th>
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
        <tr v-for="cli in clients">
            <th style="white-space: nowrap">{{ cli.id }}</th>
            <th style="white-space: nowrap">{{ cli.privileges }}</th>
            <td style="white-space: nowrap">{{ cli.name }}</td>
            <td style="white-space: nowrap">{{ cli.lastname }}</td>
            <td style="white-space: nowrap">{{ cli.rut }}</td>
            <td style="white-space: nowrap">{{ cli.email }}</td>
            <td>{{ cli.address }}</td>
            <td style="white-space: nowrap">{{ cli.company }}</td>
            <td style="white-space: nowrap">{{ cli.company_rut }}</td>
            <td style="white-space: nowrap">{{ cli.discount }}</td>
            <td style="white-space: nowrap">
                <button style="margin-left:20px;" class="btn btn-success" @click="detail(cli.id)"> 
                    <i class="fas fa-align-justify"></i>
                </button>

                <button style="margin-left:20px;" class="btn btn-warning" @click="update(cli.id)"> 
                    <i class="fas fa-edit"></i> 
                </button>

                <button style="margin-left:20px;" class="btn btn-danger" @click="destroy(cli.id)"> 
                    <i class="fas fa-trash"></i> 
                </button>
            </td>
        </tr> 
    </tbody>
    </table>

    </div>
</template>

<script>
export default {
    data(){
        return{
            clients: {}
        }
    },
    created(){
        this.getClients();
    },
    methods: {
        getClients(){
            axios.get('/getclients')
                .then((response) => this.clients = response.data)
                .catch((error) => console.log(error));
        },
        detail(id){
            this.$router.push({ name: 'ShowDataClient', params: { id: id }});
        },
        destroy(id){
            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            axios.delete(`/clients/${id}`)
                .then((response) => {
                    this.clients.splice(this.clients.indexOf(id), 1);
                    toast({
                        type: 'success',
                        title: 'Eliminado correctamente'
                    });
                this.getClients();

                })
                .catch((error) => {
                    console.log(error);
                    toast({
                        type: 'error',
                        title: 'Error al borrar el registro'
                    });
                });
        },
        update(id){
            this.$router.push({ name: 'EditClient', params: { id: id }});
        }
    }
}
</script>

<style>

</style>

<template>
    <div class="container">

    <table class="table table-hover">
    <thead>
        <tr>
            <th class="table-primary" scope="col">ID</th>
            <th class="table-primary" scope="col">Modelo</th>
            <th class="table-primary" scope="col">Precio</th>
            <th class="table-primary" scope="col">Stock</th>
            <th class="table-primary" scope="col">Tipo</th>
            <th class="table-primary" scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="it in products">
            <th scope="row">{{ it.id }}</th>
            <td>{{ it.model }}</td>
            <td>{{ it.price }}</td>
            <td>{{ it.stock }}</td>
            <td>{{ it.type }}</td>
            <td>
                <button style="margin-left:20px;" class="btn btn-danger" @click="destroy(it.id)"> 
                    <i class="fas fa-trash"></i> 
                </button>

                <button style="margin-left:20px;" class="btn btn-warning" @click="update(it.id)"> 
                    <i class="fas fa-edit"></i> 
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
            products: {

            }
        }
    },
    created(){
        axios.get('/items')
            .then((response) => this.products = response.data)
            .catch((error) => console.log(error));
    },
    methods: {
        destroy(id){
            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            axios.delete(`/items/${id}`)
                .then((response) => {
                    this.products.splice(this.products.indexOf(id), 1);
                    toast({
                        type: 'success',
                        title: 'Eliminado correctamente'
                    });
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
            this.$router.push({ name: 'EditItem', params: { id: id }});
        }
    }
}
</script>

<style>

</style>

<template>
    <div class="container-fluid">

    <!-- TABLA --> 
    <div>
        <vue-good-table
        :columns="columns"
        :rows="rows"
        :pagination-options="{
            enabled: true,
            perPage: 5,
            nextLabel: 'Siguente',
            prevLabel: 'Anterior',
            rowsPerPageLabel: 'Registros por página',
            ofLabel: 'De',
            allLabel: 'Todo',
            pageLabel: 'Página'
        }"
        @on-cell-click="onCellClick">

          <div slot="emptystate">
            No hay datos para mostrar
        </div>
        </vue-good-table>
    </div> 
    <!-- END -->

    </div>
</template>

<script>
export default {
    data(){
        return{
            clients: {},
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                    filterOptions: { enabled:true }
                }, 
                {
                    label: 'Rol',
                    field: 'privileges',
                    filterOptions: { enabled:true },
                }, 
                {
                    label: 'Nombre',
                    field: 'name',
                    filterOptions: { enabled:true }
                }, 
                {
                    label: 'Apellidos',
                    field: 'lastname',
                    filterOptions: { enabled:true }
                }, 
                {
                    label: 'Rut',
                    field: 'rut',
                    filterOptions: { enabled:true },
                    type: 'number'
                },
                {
                    label: 'Email',
                    field: 'email',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Dirección',
                    field: 'address',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Empresa',
                    field: 'company',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Rut empresa',
                    field: 'company_rut',
                    filterOptions: { enabled:true },
                    type: 'number'
                }, 
                {
                    label: 'Descuento',
                    field: 'discount',
                    filterOptions: { enabled:true },
                    type: 'percentage'
                }, 
                {
                    label: 'Detalles',
                    field: 'details',
                    html: true,
                },
                {
                    label: 'Editar',
                    field: 'edit',
                    html: true,
                },
                {
                    label: 'Eliminar',
                    field: 'erase',
                    html: true,
                },
            ],
            rows: []
        }
    },
    created(){
        this.getClients();
    },
    methods: {
        onCellClick(params){
            let exp = params.event.toElement.className;
            let id = params.row.id;
            
            if(exp == 'fas fa-trash' || exp == 'btn btn-danger'){
                this.destroy(id);
            } 
            else if ( exp == 'btn btn-success' || exp == 'fas fa-align-justify' ) {
                this.detail(id);
            }
            else if( exp == 'btn btn-warning' || exp == 'fas fa-edit' ){
                this.update(id);
            } 
            
        },
        getClients(){
            axios.get('/getclients')
                .then((response) => {
                    let data = [];                    
                    response.data.map( x => {
                        let details = {
                            details: '<button style="margin-left:20px;" class="btn btn-success">' + 
                                        '<i class="fas fa-align-justify"></i>' +
                                    '</button>'
                        }
                        let edit = {
                            edit: '<button style="margin-left:20px;" class="btn btn-warning">' + 
                                    '<i class="fas fa-edit"></i>' +
                                '</button>'
                        }
                        let erase = {
                            erase: '<button style="margin-left:20px;" class="btn btn-danger">' +
                                        '<i class="fas fa-trash"></i>' +
                                    '</button>'
                        }

                        var obj = Object.assign({}, x, details, edit, erase);
                        data.push( obj );
                    });
                    //this.clients = response.data
                    this.rows = data;
                })
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

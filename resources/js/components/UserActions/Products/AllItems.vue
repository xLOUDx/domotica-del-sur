<template>
    <div class="container">

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
            products: {

            },
            rows: [],
            columns: [
                {
                    label: 'ID',
                    field: 'id',
                    filterOptions: {
                        enabled: true,
                    },
                    placeholder: "Filtro por ID",
                    type: 'number'
                },
                {
                    label: 'Modelo',
                    field: 'model',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Precio',
                    field: 'price',
                    filterOptions: {
                        enabled: true,
                    },
                    type: 'number',
                },
                {
                    label: 'Stock',
                    field: 'stock',
                    filterOptions: {
                        enabled: true,
                    },
                    type: 'number',
                },
                {
                    label: 'Tipo',
                    field: 'type',
                    filterOptions: {
                        enabled: true,
                    },
                },
                {
                    label: 'Eliminar',
                    field: 'erase',
                    html: true,
                },
                {
                    label: 'Editar',
                    field: 'edit',
                    html: true,
                }, 
            ]
        }
    },
    created(){
        this.getItems();
    },
    methods: {
        onCellClick(params){
            let exp = params.event.toElement.className;
            let id = params.row.id;
            
            if(exp == 'fas fa-trash' || exp == 'btn btn-danger'){
                this.destroy(id);
            } 
            else if ( exp == 'fas fa-edit' || exp == 'btn btn-warning' ) {
                this.$router.push({ name: 'EditItem', params: { id: id }});
            } 
            
        },
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
                this.getItems();

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
        },
        getItems(){
            axios.get('/items')
                .then((response) => {
                    this.products = response.data;
                    let data = [];
                    response.data.map( x => {
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
                        x.price = x.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")                       
                        var obj = Object.assign({}, x, edit, erase);
                        data.push( obj );
                    });
                    this.rows = data;
                })
                .catch((error) => console.log(error));
        }
    }
}
</script>

<style>

</style>

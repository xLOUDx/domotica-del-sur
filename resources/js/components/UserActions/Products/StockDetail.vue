<template>
    <div class="container">


    <h1>Historial de inventario</h1> <br>
    <div class="form-row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Entrada de stock">
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Salida de stock">
        </div>
        <div class="col">
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div> <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th class="table-primary" scope="col">Fecha</th>
                <th class="table-primary" scope="col">Ingresos</th>
                <th class="table-primary" scope="col">Salidas</th>
                <th class="table-primary" scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
        </tbody>
    </table>

    </div>
</template>

<script>
export default {
    props: ['id'],
    data(){
        return{

        }
    },
    created(){
        
    }
}
</script>

<style>

</style>

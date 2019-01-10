<template>
    <div class="container-fluid">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Venta</div>

                <div class="card-body" style="align-text:center;">
                <!-- <form> -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Modo de pago</label>
                    <input placeholder="Ejemplo: ASP-8118" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Descripción</label>
<select class="js-example-basic-single" name="state">
  <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option>
</select>                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ficha técnica</label>
                    <textarea placeholder="Detalles separados por guión (-)" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Precio</label>
                    <input placeholder="Ejemplo: 63000" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input placeholder="Ejemplo: 20" type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Código interno</label>
                    <input placeholder="Ejemplo: ASP-8118" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tipo</label>
                    <input placeholder="Ejemplo: IP - HD - DOMO" type="text" class="form-control">
                </div>

                <hr>
            <button 
                 
                class="btn btn-success"/>
            
            <!-- </form> -->
                </div>

            </div>
        </div>
        </div>

    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>

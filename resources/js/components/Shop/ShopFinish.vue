<template>
    <dir v-if="respuesta.approved == 0" class="container-fluid">    
    
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div  class="card">
                <div class="card-header">
                    <div style="height:10px;width:770px;" class="d-flex flex-row-reverse"> 
                        <img width="260px" height="45" src="img/domotica_logo.png"> 
                    </div> 
                    <h4>Detalle de compra</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm h6">  <strong> ID:</strong> {{ respuesta.id }} </div>
                        <div class="col-sm h6">  <strong> Codigo de autorización:</strong> {{ respuesta.authorizationcode }} </div>
                        <div class="col-sm h6">  <strong> Orden de compra:</strong> {{ respuesta.buyorder }}   </div>
                    </div> <br>
                    <div class="row">
                        <div class="col-sm h6"> <strong> Fecha:</strong> {{ respuesta.created_at }} </div>
                        <div class="col-sm h6"> <strong> Metodo de pago:</strong> {{ respuesta.payment }} </div>
                        <div class="col-sm"> <strong> N° cuotas: </strong> {{ respuesta.sharesNumber }}</div>
                    </div> <br>
                    <div class="row">
                        <div class="col-sm h6"> <strong> N° tarjeta:</strong> ******{{ respuesta.cardnumber }} </div>
                        <div class="col-sm"></div>
                        <div class="col-sm"></div>
                    </div> <br>

                    <table class="table" >
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="prod in items">
                                <th scope="row">1</th>
                                <td>{{ prod.model }}</td>
                                <td>{{ prod.price }}</td>
                                <td>{{ prod.count }}</td>
                                <td>{{ prod.count * prod.price }}</td>
                            </tr>
                        </tbody>
                        </table> <br>
                        
                        <div class="d-flex flex-row-reverse">
                            <h4>Monto final:  <strong>${{ respuesta.ammount }}</strong> </h4>
                        </div>

                </div>
                        <div class="card-footer text-muted d-flex flex-row-reverse">
                            <button class="btn btn-primary" @click="index">Volver a inicio</button>
                        </div>

            </div>
        </div>
        </div> <br>

        <div v-if="respuesta.approved != 0" class="card border border-danger">
        <div class="card-header" style="border-bottom-color: red;">
            <h2>Orden de compra {{ respuesta.buyorder }} rechazada</h2>
        </div>

        <div class="card-body">
            <p>Las posibles causas de rechazo son:</p> 
            <ul>respuesta
                <li>Error en el ingreso de los datos de su tarjeta de Crédito o Débito (fecha y/o código de seguridad).</li>
                <li>Su tarjeta de Crédito o Débito no cuenta con saldo suficiente.</li>
                <li>Tarjeta aún no habilitada en el sistema financiero.</li>
            </ul>
            <a href="/" class="btn btn-primary">Volver a inicio</a>
        </div>
        </div>

    </dir>
</template>

<script>
export default {
    props: ['resp'],
    data(){
        return {
            respuesta: {

            },
            items: {

            },
        }
    },
    created(){
        console.log(JSON.parse(this.$props.resp))

        let algo = JSON.parse(this.$props.resp);
        this.respuesta = algo[0];
        this.items = algo['products'];

    console.log(this.respuesta);
        if(this.items.length < 0 ){
            this.$swal(
                'Falló!',
                'Ocurrió un error en la compra',
                'error'
            );         

        } else{
            this.$swal(
                'Listo!',
                'Compra realizada correctamente',
                'success'
            );
        }

    },
    methods:{
        index(){
            window.location.href = '/'
        }
    }
}
</script>

<style>

</style>

<template>
    <div class="container-fluid">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva venta</div>

                <div class="card-body" style="align-text:center;">
                <!-- <form> -->
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Nombre del cliente</h5>
                    <input placeholder="Ejemplo: Juan perez" v-model="general.client" type="text" class="form-control">
                </div>           
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut cliente</h5>
                    <input placeholder="Ejemplo: 11.111.111-1" v-model="general.rutclient" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Empresa</h5>
                    <input placeholder="Ejemplo: Fierros San Juan" v-model="general.company" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Rut empresa</h5>
                    <input placeholder="Ejemplo: 11.111.111-1" v-model="general.rutcompany" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Modo de pago</h5>
                    <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ general.payment }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" @click="getPayMode(1)">Efectivo</button>
                        <button class="dropdown-item" @click="getPayMode(2)">Tarjeta</button>
                        <button class="dropdown-item" @click="getPayMode(3)">Transferencia</button>
                        <button class="dropdown-item" @click="getPayMode(4)">Cheque</button>
                        <button class="dropdown-item" @click="getPayMode(5)">Otro</button>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                    <h5 class="typo__label">Productos</h5>
                    <multiselect v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Seleccione..." label="name" track-by="name" :preselect-first="false">
                        <template slot="selection" @onclick="getProduct" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} Productos</span></template>
                    </multiselect>
                    </div>       
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Detalle de productos</h5>
                    <table class="table">
                    <thead>
                        <tr class="active">                            
                            <th scope="col">Modelo</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="active" v-for="it in value">
                            <td>{{ it.name }}</td>
                            <td>{{ it.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
                            <td> <input @change="getTotal" class="form-control" v-model="it.number" type="number"> </td>
                            <td>{{ it.total = (it.price * it.number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <td></td>
                        <th style="float:right">Total:</th>
                        <td> <input class="form-control" v-model="discount" type="number" placeholder="Ingrese descuento, ej: 0.25"> </td>
                        <td>$ {{ (general.total - (general.total * this.discount)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") }} </td>
                    </tfoot>
                    </table>
                </div>
                <hr>
            <button class="btn btn-success" @click="saveSale">Guardar</button>
            
            <!-- </form> -->
                </div>

            </div>
        </div>
        </div>

    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
  components: {
    Multiselect
  },
  data () {
    return {
        value: [],
        options: [],
        general: {
            payment: 'Efectivo',
            total: 0,
            client: '',
            rutclient: '',
            company: '',
            rutcompany: ''
        },
        discount: ''
    }
  },
  watch: {
      value(hola){
          this.getTotal();
      }

  },
  created(){
    axios.get('/items')
        .then((response) => {
            Object.values(response.data).forEach((key) => {
                this.options.push({ name: `${key['model']}`, price: `${key['price']}`, number: 1 , total: 0 })
            });
        })
        .catch((error) => console.log(error));
  },
  methods: {
      getTotal(){
        this.general.total = Object.values(this.value).reduce(function(sum, item){ 
        return sum + parseInt(item.price) * parseInt(item.number); 
        }, 0)
      },
      getDiscount(){
          let total = this.general.total;
          this.general.total = this.general.total - (this.general.total * this.discount);          
      },
      saveSale(){
        const toast = this.$swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        /*let validates = true;

        for (var it in this.general) {
            if (this.general[it] == ''){
                validates = false;
            }
        }

        for (var it in this.value) {
            if (this.value[it] == ''){
                validates = false;
            }
        }

          if(validates == false ){
                toast({
                    type: 'warning',
                    title: 'Complete TODOS los campos'
                });
          } else { */
              this.general['discount'] = this.discount;

            axios.post('/savesale', { items: this.value, detail: this.general })
                .then((response) => {

                    if( response.data == false ){
                        toast({
                            type: 'error',
                            title: 'No hay stock, por favor revise el inventario.'
                        });
                        
                    } else{
                        this.value = [];
                        this.discount = '';
                        this.general = {
                            payment: 'Efectivo',
                            total: 0,
                            nameClient: '',
                            rutClient: ''
                        };
                        
                        toast({
                            type: 'success',
                            title: 'Compra agregada con éxito'
                        });
                    }   
                    //console.log(response.data);
                    
                })
                .catch((error) => {
                    toast({
                        type: 'error',
                        title: 'Algo salió mal. Revise los datos ingresados'
                    });
                });
          //}
      },
      getPayMode(tipo){
        if(tipo == '1'){
            this.general.payment = 'Efectivo';
        }
        if(tipo == '2'){
            this.general.payment = 'Tarjeta';  
        }
        if(tipo == '3'){
           this.general.payment = 'Transferencia';   
        }
        if(tipo == '4'){
           this.general.payment = 'Cheque';   
        } 
        if(tipo == '5'){
           this.general.payment = 'Otro';   
        }
      }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>

</style>

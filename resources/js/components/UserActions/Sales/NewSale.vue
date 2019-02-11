<template>
    <div class="container-fluid">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva venta</div>

                <div class="card-body" style="align-text:center;">
                <!-- <form> -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <h5 for="exampleInputEmail1">Nombre del cliente</h5>
                        <input placeholder="Ejemplo: Juan" v-model="general.client" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                    <div>
                        <h5 class="typo__label">Clientes</h5>
                        <multiselect v-model="value2" @input="this.putClient" :options="options2" placeholder="Seleccione..." label="name" track-by="name"></multiselect>
                    </div>
                    </div>
                </div>     
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Apellido cliente</h5>
                    <input placeholder="Ejemplo: Idalgo maldonado" v-model="general.client_lastname" type="text" class="form-control">
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
        options2: [],
        value2: [],
        general: {
            payment: 'Efectivo',
            total: 0,
            client: '',
            client_lastname: '',
            rutclient: '',
            company: '',
            rutcompany: ''
        },
        discount: '',
        aproved: true
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

    axios.get('/getclients')
        .then((response) => {
            Object.values(response.data).forEach((key) => {
                this.options2.push({ 
                    name: `${key['name']} ${key['lastname']}`,
                    client: `${key['name']}`, 
                    client_lastname: `${key['lastname']}`, 
                    rutClient: `${key['rut']}`, 
                    rutcompany: `${key['company_rut']}`, 
                    company: `${key['company']}` 
            });
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
      putClient(){
            this.general.client = this.value2.client;
            this.general.client_lastname = this.value2.client_lastname;
            this.general.rutclient = this.value2.rutClient;
            this.general.company = this.value2.company;
            this.general.rutcompany = this.value2.rutcompany;    
      },
      saveSale(){
        this.aproved = true;
        const toast = this.$swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        for (var it in this.general) {
            if (this.general[it] == ''){
                this.aproved = false;
            }
        }


    //console.log(this.aproved);

        if(this.aproved == true){
            this.discount = this.discount == '' ? 0 : this.discount;
            this.general['discount'] = this.discount;

            axios.post('/savesale', { items: this.value, detail: this.general })
                .then((response) => {

                    if( response.data == false ){
                        this.aproved = true;
                        toast({
                            type: 'error',
                            title: 'No hay stock, por favor revise el inventario.'
                        });
                        
                    } else{
                        delete this.general.discount;
                        this.value = [],
                        //this.options = [],
                        //this.options2 = [],
                        this.value2 = [],
                        this.general = {
                            payment: 'Efectivo',
                            total: 0,
                            client: '',
                            client_lastname: '',
                            rutclient: '',
                            company: '',
                            rutcompany: ''
                        },
                        this.discount = '',
                        this.aproved = true
                        
                        toast({
                            type: 'success',
                            title: 'Compra agregada con éxito'
                        });
                        //this.created();
                    }   
                })
                .catch((error) => {
                    this.aproved = true;
                    console.log(error);
                    toast({
                        type: 'error',
                        title: 'Algo salió mal. Revise los datos ingresados'
                    });
                });
        } else {
            this.aproved = true;
            toast({
                type: 'warning',
                title: 'Complete TODOS los campos'
            });
        }
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

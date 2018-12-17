<template>
    <div class="container">

        <button class="btn btn-outline-success" style="width:100%;height:100%" data-toggle="modal" data-target="#modalCart"> 
            <i class="fas fa-shopping-cart"></i>
       			<span v-if="this.cart" class="notify-badge"> <strong> {{ this.cart }} </strong> </span>
            <span>{{ this.shop }}</span>
        </button>

<!-- Modal: modalCart -->
<div class="modal fade text-dark" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" style="padding-left:5px" id="myModalLabel">Tu compra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Total</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in productAdd">
              <th scope="row">{{ product.model }}</th>
              <td>${{ product.price }}</td>
              <td>{{ product.count }}</td>
              <td>${{ getTotal(product.count, product.price) }}</td>
              <td>
                <button @click="quit(product.model, product.count)" class="btn btn-outline-danger btn-sm"> 
                  <i class="fas fa-times"></i> 
                </button>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td class="font-weight-bold">Monto final: </td>
              <td class="font-weight-bold h5"> {{ this.totalPrice }} </td>
              <td></td>

            </tr>
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button style="" class="btn btn-outline-secondary" data-dismiss="modal"> 
          Cerrar
        </button>
        <button @click="getPay" class="btn btn-success"> 
          Pagar
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->
    </div>
</template>

<script>
import EventBus from '../../event-bus';

export default {
  props:['type'],
  data(){
    return{
      totalPrice: 0,
      cart: 0,
      shop: this.type,
      productAdd: []
    }
  },
  created(){
    EventBus.$on('addProduct', data => {
      let exist = this.productAdd.some(function( obj ){ 
        return obj.model === data.model
      });
    
      if(exist == true){
        let foundIndex = this.productAdd.findIndex(x => x.model == data.model);
        let cantidad = {
          count: this.productAdd[foundIndex].count + 1,
          model: this.productAdd[foundIndex].model,
          price: this.productAdd[foundIndex].price
        }

        this.productAdd[foundIndex] = cantidad;
        this.productAdd.push();

      } else{
        let newProduct = {
          count: data.count,
          model: data.model,
          price: data.price,
        }

        this.productAdd.push(newProduct);
      }
      //this.totalPrice = this.totalPrice + 1
      this.cart = this.cart + 1;

    });
  },
  updated(){
    let total = 0
    for(var i = 0; i < this.productAdd.length; i++){
      total = total + (this.productAdd[i].count * this.productAdd[i].price) 
    }
    this.totalPrice = total;

  },
  methods:{
    quit(model, count){
      this.productAdd = this.productAdd.filter(function( obj ) { 
        return obj.model !== model 
      });

      this.cart = this.cart - count;
    },
    getTotal(cant, price){
      let total = cant * price;
      return total;
    },
    getPay(){
      axios.post('/redirect', { total:this.totalPrice })
        .then((response) => {
          window.location.href = response.data;
        })
        .catch((error) => { console.log(error); })
       // window.location.href = '/redirect';
    }
  }
}
</script>

<style scoped>
.item {
    position:relative;
    padding-top:20px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    right:7px;
    top:5px;
    background:#3A833C;
    text-align: bottom;
    border-radius: 25PX 25PX 25PX 25PX;
    color:white;
    padding:2px 8px;
    font-size:12px;
    align-items: center;
    align-content: center;
    align-self: center;
}
</style>

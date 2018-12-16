<template>
    <div class="container">

        <button class="btn btn-outline-success" style="width:100%;height:100%" data-toggle="modal" data-target="#modalCart"> 
            <i class="fas fa-shopping-cart"></i>
       			<span class="notify-badge"> <strong> {{ this.cart }} </strong> </span>
            <span>{{ this.shop }}</span>
        </button>

<!-- Modal: modalCart -->
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Total</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in productAdd">
              <th scope="row">{{ product.model }}</th>
              <td>{{ product.count }}</td>
              <td>{{ product.price }}</td>
              <td> Total </td>
              <td>
                <button @click="delete" class="btn btn-outline-danger btn-sm"> 
                  <i class="fas fa-times"></i> 
                </button>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button style="" class="btn btn-outline-secondary" data-dismiss="modal"> 
          Cerrar
        </button>
        <button style="" class="btn btn-success"> 
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
      cart: 20,
      shop: this.type,
      productAdd: []
    }
  },
  created(){
    EventBus.$on('addProduct', data => {
      let exist = this.productAdd.some(function(el){ return el.model === data.model});
    
      if(exist == true){
        console.log('Existe');
        this.productAdd.some(function(el){ return el.model === data.model, el.count = el.count + 1 });
      } else{
        this.productAdd.push(data);
        console.log('No existe');
      }

      console.log(this.productAdd);

    });
  },
  methods:{
    delete(model){

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

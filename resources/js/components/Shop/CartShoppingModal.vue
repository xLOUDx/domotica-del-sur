<template>
    <div class="container">
        
        <a data-toggle="modal" data-target="#modalCart"> 
            <i class="fas fa-shopping-cart"></i>
       			<span class="notify-badge"> {{ this.cart }} </span>
            <span>{{ this.shop }}</span>
        </a>

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
            <tr>
              <th scope="row">ASP-8088</th>
              <td>1</td>
              <td>80.000</td>
              <td>80.000</td>
              <td><a><i class="fa fa-remove"></i></a></td>
            </tr>
            <tr>
              <th scope="row">ASP-8088</th>
              <td>1</td>
              <td>80.000</td>
              <td>80.000</td>
              <td><a><i class="fa fa-remove"></i></a></td>
            </tr>
            <tr>
              <th scope="row">ASP-8088</th>
              <td>1</td>
              <td>80.000</td>
              <td>80.000</td>
              <td><a><i class="fa fa-remove"></i></a></td>
            </tr>
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button style="" class="btn btn-outline-secondary btn-lg" data-dismiss="modal"> 
            <p class="h4 font-weight-bold">
            Cerrar
            </p>
            </button>
        <button style="" class="btn btn-success btn-lg"> 
            <p class="h4 font-weight-bold">
            Pagar
            </p>
            </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalCart -->
    </div>
</template>

<script>
export default {
  props:['type'],
  data(){
    return{
      cart: 20,
      shop: this.type,
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
    right:1px;
    top:5px;
    background:#3A833C;
    text-align: top;
    border-radius: 25PX 25PX 25PX 25PX;
    color:white;
    padding:2px 8px;
    font-size:12px;
}
</style>

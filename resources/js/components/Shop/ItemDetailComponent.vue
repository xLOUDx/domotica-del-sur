<template>
<div class="container-fluid" style="padding:2%">
    <button @click="shooping" class="btn btn-primary"> 
        <strong> Volver a inicio </strong> 
    </button> <br> <br>

    <div class="card" v-if="data.length > 0">
        <div class="row">
        <aside class="col-sm-6 border-right">
        <article class="gallery-wrap"> 
            <div class="img-big-wrap">
                 <img class="img-responsive" :src="this.currentImg"> 
            </div> <!-- slider-product.// -->
            <div v-if="this.img" style="background-color:red" class="img-small-wrap">
                <div @click="ChangePic(1)" class="item-gallery"> 
                    <img :src="this.img.img1"> 
                </div>
                <div @click="ChangePic(2)" class="item-gallery"> 
                    <img :src="this.img.img2"> 
                </div>
                <div @click="ChangePic(3)" class="item-gallery"> 
                    <img :src="this.img.img3"> 
                </div>
                <div @click="ChangePic(4)" class="item-gallery"> 
                    <img :src="this.img.img4"> 
                </div>
            </div> <!-- slider-nav.// -->
        </article> <!-- gallery-wrap .end// -->
        </aside>
        <aside class="col-sm-6">
        <article class="card-body p-5">
        <h3 class="title mb-3">{{ data[0].model }}</h3>

        <p class="price-detail-wrap"> 
            <span class="price h3 text-primary font-weight-bold"> 
                <span class="currency">$ </span><span class="num">{{ data[0].price }}</span>
            </span> 
        </p> <!-- price-detail-wrap .// -->
        <dl class="item-property">
        <dt>Descripción</dt>
        <dd><p>{{ data[0].description }}</p></dd>
        </dl>
        <hr>
        <dl class="item-property">
            <dt>Fincha técnica</dt>
            <div  class="text-body" v-html="this.descripcion" ></div>
        </dl>
        <hr>
        <dl class="param param-feature">
        <dt>Tipo</dt>
        <dd>{{ data[0].type }}</dd>
        </dl>  <!-- item-property-hor .// -->

        <hr><hr>
            <a @click="addCart" class="btn btn-outline-primary text-primary text-uppercase"> <i class="fas fa-shopping-cart"></i>Agregar al carrito</a>
        </article> <!-- card-body.// -->
        </aside> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->

</div>
</template>

<script>
import EventBus from '../../event-bus';
import VLazyImage from "v-lazy-image";


export default {
    data(){
        return{
            type: 'Comprar',
            data: [
            ],
            img: {
                img1:null,
                img2:null,
                img3:null,
                img4:null
            },
            currentImg: null,
            descripcion: ''
        }
    },
    created(){
        EventBus.$on('details', data => {
            this.data = [];
            this.data.push(data);

            let array = this.data[0].data_sheet
            let array2 = array.split('-');
            let array3 = array2.join("<br> -");
            this.descripcion = array3;
            this.getImage();
        });        

    },
    methods:{
        ChangePic(pic){
            if(pic == 1){
                this.currentImg = this.img.img1;
            }
            if(pic == 2){
                this.currentImg = this.img.img2;
            }
            if(pic == 3){
                this.currentImg = this.img.img3;
            }
            if(pic == 4){
                this.currentImg = this.img.img4;               
            }
        },
        shooping(){
            EventBus.$emit('backStore');
        },
        getImage(){
            this.img.img1 = './items_img/' + this.data[0].img1;
            this.img.img2 = './items_img/' + this.data[0].img2;
            this.img.img3 = './items_img/' + this.data[0].img3;
            this.img.img4 = './items_img/' + this.data[0].img4;
            this.currentImg = this.img.img1;
        },
        addCart(){
            let product = {
                count: 1,
                model: this.data[0].model,
                price: this.data[0].price
            }
            EventBus.$emit('addProduct', product);
        }
    }
}
</script>

<style scoped>
.gallery-wrap .img-big-wrap img {
    height: 450px;
    width: 100%;
    display: inline-block;
    /*cursor: zoom-in;*/ 
}


.gallery-wrap .img-small-wrap .item-gallery {
    width: 60px;
    height: 60px;
    border: 1px solid #ddd;
    margin: 7px 2px;
    display: inline-block;
    overflow: hidden;
}

.gallery-wrap .img-small-wrap {
    text-align: center;
}
.gallery-wrap .img-small-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 4px;
    /*cursor: zoom-in;*/
}
</style>

<template>
<div class="container-fluid" style="padding:2%">
    <a href="/tienda" class="btn btn-primary"> 
        <strong> Volver a inicio </strong> 
    </a> <br> <br>

    <div class="card">
        <div class="row">
        <aside class="col-sm-6 border-right">
        <article class="gallery-wrap"> 
            <div class="img-big-wrap">
                <picture> <img class="img-responsive" :src="this.currentImg"> </picture>
            </div> <!-- slider-product.// -->
            <div class="img-small-wrap">
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
        <h3 class="title mb-3">{{ data.model }}</h3>

        <p class="price-detail-wrap"> 
            <span class="price h3 text-warning"> 
                <span class="currency">$</span><span class="num">{{ data.price }}</span>
            </span> 
        </p> <!-- price-detail-wrap .// -->
        <dl class="item-property">
        <dt>Descripción</dt>
        <dd><p>Here goes description consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco </p></dd>
        </dl>
        <hr>
        <dl class="item-property">
            <dt>Fincha técnica</dt>
            <dd><p>Here goes description consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco </p></dd>
        </dl>
        <hr>
        <dl class="param param-feature">
        <dt>Tipo</dt>
        <dd>IP - Domo - Dvr</dd>
        </dl>  <!-- item-property-hor .// -->

        <hr>
            <div class="row">
                <div class="col-sm-5 col-md-8 col-lg-12">
                    <dt>Cantidad</dt>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Seleccione
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">1</a>
                            <a class="dropdown-item" href="#">2</a>
                            <a class="dropdown-item" href="#">3</a>
                            <a class="dropdown-item" href="#">4</a>
                            <a class="dropdown-item" href="#">5</a>
                        </div>
                        </div>
                </div> <!-- col.// -->
            </div> <!-- row.// -->
            <hr>
            <a class="btn btn-primary text-uppercase text-white"> 
                <cart-shop :type="type"> </cart-shop> 
            </a>
            <a href="#" class="btn btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i>Agregar al carrito</a>
        </article> <!-- card-body.// -->
        </aside> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->


</div>
</template>

<script>
export default {
    props: ['id'],
    data(){
        return{
            type: 'Comprar',
            data: {

            },
            img: {
                img1:'img/about/2.jpg',
                img2:'img/about/1.jpg',
                img3:'img/about/2.jpg',
                img4:'img/about/1.jpg'
            },
            currentImg: ''
        }
    },
    mounted(){
        this.currentImg = this.img.img1;
        const url = 'items/' + this.$props.id;
        axios.get(url)
            .then((response) => {
                console.log(response.data);
                this.data = response.data[0];
            })
            .catch((error) => {
                console.log(error);
            })
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
        }
    }
}
</script>

<style scoped>
.gallery-wrap .img-big-wrap img {
    height: 450px;
    width: auto;
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

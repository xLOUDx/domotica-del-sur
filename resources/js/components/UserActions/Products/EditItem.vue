<template>
    <div class="container-fluid">

        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agregar nuevo producto</div>

                <div class="card-body" style="align-text:center;">
                <!-- <form> -->
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Modelo</h5>
                    <input placeholder="Ejemplo: ASP-8118" v-model="item.model" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Descripción</h5>
                    <textarea placeholder="Descripción breve" v-model="item.description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Ficha técnica</h5>
                    <textarea placeholder="Detalles separados por guión (-)" v-model="item.data_sheet" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Precio</h5>
                    <input placeholder="Ejemplo: 63000" v-model="item.price" type="number" class="form-control">
                </div>
                <!--<div class="form-group">
                    <h5 for="exampleInputEmail1">Stock</h5>
                    <input placeholder="Ejemplo: 20" v-model="item.stock" type="number" class="form-control">
                </div> -->
                <div class="form-group">
                    <h5 for="exampleInputEmail1">Tipo</h5>
                    <input placeholder="Ejemplo: IP - HD - DOMO" v-model="item.type" type="text" class="form-control">
                </div>

                <!-- <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 1</label>
                    <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 1)">
                </div> -->

                <!-- <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 2</label>
                    <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 2)">
                </div> -->

                <!-- <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 3</label>
                    <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 3)">
                </div> -->

                <!-- <div class="form-group">
                    <label for="exampleFormControlFile1">Imagen 4</label>
                    <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 4)">
                </div> -->
                <hr>
            <button 
                v-html="this.status"
                @click="updateProduct"
                :disabled="this.disb"
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
    props:['id'],
    data(){
        return{
            item: {
                id: this.id,
                model: '',
                description: '',
                data_sheet: '',
                price: '',
                stock: '',
                //internal_code: '',
                type: '',
                img1: '',
                img2: '',
                img3: '',
                img4: ''
            },
            status: 'Guardar',
            disb: false
        }
    },
    created(){        
        axios.get(`/items/${this.id}`)
            .then((response) => {                
                this.item.model = response.data[0].model;
                this.item.description = response.data[0].description;
                this.item.data_sheet = response.data[0].data_sheet;
                this.item.price = response.data[0].price;
                this.item.stock = response.data[0].stock;
                this.item.internal_code = response.data[0].internal_code,
                this.item.type = response.data[0].type,
                this.item.img1 = response.data[0].img1,
                this.item.img2 = response.data[0].img2,
                this.item.img3 = response.data[0].img3,
                this.item.img4 = response.data[0].img4
              
            })
            .catch((error) => console.log(error))
    },
    methods: {
        updateProduct(){   
            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });        
            axios.put(`/items/${this.id}`, this.item)
                .then((response) => {
                    toast({
                        type: 'success',
                        title: 'Producto actualizado con éxito!'
                    });
                })
                .catch((error) => {
                    toast({
                        type: 'error',
                        title: 'Error inesperado'
                    });
                    console.log(error);
                });
        }
    }
    /*methods: {
        Create(){
            const toast = this.$swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            this.status = "<i class='fa fa-spinner fa-spin '></i> Procesando..."
            this.disb = true;

            let validates = true;

            for (var it in this.item) {
                if (this.item[it] == ''){
                    validates = false;
                }
            }

            if( validates == false ){

                this.status = "Guardar"
                this.disb = false;

                toast({
                    type: 'warning',
                    title: 'Complete TODOS los campos'
                });
            } else {

                axios.post('items', this.item)
                    .then((response) => {
                        //console.log(response.data);
                        this.status = "Guardar"
                        this.disb = false;

                        toast({
                            type: 'success',
                            title: 'Producto creado correctamente'
                        });

                        this.item = [];
                        window.location.reload();
                    })
                    .catch((error) => { 
                        toast({
                            type: 'error',
                            title: 'Algo salió mal'
                        });

                        this.status = "Guardar"
                        this.disb = false;
                    });
            }
        },
        imageChanged(event, img){
            
            if(img == 1){
            var fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0])
                fileReader.onload = (event) => {
                this.item.img1 = event.target.result
            }
            }
            if(img == 2){
            var fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0])
                fileReader.onload = (event) => {
                this.item.img2 = event.target.result
            }
            }            
            if(img == 3){
            var fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0])
                fileReader.onload = (event) => {
                this.item.img3 = event.target.result
            }
            }
            if(img == 4){
            var fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0])
                fileReader.onload = (event) => {
                this.item.img4 = event.target.result
            }
            }                       
             
        }
        
    } */
}
</script>

<style>

</style>

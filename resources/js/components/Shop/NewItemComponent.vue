<template>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Modelo</label>
                <input v-model="item.model" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Descripción</label>
                <textarea v-model="item.description" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ficha técnica</label>
                <textarea v-model="item.data_sheet" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Precio</label>
                <input v-model="item.price" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Stock</label>
                <input v-model="item.stock" type="number" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Código interno</label>
                <input v-model="item.internal_code" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tipo</label>
                <input v-model="item.type" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Imagen 1</label>
                <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 1)">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Imagen 2</label>
                <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 2)">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Imagen 3</label>
                <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 3)">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Imagen 4</label>
                <input type="file" class="form-control-file" @change="(event) => imageChanged(event, 4)">
            </div>
        <button @click="Create" class="btn btn-success">Guardar</button>
        </form>

    </div>
</template>

<script>
export default {
    data(){
        return{
            item: {
                model: '',
                description: '',
                data_sheet: '',
                price: '',
                stock: '',
                internal_code: '',
                type: '',
                img1: '',
                img2: '',
                img3: '',
                img4: ''
            }
        }
    },
    created(){
        axios.get('/items')
            .then((response) => {
                this.image.img1 = 'http://localhost:8000/items_img/'+response.data[0].img1;
                this.image.img2 = 'http://localhost:8000/items_img/'+response.data[0].img2;
                this.image.img3 = 'http://localhost:8000/items_img/'+response.data[0].img3;
                this.image.img4 = 'http://localhost:8000/items_img/'+response.data[0].img4;

            })
            .catch((error) => console.log(error))
    },
    methods: {
        Create(){
            axios.post('items', this.item)
                .then((response) => {
                    //console.log('Correcto');
                    console.log(response.data);
                })
                .catch((error) => console.log(error))
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
        
    }
}
</script>

<style>

</style>

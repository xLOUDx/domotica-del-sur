<template>
    <div class="container">
 <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel Vue JS Image Upload - ItSolutionStuff.com</div>
 
                    <div class="card-body">
                        <form @submit="formSubmit" enctype="multipart/form-data">
                        <strong>Image:</strong>
                        <input type="file" class="form-control" v-on:change="onImageChange">
 
                        <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            item: {
                model: 'ASP-9999',
                description: 'Lorem ipsun',
                stock: 30,
                internal_code: 879,
                type: 'IP-HD',
                img1: '',
                img2: '',
                img3: '',
                img4: '',
            }
        }
    },
    methods: {
        Create(){
            axios.post('items', this.item )
                .then((response) => {
                    //console.log('Correcto');
                    console.log(response.data);
                })
                .catch((error) => console.log(error))
        },
            onImageChange(e){
                console.log(e.target.files[0]);
                this.item.img1 = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                formData.append('item', this.item);
 
                axios.post('/items', formData, config)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
    }
}
</script>

<style>

</style>

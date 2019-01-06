<template>
<div class="container">



</div>
</template>

<script>
export default {
    data(){
        return{
            data: {
                item: ''
            }
        }
    },
    methods: {
        poto(){
            axios.post('/poto')
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        pota(){
            axios.post ('/algo', this.data)
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        imageChanged(){
            var fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0])
                fileReader.onload = (event) => {
                this.item = event.target.result
            }
            
        }
    }
}
</script>

<style>

</style>

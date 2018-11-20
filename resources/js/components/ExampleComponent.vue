<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <button @click="Pay" class="btn btn-primary">Pagar lukita</button>
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
                html: ''
            }
        },
        methods:{
            Pay(){
                axios.get('/pay')
            }
        }
    }
</script>

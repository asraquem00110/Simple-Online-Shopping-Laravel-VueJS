<template>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">Laravel Vue JS File Upload Example - ItSolutionStuff.com</div>
                        <img :src="imgPreview" style="width: 400px;height: 400px" @click="$refs.imgFile.click()">;
        

                    <div class="card-body">

                       
                        <!-- <form @submit="formSubmit" enctype="multipart/form-data">

                        <strong>Name:</strong>

                        <input type="text" class="form-control" v-model="name">

                        <strong>File:</strong>

                        <input type="file" class="form-control" v-on:change="onFileChange" ref="imgFile">

    

                        <button class="btn btn-success">Submit</button>

                        </form>
 -->


                      <form>

                        <strong>Name:</strong>

                        <input type="text" class="form-control" v-model="name">

                        <strong>File:</strong>

                        <input type="file" class="form-control" v-on:change="onFileChange" ref="imgFile">

    

                        <button @click="UploadImage" type="button" class="btn btn-success">Submit</button>

                        </form>


                         <div v-if="success != ''" class="alert alert-success" role="alert">

                          {{success}}

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

   

<script>

    export default {

        mounted() {
            require('../../adminresponsive')
            console.log('Component mounted.')

        },

        data() {

            return {

              name: '',

              file: '',

              success: '',

              imgPreview: '',

            };

        },

        methods: {

        
            onFileChange(e){

                let files = e.target.files;

                if(files.length == 0){
                    console.log("empty");
                }else{
                    let reader = new FileReader();
                    reader.onload = (e)=> {
                            this.imgPreview = e.target.result
                        }

                        reader.readAsDataURL(files[0]);
                }

                //console.log(e.target.files[0]);

                this.file = e.target.files[0];

            },
            UploadImage: function(e){
                  e.preventDefault();

                  let app = this;

                  const config = {
                        headers: { 'content-type': 'multipart/form-data' }
                  }

                  let formData = new FormData();

                formData.append('file', this.file);
                formData.append('name', this.name);

                 axios.post('/formSubmit', formData, config)

                .then(function (response) {

                    app.success = response.data.success;

                })

                .catch(function (error) {

                    app.success = error;

                });
            },
            formSubmit(e) {

                e.preventDefault();

                let currentObj = this;

   

                const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

    

                let formData = new FormData();

                formData.append('file', this.file);
                formData.append('name', this.name);

   

                axios.post('/formSubmit', formData, config)

                .then(function (response) {

                    currentObj.success = response.data.success;

                })

                .catch(function (error) {

                    currentObj.success = error;

                });

            }

        }

    }

</script>
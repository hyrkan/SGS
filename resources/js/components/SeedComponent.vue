<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registered Seeds</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Seed Name</th>
                                <th>Variety</th>
                                <th>In Stock</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "(seed,index) in seed_list" :key = "index">
                                <td>{{seed.seed_name}}</td>
                                <td>{{seed.variety}}</td>
                                <td>{{seed.quantity}}</td>
                                <td>
                                    <button class="btn btn-outline-success" @click="addSeed(seed.id)"><i class="fa fa-plus"></i></button>
                                    <button class="btn btn-outline-primary" @click="editSeed(seed)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-danger" @click="deleteSeed(seed ,index)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Seed Stock Modal Here -->
        <div class="modal fade" id="add_seed_stock" tabindex="-1" role="dialog" aria-labelledby="add_seed_stock" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">

                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Here -->
        <div class="modal fade" id="add_seed" tabindex="-1" role="dialog" aria-labelledby="add_seed" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">

                        <!-- Form Here -->
                         <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed_name" v-show="edit">Update Seed</label>
                                <label for="seed_name" v-show="!edit">Register New Seed</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seed_name">
                                            <i class="fas fa-seedling"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="seed_name" placeholder="Seed name"
                                     v-model="form.seed_name" >
                                </div>
                                <p class="alert alert-danger" v-show = "errors && errors.seed_name" >Seedname is required</p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Variety</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-seedling"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Variety" v-model="form.variety" required>
                                </div>
                                <p class="alert alert-danger" v-show = "errors && errors.variety" >Variety is required</p>
                            </div>
                            
                            <div class="form-group" v-show="!edit">
                                <label for="quantity">Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="quantity" placeholder="Quantity" v-model="form.quantity" required>
                                </div>
                            </div>
                            <p class="alert alert-danger" v-show = "errors && errors.quantity" >Quantity is required</p> 
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hideModal()">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" v-show="!edit" @click="formSubmit()"> Submit</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" v-show="edit" @click="formUpdateSubmit()"> Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Add Quantity Modal -->
        <div class="modal fade" id="seed_add_quantity" tabindex="-1" role="dialog" aria-labelledby="seed_add_quantity" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="quantity">Add Seed Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="fertlizer_name" placeholder="add seed quantity" v-model="addQuantityform.quantity">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hideAddSeedModal">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="submitSeedQuantity"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <button 
            class="right-side-toggle waves-effect  waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="tooltip" title="Register New Seed" @click="changeMode" >
            <i class="ti-settings text-white"></i>
        </button>
    </div>
</template>

<script>
    export default {

        props: ['user_id'],
       
        //Declaration of data and fields
        data: function () {
            return {
                edit: true,
                seed_id : '',
                seed_list : [],

                form: {
                    seed_name: null,
                    variety : null,
                    quantity : null,
                },

                addQuantityform: {
                    quantity : null,
                },

                errors : {}, 
            }
        },

        //Fetching all Seed Registered in DB when the Seed Component is Loaded
        mounted(){
            this.seedList();
        },


        methods: {

            // Create
            formSubmit(){
                axios.post('/api/seed_management/store',this.form)
                .then (response => {
                    if(response.status == '200'){
                        this.seed_list.push(response.data.data);
                        toast.fire({
                            icon: 'success',
                            title: 'A New Seed Has Been Registered'
                        })
                        this.resetForm();
                        this.hideModal();
                    }

                }).catch (error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors;
                        console.log(this.errors);
                    }
                })
            },

            //Read
            seedList(){
                axios.get('/api/seed_management')
                .then(response => {
                    this.seed_list = response.data
                }).catch(error => {
                    console.log(error);
                })

            },



            //Populating field in the modal with the selected seed data
            //preparation for update
            editSeed(seed){
                this.showModal();
                this.edit = true;
                this.seed_id = seed.id;
                this.form.seed_name = seed.seed_name;
                this.form.variety  = seed.variety;
                this.form.unit = seed.unit;
                this.form.selling_price = seed.selling_price;
                this.form.cost = seed.cost;
            },


            //Submitting seed changes to the database
            formUpdateSubmit(){
               axios.put(`api/seed_management/${this.seed_id}`, this.form)
               .then(response =>{
                   if(response.status == '200'){
                       toast.fire({
                            icon: 'success',
                            title: 'The Seed Selected Has Been Updated'
                        })

                        this.hideModal();
                        this.seedList();
                   }
               })
            },


            //Delete
            deleteSeed(seed,index){
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                        axios.delete(`/api/seed_management/${seed.id}`)
                        .then(response =>{
                            this.seed_list.splice(index , 1)
                        })

                        swal.fire(
                        'Deleted!',
                        'The seed selected has been deleted',
                        'success'
                        )
                    }
                })

               
            },

            changeMode(){
                this.edit = false;
                this.showModal();
                this.resetForm()
            },

            //*
            showModal(){
                this.resetForm();
                $('#add_seed').modal('show');
            },
            
            //*
            hideModal(){
                $('#add_seed').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.resetForm();
               
            },

            showAddSeedModal(){
                $('#seed_add_quantity').modal('show');
            },

            hideAddSeedModal(){
                $('#seed_add_quantity').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.resetForm();
               
            },

            addSeed(seed_id){
                this.seed_id = seed_id;
                this.showAddSeedModal();
            },

            submitSeedQuantity(){
                axios.post('/api/add_seed_quantity' ,{
                    quantity : this.addQuantityform.quantity,
                    id : this.seed_id,
                    user_id : this.user_id,
                })
                .then (response => {
                    if (response.status  == '200'){
                        toast.fire({
                            icon: 'success',
                            title: 'Quantity Added'
                        })
                        this.hideAddSeedModal();
                        this.seedList();
                    }
                }).catch (err => {
                    console.log(err);
                })
            },


            //*
            resetForm(){
                this.form = {};
                this.errors = {};
                this.form.unit = 'Pieces';
                this.addQuantityform = {};
            }


        }
    }


</script>

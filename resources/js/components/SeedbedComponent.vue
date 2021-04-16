<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Of Registered Seedbed</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Seedbed Name</th>
                                <th>Location </th>
                                <th>Seed Capacity</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "(seedbed,index) in seedbed_list" :key = "index">
                                <td>{{seedbed.seedbed_name}}</td>
                                <td>{{seedbed.location}}</td>
                                <td>{{seedbed.seed_capacity}}</td>
                                <td>
                                    <button class="btn btn-outline-primary" @click="editSeedbed(seedbed)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-danger" @click="deleteSeedbed(seedbed,index)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add_bedseed" tabindex="-1" role="dialog" aria-labelledby="add_bedseed" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed_name" v-show="edit">Update Seedbed</label>
                                <label for="seed_name" v-show="!edit">Register New Seedbed</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seedbed_name">
                                            <i class="fas fa-seedling"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="seedbed_name" placeholder="Seedbed name" v-model="form.seedbed_name" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="location-addon1">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="location" placeholder="Location" v-model="form.location">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="capacity">Seed Capacity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="capacity" placeholder="Seed Capacity" v-model="form.seed_capacity">
                                </div>
                            </div>

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

        <button 
            class="right-side-toggle waves-effect  waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="tooltip" title="Register New Seedbed" @click="changeMode" >
            <i class="ti-settings text-white"></i>
        </button>
    </div>
    
</template>

<script>
    export default {

       

        data: function () {
            return {

                seedbed_list : [],

                form: {
                    seedbed_name: null,
                    location : null,
                    seed_capacity : null,
                },

                edit : true,
                seedbed_id : null,

            }
        },

        mounted(){
            this.seedBedList();
        },


        methods: {




            formSubmit(){
                axios.post('/api/seedbed_management/store', this.form)
                .then (response => {
                    if (response.status  == '200'){
                        this.seedbed_list.push(response.data.data);
                        toast.fire({
                            icon: 'success',
                            title: 'A New Seed Has Been Registered'
                        })
                        this.hideModal();
                    }
                }).catch (err => {
                    console.log(err);
                })
            },


            seedBedList(){
                axios.get('/api/seedbed_management')
                .then(response => {
                    this.seedbed_list = response.data;
                }).catch(error => {
                    console.log(error);
                })
            },


            //Populating field in the modal with the selected seed data
            //preparation for update
            editSeedbed(seedbed){
                this.showModal();
                this.edit = true;
                this.form.seedbed_name = seedbed.seedbed_name;
                this.form.location = seedbed.location;
                this.form.seed_capacity = seedbed.seed_capacity;
                this.seedbed_id = seedbed.id;
            },


            //Submitting seed changes to the database
            formUpdateSubmit(){
               axios.put(`api/seedbed_management/${this.seedbed_id}`,this.form)
               .then(response =>{
                   if(response.status == '200'){
                       toast.fire({
                            icon: 'success',
                            title: 'The Seedbed Selected Has Been Updated'
                        })

                        this.hideModal();
                        this.seedBedList();
                   }
               })
            },


            //Delete
            deleteSeedbed(seedbed,index){
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

                        axios.delete(`/api/seedbed_management/${seedbed.id}`)
                        .then(response =>{
                            this.seedbed_list.splice(index,1)
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
                $('#add_bedseed').modal('show');
            },
            
            //*
            hideModal(){
                $('#add_bedseed').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.resetForm();
            },


            //*
            resetForm(){
                this.form = {};
            }


        }
    }


</script>

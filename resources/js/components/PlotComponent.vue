<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registered Land Plot</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Plot Name</th>
                                <th>Location</th>
                                <th>Seed Capacity</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "(plot,index) in plot_list" :key = "index">
                                <td>{{plot.plot_name}}</td>
                                <td>{{plot.location}}</td>
                                <td>{{plot.seed_capacity}}</td>

                                <td>
                                    <button class="btn btn-outline-primary" @click="editPlot(plot)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-danger" @click="deletePlot(plot,index)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add_plot" tabindex="-1" role="dialog" aria-labelledby="add_plot" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed_name" v-show="edit">Update Seedbed</label>
                                <label for="seed_name" v-show="!edit">Register New Seedbed</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="plot_name">
                                            <i class="fas fa-seedling"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="plot_name" placeholder="Plot Name" v-model="form.plot_name" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="location">
                                            <i class="fas fa-seedling"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="location" placeholder="Location" v-model="form.location">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="seed_capacity">Capacity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seed_capacity-addon1">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="seed_capacity" placeholder="Capacity" v-model="form.seed_capacity">
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
            class="right-side-toggle waves-effect  waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="tooltip" title="Register New Plot" @click="changeMode" >
            <i class="ti-settings text-white"></i>
        </button>
    </div>
    
</template>
<script>
    export default {

        data: function () {
            return {
                plot_list : [],

                form: {

                    plot_name: null,
                    location : null,
                    seed_capacity : null,

                },

                edit: false,
                plot_id: null,
            }
        },

        mounted(){
            this.plotList();
        },


        methods: {

            plotList(){
                axios.get('/api/plot_management')
                .then(response => {
                    this.plot_list = response.data
                }).catch(error => {
                    console.log(error);
                })
            },

            formSubmit(){
                axios.post('/api/plot_management/store', {
                    plot_name : this.form.plot_name,
                    location : this.form.location,
                    seed_capacity : this.form.seed_capacity,
                })
                .then (response => {

                    if(response.status == '200'){
                        this.resetForm();
                    }

                    this.hideModal();
                    this.plotList();
                }).catch (err => {
                    console.log(err);
                })
            },

            //Populating field in the modal with the selected seed data
            //preparation for update
            editPlot(plot){
                this.showModal();
                this.edit = true;
                this.form.plot_name = plot.plot_name;
                this.form.location = plot.location;
                this.form.seed_capacity = plot.seed_capacity;
                this.plot_id = plot.id;
            },


            //Submitting seed changes to the database
            formUpdateSubmit(){
               axios.put(`api/plot_management/${this.plot_id}`,this.form)
               .then(response =>{
                   if(response.status == '200'){
                       toast.fire({
                            icon: 'success',
                            title: 'The Seedbed Selected Has Been Updated'
                        })

                        this.hideModal();
                        this.plotList();
                   }
               })
            },


            //Delete
            deletePlot(plot,index){
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

                        axios.delete(`/api/plot_management/${plot.id}`)
                        .then(response =>{
                            this.plot_list.splice(index,1)
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
                $('#add_plot').modal('show');
            },
            
            //*
            hideModal(){
                $('#add_plot').modal('hide');
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

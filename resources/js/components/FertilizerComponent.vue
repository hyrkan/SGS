<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Of Registered Fertilizer</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Fertizer Name</th>
                                <th>Brand </th>
                                <th>Quantity</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "(fertilizer,index) in fertilizers" :key = "index">
                                <td>{{fertilizer.fertilizer_name}}</td>
                                <td>{{fertilizer.fertilizer_brand}}</td>
                                <td>{{fertilizer.quantity}} Bags</td>
                                <td>
                                    <button class="btn btn-outline-success" @click="fertilizer_add(fertilizer.id)"><i class="fa fa-plus"></i></button>
                                    <button class="btn btn-outline-primary" @click="fertilizer_edit(fertilizer)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-danger" @click="fertilizer_delete(fertilizer.id, index)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Add Modal -->
        <div class="modal fade" id="add_fertilizer" tabindex="-1" role="dialog" aria-labelledby="add_fertilizer" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="fertilizer_name">Fertilizer Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fertilizer_name">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="fertlizer_name" placeholder="fertilizer name" v-model="form.fertilizer_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Fertilizer Brand</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="location-addon1">
                                            <i class="far fa-copyright"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="location" placeholder="brand" v-model="form.fertilizer_brand">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-clipboard"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="location" placeholder="initial quantity" v-model="form.quantity">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hideModal()">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="formSubmit()"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="edit_fertilizer" tabindex="-1" role="dialog" aria-labelledby="edit_fertilizer" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed_name">Fertilizer Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seedbed_name">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="fertlizer_name" placeholder="Seedbed name" v-model="updateForm.fertilizer_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Fertilizer Brand</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="location-addon1">
                                            <i class="far fa-copyright"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="location" placeholder="brand" v-model="updateForm.fertilizer_brand">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hideEditModal()">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="formUpdateSubmit()"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Add Quantity Modal -->
        <div class="modal fade" id="fertilizer_add_quantity" tabindex="-1" role="dialog" aria-labelledby="seed_add_quantity" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="quantity">Add Fertilizer Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="fertlizer_name" placeholder="add fertilizer quantity" v-model="addQuantityform.quantity">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hideFertilizerModal">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="submitFertilizerQuantity"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <button 
            class="right-side-toggle waves-effect  waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" 
            data-toggle="tooltip" title="Register New Fertilizer" @click="showModal">
            <i class="ti-settings text-white"></i>
        </button>
    </div>
    
</template>

<script>
    export default {

        props : ['user_id'],

        data : function () {
            return{
                fertilizers : [],
                fertilizer_id : null,
                form: {
                    fertilizer_name: null,
                    fertilizer_brand : null,
                    quantity : null,
                },

                updateForm : {
                    fertilizer_name: null,
                    fertilizer_brand : null,
                },
                
                addQuantityform : {
                    quantity : null,
                }
            }
        }, 

        mounted(){
            this.fertilizers_list();
        },

        
        
        methods : {

            fertilizers_list(){
                axios.get('/api/fertilizer_list')
                .then(response => {
                    this.fertilizers = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },

            formSubmit(){
                axios.post('/api/fertilizer/store', this.form)
                .then (response => {
                    if (response.status  == '200'){
                        this.fertilizers.push(response.data.data);
                        toast.fire({
                            icon: 'success',
                            title: 'A New Fertilizer Has Been Added'
                        })
                        this.hideModal();
                    }
                }).catch (err => {
                    console.log(err);
                })
            },


            //Delete
            fertilizer_delete(fertilizer,index){
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

                        axios.delete(`/api/fertilizer/${fertilizer}`)
                        .then(response =>{
                            this.fertilizers.splice(index,1)
                        })

                        swal.fire(
                        'Deleted!',
                        'The fertilizer selected has been deleted',
                        'success'
                        )
                    }
                })

               
            },


            //edit modal controlls
            fertilizer_edit(fertilizer){
                this.fertilizer_id = fertilizer.id;
                this.updateForm.fertilizer_name = fertilizer.fertilizer_name;
                this.updateForm.fertilizer_brand = fertilizer.fertilizer_brand;
                $('#edit_fertilizer').modal('show');
            },

            formUpdateSubmit(){
               axios.put(`api/fertilizer/${this.fertilizer_id}`,this.updateForm)
               .then(response =>{
                   if(response.status == '200'){
                       toast.fire({
                            icon: 'success',
                            title: 'The Selected Fertilizer Has Been Updated'
                        })

                        this.hideEditModal();
                        this.fertilizers_list();

                   }
               })
            },

            hideEditModal(){
                $('#edit_fertilizer').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.formReset();
            },


            // add modal controls
            showModal(){
                $('#add_fertilizer').modal('show');
            },

            hideModal(){
                $('#add_fertilizer').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.formReset();
            },

            formReset(){
                this.form = {};
            },

            updateFormReset(){
                this.updateForm = {};
            },


            // Show Add Quantity Modal


            showFertilizerModal(){
                $('#fertilizer_add_quantity').modal('show');
            },


            hideFertilizerModal(){
                $('#fertilizer_add_quantity').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.resetQuantityForm();
            },

            fertilizer_add(fertilizer){
                this.showFertilizerModal();
                this.fertilizer_id = fertilizer;
            },

            
            submitFertilizerQuantity(){
                axios.post('/api/add_fertilizer_quantity' ,{
                    quantity : this.addQuantityform.quantity,
                    id : this.fertilizer_id,
                    user_id : this.user_id,
                })
                .then (response => {
                    if (response.status  == '200'){
                        toast.fire({
                            icon: 'success',
                            title: 'Quantity Added'
                        })
                        this.hideFertilizerModal();
                        this.fertilizers_list();
                    }
                }).catch (err => {
                    console.log(err);
                })
            },


            resetQuantityForm(){
                this.addQuantityform = {};
            }
        }
    }
</script>

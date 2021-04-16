<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Of Registered Pesticide</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Pesticide Name</th>
                                <th>Brand </th>
                                <th>Quantity</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "(pesticide,index) in pesticides" :key = "index">
                                <td>{{pesticide.pesticide_name}}</td>
                                <td>{{pesticide.pesticide_brand}}</td>
                                <td>{{pesticide.quantity}} Containers</td>
                                <td>
                                    <button class="btn btn-outline-success" @click="pesticide_add(pesticide)"><i class="fa fa-plus"></i></button>
                                    <button class="btn btn-outline-primary" @click="showEditModal(pesticide)"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-outline-danger" @click="pesticide_delete(pesticide.id, index)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add_pesticide" tabindex="-1" role="dialog" aria-labelledby="add_pesticide" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed_name">Pesticide Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seedbed_name">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="fertlizer_name" placeholder="pesticide name" v-model="form.pesticide_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Pesticide Brand</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="location-addon1">
                                            <i class="far fa-copyright"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="location" placeholder="brand" v-model="form.pesticide_brand">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="location">Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="location-addon1">
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
        <div class="modal fade" id="edit_pesticide" tabindex="-1" role="dialog" aria-labelledby="edit_pesticide" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed_name">Pesticide Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seedbed_name">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="fertlizer_name" placeholder="Seedbed name" v-model="updateForm.pesticide_name">
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
                                    <input type="text" class="form-control" id="location" placeholder="brand" v-model="updateForm.pesticide_brand">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hideEditModal()">Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="formUpdateSubmit()"> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Add Quantity Modal -->
        <div class="modal fade" id="pesticide_add_quantity" tabindex="-1" role="dialog" aria-labelledby="pesticide_add_quantity" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="quantity">Add Pesticide Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-flask"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="fertlizer_name" placeholder="add pesticide quantity" v-model="addQuantityform.quantity">
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-inverse waves-effect waves-light" @click="hidePesticideModal">Cancel</button>
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
                pesticides : [],
                pesticide_id : null,

                form: {
                    pesticide_name: null,
                    pesticide_brand : null,
                    quantity : null,
                },

                updateForm: {
                    pesticide_name: null,
                    pesticide_brand : null,
                },

                addQuantityform : {
                    quantity : null,
                }



            }
        }, 

        mounted(){
            this.pesticide_list();
        },

        
        
        methods : {

            pesticide_list(){
                axios.get('/api/pesticide_list')
                .then(response => {
                    this.pesticides = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },

            formSubmit(){
                axios.post('/api/pesticide/store', this.form)
                .then (response => {
                    if (response.status  == '200'){
                        this.pesticides.push(response.data.data);
                        toast.fire({
                            icon: 'success',
                            title: 'A New Pesticide Has Been Added'
                        })
                        this.hideModal();
                    }
                }).catch (err => {
                    console.log(err);
                })
            },

            showModal(){
                $('#add_pesticide').modal('show');
            },

            hideModal(){
                $('#add_pesticide').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.formReset();
            },

            showEditModal(pesticide){
                this.updateForm.pesticide_name = pesticide.pesticide_name;
                this.updateForm.pesticide_brand = pesticide.pesticide_brand;
                this.pesticide_id = pesticide.id;
                console.log(pesticide.id);
                $('#edit_pesticide').modal('show');
            },


            formUpdateSubmit(){
                axios.put(`api/pesticide/${this.pesticide_id}`,this.updateForm)
               .then(response =>{
                   if(response.status == '200'){
                       toast.fire({
                            icon: 'success',
                            title: 'The Selected Pesticide Has Been Updated'
                        })

                        this.hideEditModal();
                        this.pesticide_list();
                   }
               })
            },

                        //Delete
            pesticide_delete(pesticide,index){
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

                        axios.delete(`/api/pesticide/${pesticide}`)
                        .then(response =>{
                            this.pesticides.splice(index,1)
                        })

                        swal.fire(
                        'Deleted!',
                        'The seed selected has been deleted',
                        'success'
                        )
                    }
                })

               
            },

            hideEditModal(){
                $('#edit_pesticide').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.formReset();
            },

            formReset(){
                this.form = {};
            },



            showPesticideModal(){
                $('#pesticide_add_quantity').modal('show');
            },


            hidePesticideModal(){
                $('#pesticide_add_quantity').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                this.resetQuantityForm();
            },

            pesticide_add(pesticide){
                this.pesticide_id = pesticide.id;
                this.showPesticideModal();
            },

            
            submitFertilizerQuantity(){
                axios.post('/api/add_pesticide_quantity' ,{
                    quantity : this.addQuantityform.quantity,
                    id : this.pesticide_id,
                    user_id : this.user_id,
                })
                .then (response => {
                    if (response.status  == '200'){
                        toast.fire({
                            icon: 'success',
                            title: 'Quantity Added'
                        })
                        this.hidePesticideModal();
                        this.pesticide_list();
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

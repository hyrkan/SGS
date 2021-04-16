<template>
    <div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Of Task Scheduled for this Plot</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Task Name</th>
                                    <th>Task Schedule</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for = "(task,index) in task_list" :key = "index">
                                    <td>{{task.task_name}}</td>
                                    <td>{{task.task_schedule}}</td> 
                                    <td>
                                        <button class="btn btn-outline-primary" @click="showEditModal(pesticide)"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-danger" @click="pesticide_delete(pesticide.id, index)"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add_task" tabindex="-1" role="dialog" aria-labelledby="add_task" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="exampleInputuname">Task Selection</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <select @change="taskSelected($event)" class="form-control custom-select" v-model="form.task_name" required> 
                                        <option value="" disabled>Task Selection</option>
                                        <option value="Apply fertilizer">Use Fertilizer</option>
                                        <option value="Apply pesticide">Use Pesticide</option>                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" v-if="form.task_name == 'Apply fertilizer'">
                                <label for="fertilizer_name">Select Fertilizer To Use</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fertilizer_name">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <select class="form-control custom-select" v-model="form.fertilizer_id" required> 
                                        <option value="" disabled>Select Fertilizer to Use</option>
                                        <option v-for="fertilizer in fertilizers" :key="fertilizer.id"
                                        v-bind:value="{ id: fertilizer.id, fertilizer_name: fertilizer.fertilizer_name }">{{fertilizer.fertilizer_name}}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group" v-if="form.task_name == 'Apply fertilizer'">
                                <label for="quantity"> Bags of Fertilizer To Be Used</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fertilizer_name">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="quantity" placeholder="quantity" v-model="form.fertilizer_bags_used">
                                </div>
                            </div>


                            <div class="form-group" v-if="form.task_name == 'Apply pesticide'">
                                <label for="fertilizer_name">Select Fertilizer To Use</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fertilizer_name">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <select class="form-control custom-select" v-model="form.pesticide_id" required> 
                                        <option value="" disabled>Select Pesticide to Use</option>
                                        <option v-for="pesticide in pesticides" :key="pesticide.id"
                                        v-bind:value="{ id: pesticide.id, pesticide_name: pesticide.pesticide_name }">{{pesticide.pesticide_name}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" v-if="form.task_name == 'Apply pesticide'">
                                <label for="pesticide_quantity"> Containers of Pesticide To Be Used</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="pesticide_quantity">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="quantity" placeholder="quantity" v-model="form.pesticide_containers_used">
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="quantity">Set Schedule</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                    </div>
                                <input type="date" class="form-control" placeholder="dd/mm/yyyy"  required v-model="form.task_schedule">                               
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
        <button 
            class="right-side-toggle waves-effect  waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" 
            data-toggle="tooltip" title="Add New Task" @click="showModal">
            <i class="ti-settings text-white"></i>
        </button>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchFertilizer();
            this.fetchPesticide();
            this.fetchTask();
        },

        props: ['plot'],

        data : function (){
            return {
                pesticides : [],
                fertilizers : [],
                task_list : [],

                form : {
                    task_name : '',
                    fertilizer_id : '',
                    task_schedule: null,
                    pesticide_id : '',
                    fertilizer_bags_used:'',
                    pesticide_containers_used: '',

                }
            }
        },



        methods : {

            taskSelected(event){
                console.log(event.target.value);
                if(event.target.value == 'Apply fertilizer'){
                    
                    this.pesticide_id = '';
                    this.pesticide_containers_used = '';

                }else{
                    this.fertilizer_id = '';
                    this.fertilizer_bags_used = '';
                }


            },

            formSubmit(){
                axios.post('/api/task', {
                    task_name : this.form.task_name,
                    fertilizer_id : this.form.fertilizer_id,
                    task_schedule : this.form.task_schedule,
                    pesticide_id : this.form.pesticide_id,
                    fertilizer_bags_used : this.form.fertilizer_bags_used,
                    pesticide_containers_used : this.form.pesticide_containers_used,
                    plot_id : this.plot

                }).then (response => {
                    if (response.status  == '200'){
                        this.fertilizers.push(response.data.data);
                        toast.fire({
                            icon: 'success',
                            title: 'A New Task Has Been Added'
                        })
                        this.hideModal();
                    }

                    this.fetchTask();

                }).catch (err => {
                    console.log(err);
                })
            },

            fetchFertilizer(){
                axios.get('/api/fertilizer_list')
                .then(response => {
                    this.fertilizers = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },

            fetchTask(){
                axios.get('/api/task_list')
                .then(response => {
                    this.task_list = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },

            fetchPesticide(){
                axios.get('/api/pesticide_list')
                .then(response => {
                    this.pesticides = response.data;
                }).catch(err => {
                    console.log(err);
                })
            },

            showModal(){
                $('#add_task').modal('show');
            },



            hideModal(){
                $('#add_task').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        },
    }
</script>

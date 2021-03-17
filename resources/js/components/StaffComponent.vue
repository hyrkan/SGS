<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registered Users</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th>Date Registered</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(staff, index) in staff_list" :key = "index" >
                                <td>{{staff.firstname}} {{staff.middle_initial}} {{staff.lastname}}</td>
                                <td>
                                    admin
                                </td>
                                <td>May 15, 2015</td>
                                <td class="text-nowrap">
                                    <button class="btn btn-outline-secondary"><i class="fa fa-edit"></i>  edit</button>
                                    <button class="btn btn-outline-danger"><i class="fa fa-trash"></i> delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add_staff" tabindex="-1" role="dialog" aria-labelledby="add_staff" aria-hidden="true" >
            <div class="modal-dialog modal-xl" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal" @submit.prevent>
                            <div class="form-body">
                                <h3 class="box-title">Personal Information</h3>
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Firstname</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  v-model="form.firstname" required>
                                                <!-- <small class="form-control-feedback"> This is inline help </small>  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Lastname</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  v-model="form.lastname" required>
                                                <small class="form-control-feedback"> This is inline help </small> 
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Middle Initial</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  v-model="form.middle_initial" required>
                                                <!-- <small class="form-control-feedback"> This is inline help </small>  -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Gender</label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" v-model="form.gender" required> 
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                                <small class="form-control-feedback"> Select your gender. </small> </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/row--> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Phone No.</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control"  v-model="form.phone_number" required>
                                                <!-- <small class="form-control-feedback"> This is inline help </small>  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Date of Birth</label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="form.dob" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>                            
                                <h3 class="box-title">Account Details</h3>
                                <hr class="m-t-0 m-b-40">
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="form.username" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" v-model="form.email" required>
                                                <!-- <small class="form-control-feedback"> This is inline help </small>  -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" v-model="form.password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="float-right mb-5">
                                <button data-dismiss="modal" type="button" class="btn btn-danger"> <i class="fa fa-window-close"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" @click="formSubmit()"> <i class="fa fa-check"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button 
            class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" data-toggle="modal" data-target="#add_staff">
            <i class="ti-settings text-white"></i>
        </button>
    </div>
    
</template>

<script>
    export default {

       

        data: function () {
            return {

                staff_list : [],

                form: {
                    firstname : '',
                    lastname : '',
                    middle_initial : '',
                    gender : '',
                    dob : '',
                    phone_number : '',
                    email: '',
                    username : '',
                    password : '',
                }
            }
        },

        mounted(){
            this.staffList();
        },

        methods: {

            staffList() {
                axios.get('api/staff_management')
                .then(response => {
                    this.staff_list = response.data
                })
                .catch (error => {
                    console.log(error);
                })
            },

            formSubmit(){
                axios.post('/api/staff_management/store', {
                    firstname : this.form.firstname,
                    lastname : this.form.lastname,
                    middle_initial : this.form.middle_initial,
                    dob : this.form.dob,
                    email: this.form.email,
                    phone_number : this.form.phone_number,
                    gender : this.form.gender,
                    username : this.form.username,
                    password : this.form.password,
                })
                .then (response => {
                    if (response.status == 200 ){
                        this.form == {};
                    }
                    this.hideModal();
                }).catch (err => {
                    console.log(err);
                })
            },

            hideModal(){
                $('#add_staff').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },


        }
    }


</script>

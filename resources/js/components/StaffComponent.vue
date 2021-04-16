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
                                                <has-error :form="form" field="firstname"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Lastname</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  v-model="form.lastname" required>
                                                <has-error :form="form" field="lastname"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Middle Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  v-model="form.middlename" required>
                                                <has-error :form="form" field="middlename"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Phone No.</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control"  v-model="form.phone_number" required>
                                                <has-error :form="form" field="phone_number"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                
                                    
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
                                                <has-error :form="form" field="username"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Role</label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" v-model="form.role" required> 
                                                    <option value="" disabled>Select Role</option>
                                                    <option> Admin</option>
                                                    <option> Staff</option>
                                                    <option> Gardener</option>
                                                </select>
                                                <has-error :form="form" field="role"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Password </label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" required>
                                                <has-error :form="form" field="password"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Password Confirmation</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password') }" required>
                                                <has-error :form="form" field="password_confirmation"></has-error>
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

                form : new Form({

                    firstname : '',
                    lastname : '',
                    middlename : '',
                    phone_number : '',
                    role : '',
                    username : '',
                    password : '',
                    password_confirmation : '',

                }),
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
                axios.post('/api/staff_management/store', this.form)
                .then (response => {
                    if (response.status == 200 ){
                        this.form == {};
                    }
                    this.hideModal();
                }).catch (err => {
                    console.log(err);
                })

                this.staffList();
                
            },

            hideModal(){
                $('#add_staff').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            },


        }
    }


</script>

<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Seedbed Status </h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Bed Name</th>
                                <th>Location</th>
                                <th>Seed Planted</th>
                                <th>No.Seed Planted </th>
                                <th>Started</th>
                                <th>Transfer</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(sowed,index) in sowings" :key="index">
                                <td>{{sowed.seedbed_name}}</td>
                                <td>{{sowed.location}}</td>
                                <td>{{sowed.seed_name}}</td>
                                <td>{{sowed.quantity}}</td>
                                <td>{{sowed.start}}</td>
                                <th>{{sowed.date_transfer}}</th>
                                <td>
                                    <button class="btn btn-outline-success btn-block">In Progress</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="sow_seed" tabindex="-1" role="dialog" aria-labelledby="sow_seed" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sow Seeds</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <!-- Form Here -->
                        <form class="form p-t-20" @submit.prevent>
                            <div class="form-group">
                                <label for="seed">Seed</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seed">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <select class="form-control custom-select" v-model="form.seed" required> 
                                        <option value="" disabled>Select Seed</option>
                                        <option v-for="seed in seed_list" :key="seed.id"
                                        v-bind:value="{ id: seed.id, seed_name: seed.seed_name }">{{seed.seed_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="seedbed">Seedbed</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="seedbed">
                                            <i class="fas fa-balance-scale"></i>
                                        </span>
                                    </div>
                                    <select class="form-control custom-select" v-model="form.seedbed" required> 
                                        <option value="" disabled>Select Seedbed</option>
                                        <option v-for = "(seedbed,index) in seedbed_list" :key="index"
                                        v-bind:value="{ id: seedbed.id, seedbed_name: seedbed.seedbed_name }">{{seedbed.seedbed_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Seed Quantity To Sow</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" id="capacity" placeholder="Seed Capacity" v-model="form.quantity">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Start Of Sowing</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="form.start" required>                                </div>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Date Of Transferring to a Plot</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="quantity">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="form.transfer_date" required>                                </div>
                                </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" @click="formSubmit()"> Submit</button>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
        <button 
            class="right-side-toggle waves-effect  waves-light btn-success btn btn-circle btn-sm pull-right m-l-10" @click="showModal">
            <i class="ti-settings text-white"></i>
        </button>
    </div>
</template>

<script>
export default {

    mounted() {
        this.fetchSeeds();
        this.fetchSeedbeds();
        this.fetchSowings();
    },
    
    data : function (){
        return {
            seed_list : [],
            seedbed_list : [],
            sowings : [],
            form : {
                seed : '',
                seedbed : '',
                quantity : '',
                start: '',
                transfer_date : ''
            }
        }
    },

    methods: {
        fetchSeeds(){
            axios.get('api/fetch_seeds')
            .then(response => {
                this.seed_list  = response.data
            }).catch(err => {
                console.log(err)
            })
        },

        fetchSeedbeds(){
            axios.get('api/fetch_seedbed')
            .then(response => {
                this.seedbed_list = response.data
            }).catch(err => {
                console.log(err)
            })
        },

        fetchSowings(){
            axios.get('api/fetch_sowings')
            .then(response => {
                this.sowings = response.data
            }).catch(err => {
                console.log(err);
            })
        },


        showModal(){
            $('#sow_seed').modal('show')
        },

        hideModal(){
            $('#sow_seed').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            this.formReset();
        },
        
        formSubmit(){
           axios.post('api/seed_sowing', {
               seed_id : this.form.seed.id,
               seedbed_id : this.form.seedbed.id,
               quantity : this.form.quantity,
               start : this.form.start,
               date_transfer : this.form.transfer_date

           }).then(response => {
               if (response.status == "200"){
                    toast.fire({
                        icon: 'success',
                        title: 'Successfully planted the seed'
                    })
                    this.fetchSowings();
                    this.hideModal();
                    

               }
           }).catch(err => {

           })
           
       },

       formReset(){
           this.form = {}
       }
    }

}
</script>
<template>

    <!-- table here -->
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
                            <th>Action</th>
                            <th class="text-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(sowed,index) in sowings" :key="index" v-if="sowed.quantity">
                            <td>{{sowed.seedbed_name}}</td>
                            <td>{{sowed.location}}</td>
                            <td>{{sowed.seed_name}}</td>
                            <td>{{sowed.quantity}}</td>
                            <td>{{sowed.start}}</td>
                            <th>{{sowed.date_transfer}}</th>
                            <td v-if="compareWithToday(sowed.date_transfer)">
                                <button class="btn btn-outline-success btn-block" data-toggle="tooltip" 
                                title="Transfer the Seedling To Another Plot" @click="showTransferModal(sowed)">Transfer</button>
                                <button class="btn btn-outline-success btn-block" data-toggle="tooltip" 
                                title="Transfer the Seedling To Another Plot" @click="sendNotifications">Test SMS</button>
                            </td>
                            <td v-else>
                                <button class="btn btn-outline-warning btn-block" data-toggle="tooltip" 
                                title="In Progress" >Queing</button>
                                <!-- <button class="btn btn-outline-success btn-block" data-toggle="tooltip" 
                                title="Transfer the Seedling To Another Plot" @click="sendNotifications">Send SMS</button> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>







        <!-- Transfer Modal -->
        <div class="modal fade" id="transfer_plot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transfer_plot">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-success"><i class="fas fa-seedling"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0">Seedling of : {{this.seedling}}</h3>
                                <h3 class="m-b-0">Seedling Quantity : {{this.seedling_quantity}}</h3>
                            </div>
                        </div>
                    </div>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Plot transfer Form Here -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <form class="form p-t-20" @submit.prevent>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Plot Selection</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-balance-scale"></i>
                                                </span>
                                            </div>
                                            <select class="form-control custom-select" required v-model="transfer_form.selected_plot"> 
                                                <option value="" disabled>Plot Selection</option>
            
                                                <option v-for="plot in plot_list" :key="plot.id"
                                                v-bind:value="{ id: plot.id, plot_name: plot.plot_name }">{{plot.plot_name}}</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fas fa-boxes"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" id="quantity" placeholder="Quantity" required v-model="transfer_form.selected_quantity">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Harvest Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="quantity">
                                                    <i class="fas fa-warehouse"></i>
                                                </span>
                                            </div>
                                        <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="transfer_form.harvest_date" required>                                </div>
                                    </div>
                                    <div class="mt-5 ">
                                        <button  @click="prepareTransfer" class="btn btn-success float-right"><i class="fa fa-plus"></i> Transfer</button>
                                    </div>
                                </form>  
                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Transferring Seedling To Another Plot </h4>
                                        <div class="table-responsive text-centered">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Plot Name</th>
                                                        <th>Quantity</th>
                                                        <th>Date of Harvest</th>
                                                        <td>Actions</td>
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(transfer,index) in for_transfer" :key="index">
                                                        <td>{{transfer.selected_plot.plot_name}}</td>
                                                        <td>{{transfer.selected_quantity}}</td>
                                                        <td>{{transfer.harvest_date}}</td>
                                                        <td>
                                                            <button class="btn btn-danger" @click="removeSeed(transfer.selected_quantity, index)">
                                                                <i class="fa fa-window-close"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="saveSeedPlot">Save changes</button>
            </div>
            </div>
        </div>
        </div>



        <!-- Sowing Seed Modal -->
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
                                    <input type="number" class="form-control" id="capacity" placeholder="quantity" v-model="form.quantity">
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
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" data-dismiss="modal"> Cancel</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" :disabled="isLoading" @click="formSubmit()"> Submit</button>
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
        this.checkDate();
        this.fetchSeeds();
        this.fetchSeedbeds();
        this.fetchSowings();
        this.fetchPlot();
    },
    
    data : function (){
        return {
            seed_list : [],
            seedbed_list : [],
            plot_list : [],
            sowings : [],

            seedling : null,
            seedling_quantity : null,
            seed_sowing_id : null,
        
            for_transfer : [],

            transfer_form : {
                selected_plot : '',
                selected_quantity : '',
                harvest_date: '',
            },

            form : {
                seed : '',
                seedbed : '',
                quantity : '',
                start: '',
                transfer_date : ''
            },

            seedling_variety : '',
            terms: false,
            isLoading: false,
            currrent_date : '',
        }
    },




    

    methods: {

        checkDate(date_transfer){
            var today = new Date(),
            todayDate = ('0'+today.getDate()).slice(-2),
            todayMonth = ('0'+ (today.getMonth() + 1) ).slice(-2),
            todayYear = today.getFullYear();

            var day = '';
            day = todayYear + '-' + todayMonth + '-' + todayDate;
            this.currrent_date = day;
        },
        
        compareWithToday(date){
            return this.$options.filters.yymmdd(date) === this.currrent_date;
        },



        sendNotifications(){
            axios.post('api/notify_transfer')
            .then(response => {
                console.log(response.data);
            }).catch(err => {
                console.log(err)
            })
        },

        fetchPlot(){
            axios.get('api/fetch_plot')
            .then(response => {
                this.plot_list  = response.data
            }).catch(err => {
                console.log(err)
            })

        },


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
            this.isLoading = true
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

                    setTimeout(() => {
                    this.isLoading = false
                    }, 1000)

               }
           }).catch(err => {

           })
           
       },

        formReset(){
            this.form.seed = '';
            this.form.seedbed = '';
            this.form.quantity = '';
            this.form.start = '';
            this.form.transfer_date = '';
        },

        transfer_form_reset(){
            this.transfer_form.selected_plot = '';
            this.transfer_form.selected_quantity = '';
            this.transfer_form.harvest_date = '';
        },


        showTransferModal(sowed){
            this.seedling = sowed.seed_name;
            this.seedling_variety = sowed.variety;
            this.seedling_quantity = sowed.quantity;
            this.from_seedbed = sowed.seedbed_name;
            this.seed_sowing_id = sowed.id;
            this.for_transfer = [];
            $('#transfer_plot').modal('show')
            
        },

        hideTransferModal(){
            $('#transfer_plot').modal('hide')
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        },

        


        removeSeed(selected_quantity, index){
            this.seedling_quantity = parseInt(this.seedling_quantity) + parseInt(selected_quantity);
            this.for_transfer.splice(index);
        },

        prepareTransfer(){

            var count = this.seedling_quantity;
            
            if(this.transfer_form.transfer_date != '' && this.transfer_form.selected_plot != '' && this.transfer_form.selected_quantity != ''){
               
               if(count > 0){

                    this.for_transfer.push({... this.transfer_form});
                    count -= this.transfer_form.selected_quantity;
                    this.transfer_form_reset();
                    
               }
            }
            this.seedling_quantity = count;           
        },
        
        saveSeedPlot(){
            
            axios.post('api/seed_plot', {
                seeded_plots : this.for_transfer,
                seedling_name : this.seedling,
                seedling_variety : this.seedling_variety,
                seed_sowing_id : this.seed_sowing_id,

            }).then(response => {
                if (response.status == "200"){
                    toast.fire({
                        icon: 'success',
                        title: 'Successfully planted the seed'
                    })
                    this.fetchSowings();
                    this.hideModal();
                    setTimeout(() => {
                    this.isLoading = false
                    }, 1000)

                    this.hideTransferModal()
                        
               }

            }).catch(error => {

            })
        }

    
    },
    filters: {
        'yymmdd': function (date) { 
        var newDay = new Date(date),
            currentDate = ('0'+newDay.getDate()).slice(-2),
            currentMonth = ('0'+ (newDay.getMonth() + 1) ).slice(-2),
            currentYear = newDay.getFullYear();

        var day = '';
        day = currentYear + '-' + currentMonth + '-' + currentDate;

        return day;
        }
    },

}
</script>
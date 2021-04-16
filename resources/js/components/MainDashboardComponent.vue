<template>
    <div class="wrapper">
            <div class="row">
            <!-- Column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-light">Seedbed Schedule</h3>
                                <h5 class="text-muted m-b-0">Total Revenue</h5></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht">$2376</h3>
                                <h5 class="text-muted m-b-0">Online Revenue</h5></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round round-lg align-self-center round-danger"><i class="fas fa-calendar-alt"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0 font-lgiht">Task Today</h3>
                                <h5 class="text-muted m-b-0"><a href="">Check Task</a></h5></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Sales Report </h3>
                                <h6 class="card-subtitle">Today's Sales Report</h6>
                                <div id="visitor" style="height:260px; width:100%;"></div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">For Harvest Today </h3>
                                <h6 class="card-subtitle">Seedlings Ready To Harvest</h6>
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>Plot Name</th>
                                            <th>Seeed</th>
                                            <th>Actions</th>
                                            <th class="text-nowrap"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="plots in for_harvest_today" :key = "plots.id">
                                            <td>{{plots.plot_name}}</td>
                                            <td>{{plots.seedling_name}}</td>
                                            <td>
                                                <button class="btn btn-primary" @click="showHarvest(plots)">Harvest</button>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Products Inventory </h3>
                                <h6 class="card-subtitle">Seedlings For Transfer to Another Plot</h6>
                                <table class="table text-center">
                                    <thead>
                                        <th>Product Name</th>
                                        <th>Product Variety</th>
                                        <th>Quantity in Stock</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for = "product in product_list" :key = "product.id">
                                            <td>{{product.seed_name}}</td>
                                            <td>{{product.variety}}</td>
                                            <td>{{product.quantity}}</td>
                                            <td>Available</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Seedbed Board </h3>
                                <h6 class="card-subtitle">Seedlings For Transfer to Another Plot</h6>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th>Bed Name</th>
                                                <th>Location</th>
                                                <th>Seed Planted</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="transfer in for_transfer_today" :key="transfer.id">
                                                <td>{{transfer.seedbed_name}}</td>
                                                <td>{{transfer.location}}</td>
                                                <td>{{transfer.seed_name}}</td>
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
        <div class="modal fade" id="check_harvest" tabindex="-1" role="dialog" aria-labelledby="check_harvest" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">For Harvest</h4>
                                        <ul class="feeds">
                                            <li>Plot <span class="text-muted"><h4>{{this.plot_name}}</h4></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Check Quality</h4>
                                        <p>Is There A Low Quality Crop Produced?</p>
                                        <form action="">
                                            <div class="form-group" v-if="status === 'yes'">
                                                <label for="quantity">Number of Crops To be Disposed</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="fas fa-boxes"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control" id="quantity" placeholder="Quantity" required v-model="low_quality">
                                                </div>
                                            </div>
                                            <ul class="list-inline m-b-0">
                                                <li>
                                                    <input name="group1" type="radio" id="radio_1" v-model="status" value="no"/>
                                                    <label for="radio_1">No</label>
                                                </li>
                                                <li>
                                                <input name="group1" type="radio" id="radio_2" v-model="status" value="yes"/>
                                                <label for="radio_2">Yes</label>
                                                </li>
                                            </ul>
                                            
                                            <button class="btn btn-primary float-right mt-5">Harvest</button>
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetch_for_transfer_today();
            this.fetch_for_harvest_today();
            this.fetchProducts();
        },


        data : function(){
            return {
                for_transfer_today : [],
                for_harvest_today : [],
                product_list : [],
                
                status : 'no',
                plot_name: null,
               
                
            }
        },


        methods : {

            submitHarvest(){
                axios.post('/api/harvest')
            },


            fetch_for_transfer_today(){
                axios.get('/api/for_transfer_today')
                .then(response => {
                    this.for_transfer_today = response.data
                }).catch(error => {
                    console.log(error);
                })
            },

            fetch_for_harvest_today(){
            axios.get('/api/for_harvest_today')
                .then(response => {
                    this.for_harvest_today = response.data
                }).catch(error => {
                    console.log(error);
                })
            },


            showHarvest(plots){
                plot_name =  plots.plot_name;
                plot_location = plots.plot_location,
                seedling_name = plots.seedling_name,
                seedling_variety = plots.seedling_variety,
                seedling_quantity = plots.quantity,
                plot_id = plots.plot_id,
                seed_id = plots.seed_id,
                seed_plot_id = plots.id,
                date_harvest = plots.date_harvest,
                
                $('#check_harvest').modal('show');
            },

            fetchProducts() {
                axios.get('/api/product_list')
                .then(response => {
                    this.product_list = response.data;
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

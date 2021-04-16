<template>

    <div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Plot Status </h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Plot Name</th>
                                <th>Location</th>
                                <th>Seedling Name</th>
                                <th>Seedling Variety</th>
                                <th>Quantity</th>
                                <th>Date Harvest</th>
                                <th>Actions</th>
                                <th class="text-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for = "plots in seeded_plots" :key = "plots.id">
                                <td>{{plots.plot_name}}</td>
                                <td>{{plots.location}}</td>
                                <td>{{plots.seedling_name}}</td>
                                <td>{{plots.seedling_variety}}</td>
                                <td>{{plots.quantity}}</td>
                                <td>{{plots.date_harvest}}</td>
                                <td>
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-primary">Assign Task</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</template>

<script>
export default {
    
    mounted(){
        this.fetch_seedPlots();
    },

    data : function () {
        return{
            seeded_plots : null,
        }
    },

    methods: {

        fetch_seedPlots(){
            axios.get('/api/fetch_seedPlots')
            .then(response => {
                this.seeded_plots = response.data
            }).catch(error =>{
                console.log(error.data)
            })
        },

    }



}
</script>
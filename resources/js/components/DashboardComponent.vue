<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Main Menu</h4>
                    <div class="row">
                        <div class="col-md-12 col-sm-4 p-20">
                            <div class="list-group">
                                <button type="button" class="list-group-item btn btn-primary waves-effect waves-light mb-1">
                                    <router-link to="/home"><p class="text-white text-centered">Calendar</p></router-link>
                                </button>
                                <button type="button" class="list-group-item btn btn-primary waves-effect waves-light mb-1">
                                    <router-link to="/seed_sow"><p class="text-white text-centered">Monitor Seedbed</p></router-link>
                                </button>
                                <button type="button" class="list-group-item btn btn-primary waves-effect waves-light mb-1">
                                    <router-link to="/plot_monitoring"><p class="text-white text-centered">Monitor Plot</p></router-link>
                                </button>
                                <button type="button" class="list-group-item btn btn-primary waves-effect waves-light mb-1">
                                    <router-link to="/inventory"><p class="text-white text-centered">Analytics</p></router-link>
                                </button>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <router-view></router-view>
        </div>
    </div>
            
    
</template>


<script>
export default {

}
</script>
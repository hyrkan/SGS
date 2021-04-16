<template>
    <div class="row">
        <div class="col-md-2">
            <div class="collapse m-t-15 well" id="pgr2" aria-expanded="true">
                <pre class="highlight"> 
                    &lt;div class="list-group"&gt;<br/>
                    &lt;a href="javascript:void(0)" class="list-group-item active"&gt;Cras justo odio&lt;/a&gt;
                    &lt;a href="javascript:void(0)" class="list-group-item"&gt;Dapibus ac facilisis in&lt;/a&gt;
                    &lt;a href="javascript:void(0)" class="list-group-item"&gt;Morbi leo risus&lt;/a&gt;
                    &lt;a href="javascript:void(0)" class="list-group-item"&gt;Porta ac consectetur ac&lt;/a&gt;
                    &lt;a href="javascript:void(0)" class="list-group-item"&gt;Vestibulum at eros&lt;/a&gt;
                &lt;/div&gt;</code> </pre>
            </div>
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item"><router-link to="/seed_sow">Monitor Seedbed</router-link></a> 
                <a href="javascript:void(0)" class="list-group-item"><router-link to="/plot_monitoring">Monitor Plot</router-link></a> 
            </div> 
        </div>
        <div class="col-md-10">
            <router-view></router-view>
        </div>
    </div>
            
    
</template>


<script>
export default {

}
</script>
<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Of Products</h4>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
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
                                <td>Status</td>
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
            this.fetchProducts();
        },

        data : function (){
            return {
                product_list : null,
            }
        },

        methods : {
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

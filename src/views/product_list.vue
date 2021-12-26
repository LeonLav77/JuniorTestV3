<template>
	<div id="container">
        <div id="header">
            <h1>{{ headerTitle }}</h1>
            <div>
                <button @click="add_products">ADD</button>
                <button @click="massDelete">MASS DELETE</button>
            </div>
        </div>
        <hr>
        <div id="grid">
			<div v-for="product in products" :key="product.id" v-bind:id="product.Id">
                <div class="grid-item">
                    <div class="left" id="#v-model-multiple-checkboxes">
                        <input type="checkbox" v-model="checkedIds" :value="product.Id"  />
                        <!-- <input type="checkbox" id="mike" value="Mike" v-model="checkedIds"> -->
                    </div>
                    <div class="center">
                        <div>{{ product.SKU }}</div>
                        <div>{{ product.productName }}</div>
                        <div>{{ product.price }} $</div>
                        <div v-if="product.productType == 'Book'">Weight :{{ product.dimension1 }}</div>
                        <div v-else-if="product.productType == 'DVD'">Size :{{ product.dimension1 }}</div>
                        <div v-else-if="product.productType == 'Furniture'">Dimensions :{{ product.dimension1 }} x {{ product.dimension2 }} x {{ product.dimension3 }}</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios'
	export default {
		name: 'Users',
        title: 'Product List',
		props: {
			title: String
		},
		data: () => ({
			products: [],
            checkedIds: [],
            headerTitle: 'Product List'
		}),
		mounted() {
			axios.get('https://juniottestapi.000webhostapp.com/product').then((res) => {
				// this.users = res.data
                let products = JSON.parse(res.data);
                console.log(products);
                this.products = products;
			},
            '#v-model-multiple-checkboxes'
            )
		},
        methods: {
            massDelete() {
                axios.delete('https://juniottestapi.000webhostapp.com/product?checkedIds=' + this.checkedIds).then((res) => {
                    console.log(res.data);
                    this.toDelete = res.data;
                    if(this.toDelete == "empty") {
                        console.log('No products selected');
                    }else{
                        for (let i = 0; i < this.toDelete.length; i++) {
                            let id = this.toDelete[i];
                        let index = this.products.findIndex(x => x.Id == id);
                        this.products.splice(index, 1);
                    }
                    }
                    this.checkedIds = [];
                })
            },
            add_products(){
                this.$router.push('/add-product');
            }
        }
	}
</script>

<style scoped>
    #grid {
        display: -ms-grid;
        display: grid;
        gap: 1rem;
        -ms-grid-columns: minmax(24%, 1fr) [auto-fill];
        grid-template-columns: repeat(auto-fill, minmax(24%, 1fr));
        height: auto;
    }
    .grid-item {
        background-color: rgb(145, 143, 143);
        height: 100%;
        width: 100%;
    }


</style>
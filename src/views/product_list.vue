<template>
  <div id="container">
    <div id="header">
      <h1>{{ headerTitle }}</h1>
      <div>
        <button @click="add_products">ADD</button>
        <button @click="massDelete">MASS DELETE</button>
      </div>
    </div>
    <hr />
    <div id="grid">
      <div v-for="product in products" :key="product.id" v-bind:id="product.Id">
        <div class="grid-item">
          <div id="#v-model-multiple-checkboxes">
            <input type="checkbox" v-model="checkedIds" :value="product.Id" class="delete-checkbox" />
          </div>
          <div class="center">
            <p>{{ product.SKU }}</p>
            <p>{{ product.productName }}</p>
            <p>{{ product.price }} $</p>
            <div v-if="product.productType == 'Book'">
              Weight :{{ product.dimension1 }}
            </div>
            <div v-else-if="product.productType == 'DVD'">
              Size :{{ product.dimension1 }}
            </div>
            <div v-else-if="product.productType == 'Furniture'">
              Dimensions :{{ product.dimension1 }} x {{ product.dimension2 }} x
              {{ product.dimension3 }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Users",
  title: "Product List",
  props: {
    title: String,
  },
  data: () => ({
    products: [],
    checkedIds: [],
    headerTitle: "Product List",
  }),
  mounted() {
    axios.get("https://juniottestapi.000webhostapp.com/product").then((res) => {
      if (res.data.length > 0) {
        let products = JSON.parse(res.data);
        this.products = products;
      } else {
        this.products = [];
      }
    }, "#v-model-multiple-checkboxes");
  },
  methods: {
    massDelete() {
      if (this.checkedIds.length > 0) {
        axios
          .get(
            "https://juniottestapi.000webhostapp.com/product?checkedIds=" +
              this.checkedIds
          )
          .then((res) => {
            this.toDelete = res.data;
            if (this.toDelete == "empty") {
              console.log("products not found");
            } else {
              for (let i = 0; i < this.toDelete.length; i++) {
                let id = this.toDelete[i];
                // since the this.products array is unordered the indedx isnt the real index
                // so we need to find the index of the id
                let index = this.products.findIndex((x) => x.Id == id);
                this.products.splice(index, 1);
              }
            }
            this.checkedIds = [];
          });
      } else {
        console.log("no products selected");
      }
    },
    add_products() {
      this.$router.push("/add-product");
    },
  },
};
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
p {
  font-size: 1.2rem;
  margin: 0;
}
</style>
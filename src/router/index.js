import { createRouter, createWebHistory } from "vue-router";
import add_product from "../views/add_product";
import product_list from "../views/product_list";
const routes = [
  {
    path: "/",
    name: "Product List",
    component: product_list,
  },
  {
    path: "/add-product",
    name: "Add Product",
    component: add_product,
  },
];
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});
export default router;

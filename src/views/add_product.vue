<template>
	<div id="container">
        <div id="header">
            <h1>Product Add</h1>
            <div>
                <button @click="save()">Save</button>
                <button @click="cancel()">Cancel</button>
            </div>
        </div>
        <hr>
        <div id="errors" v-if="errors.length">{{ errors }}</div>
        <form id="product_form">
            <div>
                <label for="SKU">SKU</label>
                <input type="text" id="sku" v-model="SKU" name="SKU">
            </div>
            <div>
                <label for="name">Product Name</label>
                <input type="text" id="name" v-model="name" name="name">
            </div>
            <div>
                <label for="Price">Price</label>
                <input type="text" id="price" v-model="price" name="price">
            </div>
            <div>
                <label for="ProductType">Product Type</label>
                <select v-model="selected" @change="changeFrom()" id="productType"> 
                    <option value="Book">Book</option>
                    <option value="DVD">DVD</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>
            <div>
                <label for="dimension1">Please provide the {{ measure }}</label>
                <br>
                <br>
                <input type="text" :id="measureUnit" v-model="dimension1" name="dimension1" :placeholder="measure">
            </div>
            <div v-if="selected==='Furniture'">
                <div>
                    <input type="text" id="width" v-model="dimension2" name="dimension2" placeholder="width">
                </div>
                <div>
                    <input type="text" id="lenght" v-model="dimension3" name="dimension3" placeholder="lenght">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
	export default {
        
        name: 'AddProduct',
        title: 'Product Add',
		props: {
			title: String
		},
		data: () => ({
			selected: 'Book',
            measure: 'weight',
            SKU: '',
            name: '',
            price: '',
            dimension1: '',
            dimension2: '',
            dimension3: '',
            measureUnit: 'weight',
            errors: []
		}),
		mounted() {
			
		},
        methods: {
            changeFrom() {
                console.log(this.selected);
                if(this.selected === 'Furniture') {
                    this.measure = 'dimensions';
                    this.measureUnit = 'length';
                }else if(this.selected === 'Book'){
                    this.measure = 'weight';
                    this.measureUnit = 'weight';
                }else{
                    this.measure = 'size';
                    this.measureUnit = 'size';
                }
            },
                validateForm() {
                    this.errors = [];
                    if(this.selected === 'Furniture') {
                        if(this.dimension1 === '' || this.dimension2 === '' || this.dimension3 === '') {
                            // alert('Please provide the dimensions');
                            this.errors.push('Please provide the dimensions');
                        }
                        if(!(this.isNumber(this.dimension2)) || !(this.isNumber(this.dimension3))) {
                            this.errors.push('Please, provide the data of indicated type');
                        }
                    }else if(this.selected === 'Book'){
                        if(this.dimension1 === '') {
                            this.errors.push('Please provide the weight');
                        }
                    }else{
                        if(this.dimension1 === '') {
                            this.errors.push('Please provide the size');
                        }
                    }
                    if(this.SKU === '' || this.name === '' || this.price === '') {
                        this.errors.push('Please provide the SKU, name and price');
                    }
                    if(!(this.isNumber(this.price)) || !(this.isNumber(this.dimension1))) {
                        if(!(this.errors.indexOf('Please, provide the data of indicated type') !== -1)) {
                            this.errors.push('Please, provide the data of indicated type');
                        }
                    }
                    if(!(this.isAlphaNumeric(this.SKU) || this.isAlphaNumeric(this.name))) {
                        if(!(this.errors.indexOf('Please, provide the data of indicated type') !== -1)) {
                            this.errors.push('Please, provide the data of indicated type');
                        }
                    }
                    if(this.errors.length > 0) {
                        return false;
                    }
                    return true;
                },
            save(){
                if(this.validateForm()){
                    console.log('save');
                    const formData = new FormData();
                    formData.append('SKU', this.SKU);
                    formData.append('name', this.name);
                    formData.append('price', this.price);
                    formData.append('productType', this.selected);
                    formData.append('dimension1', this.dimension1);
                    formData.append('dimension2', this.dimension2);
                    formData.append('dimension3', this.dimension3);
                    axios.post('http://juniottestapi.000webhostapp.com/product', formData)
                    .then((res) => {
                        console.log(res);
                        this.$router.push('/');
                    });
                }else{
                    console.log('not save');
                }
            },
            isNumber(value){
                return /^\d+$/.test(value);
            },
            isAlphaNumeric(value){
                return /^[ A-Za-z0-9_@./#&+-]*$/.test(value);
            },
            cancel(){
                this.$router.push('/');

            }
        }
        
	}
</script>

<style scoped>
    form {
        margin: 15px;
    }
    input{
        margin-bottom: 15px;
    }
    select {
        margin-bottom: 15px;
    }
    input[type="text"]{
        border-radius: 10px;
    }
    label{
        font-size: 20px;
        margin-right: 15px;
    }
    #errors{
        color: red;
        font-weight: bold;
        font-size: 20px;
    }
</style>
<template>
    <div class="form-search">
        <form @submit.prevent="handleSearch" >
            <div class="d-flex align-items-center ms-2">
                <i class="fa-solid fa-magnifying-glass fa-beat-fade" style="color: #080808;"></i>
                <input class="custom-input border-0 ms-2" type="search" placeholder="Nhập..." @input="debouncedSearch">
            </div>
        </form>
        <div v-if="products.length" class="search-results">
            <ul>
                <li v-for="(product, index) in products" :key="product.id" class="product-item-custom">
                    <a  :href="`/detail/${product.id}`" class="hover-product-search">
                        <div class="row box-product-search">
                            <div class="col-2"> 
                                <img :src="`/uploads/product/${product.hinh}`" alt="Product Image" class="rounded-start  product-image-custom"> 
                            </div>
                            <div class="col-10">    
                                <h5 class="ms-1">{{ product.ten_sp }}</h5>
                                <p class="ms-1 text-danger">Giá: {{ formattedPrice(product) }} đ</p>
                            </div>
                        </div> 
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import debounce from 'lodash/debounce';
import axios from 'axios';

export default {
    name: 'searchComponent',
    data() {
        return {
            searchQuery: '',
            products: [] // Lưu trữ kết quả tìm kiếm
        };
    },
    methods: {
        search() {
            if (this.searchQuery) {
                axios.get('/api/tim-kiem/' + this.searchQuery)
                    .then(response => {
                        this.products = response.data.products;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                this.products = [];
            }
        },
        formattedPrice(product) {
            const gianew = product.gia_km > 1 ? product.gia_km : product.gia;
            return new Intl.NumberFormat('vi-VN').format(gianew);
        },
        debouncedSearch: debounce(function (event) {
            this.searchQuery = event.target.value;
            this.search();
        }, 800) // Thời gian debounce là 1000ms (1 giây)
    }
};
</script>


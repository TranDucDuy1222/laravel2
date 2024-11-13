<template>
    <div>
      <h1>Sản phẩm</h1>
      <ul>
        <li v-for="product in products" :key="product.id">
          {{ product.ten_sp }} - {{ product.danh_muc.ten_dm }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['slug'], // Nhận slug từ route
    data() {
      return {
        products: [], // Mảng sản phẩm
      };
    },
    created() {
      this.fetchProducts(this.slug || 'tat-ca-san-pham');
    },
    methods: {
      fetchProducts(slug) {
        const endpoint = `/loai-san-pham/${slug}`;
        console.log(`Requesting: ${endpoint}`); // In ra URL để kiểm tra
        axios.get(endpoint)
          .then(response => {
            this.products = response.data;
          })
          .catch(error => {
            console.error('Có lỗi xảy ra:', error);
          });
      }
    },
    watch: {
      slug(newSlug) {
        this.fetchProducts(newSlug);
      }
    }
  };
  </script>
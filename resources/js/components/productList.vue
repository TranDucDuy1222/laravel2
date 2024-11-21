<template>
  <div class="mx-xl-5 mt-2 row">
    <h3 class="text-black">Bộ Lọc Sản Phẩm</h3>
    <div class="col-12 overflow-x-auto d-flex" id="box-menu-ngang">
      <!-- Danh mục -->
      <div class="menu-ngang">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Danh mục
        </p>
        <ul class="dropdown-menu"> 
          <li v-for="dm in filteredDanhMucs" :key="dm.id" class="d-flex align-items-center"> 
            <a class="w-100 d-flex align-items-center" href="#" @click.prevent="navigateToCategory(dm.slug)"> 
              <p class="text-start mb-0 ms-3 me-2">{{ dm.ten_dm }}</p> 
            </a> 
          </li> 
        </ul>
      </div>

      <!-- Màu sắc -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Màu Sắc
        </p>
        <div class="dropdown-menu">
          <div class="row p-1 justify-content-center">
            <div class="col-6 col-md-4 col-lg-3 mb-3 me-3 text-center" v-for="color in availableColors" :key="color">
              <button class="rounded-circle border" :class="colorClasses[color]" @click="selectColor(color)" style="height: 40px; width: 40px;"></button>
              <p>{{ colorNames[color] }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Kích cỡ giày -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Kích cỡ
        </p>
        <ul class="dropdown-menu">
          <div class="row p-2 justify-content-start g-1">
            <div class="col-4 col-md-3 col-lg-2 text-center " v-for="size in availableSizes" :key="size">
              <button class="rounded-5 border border-dark-subtle p-1 w-120" @click="selectSize(size)">
                {{ size }}
              </button>
            </div>
          </div>
        </ul>
      </div>
    </div>
    
    <div class="col-12">
      <!-- Sắp xếp -->
      <div class="d-flex justify-content-end">
        <div>
          <button class="btn btn-outline-secondary rounded-pill dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sắp xếp
          </button>
          <ul class="dropdown-menu">
              <li class="dropdown-item" @click="sortProducts('asc')">Giá tăng dần</li>
              <li class="dropdown-item" @click="sortProducts('desc')">Giá giảm dần</li>
              <li class="dropdown-item" @click="sortProducts('newest')">Mới Nhất</li>
          </ul>
        </div>
      </div>
      <br>
      <!-- show sản phẩm -->

      <div v-if="filteredProductsByColorAndSize.length === 0" class="alert alert-warning">
        Chưa có sản phẩm trong danh mục này.
      </div>
      <div v-else class="row">
        <div v-for="product in filteredProductsByColorAndSize" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 mb-3">
          <div class="product-short">
            <div class="product-short__container">
              <div class="card">
                <a :href="`/detail/${product.id}`" id="hover-img-home" :class="{ 'image-container': product.trang_thai === 3 }">
                  <img :src="`/uploads/product/${product.hinh}`" @error="handleImageError" style="max-height: 295px;" alt="Hình sản phẩm" class="w-100">
                  <img v-if="product.trang_thai === 3" src="/public/uploads/logo/logocs1.png" @error="handleImageError" class="overlay-image" alt="">
                </a>
                <div class="card-body">
                  <a href="" class="text-center">
                    <h5 id="hover-sp">{{ product.ten_sp }}</h5>
                  </a>
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-7 text-start">
                          <div class="d-flex align-items-center" v-if="product.trang_thai != 3">
                            <strong id="color-gia">{{ formattedPrice(product) }}đ</strong>
                            <div v-if="product.gia_km >= 1 && discountPercentage(product) > 1" class="bg-text-success text-danger ms-2" style="font-size: 10px;">
                              -{{ discountPercentage(product) }}%
                            </div>
                          </div>
                          <div v-else>
                            <a href="/lien-he" id="hover-sp">
                              <strong id="color-gia">Liên hệ</strong>
                            </a>
                          </div>
                        </div>
                        <div class="col-5 text-end">
                          <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                          <span class="pd-detail__click-count">Đã Bán ({{ product.luot_mua || 0 }})</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">{{ getDanhMucName(product.id_dm) }}</div>
                    <div class="col-12 text-truncate">
                      <span class="pd-detail__click-count" style="font-size: 12px;">
                        {{ product.mo_ta_ngan }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['slug'],
  data() {
    return {
      products: [],
      danh_mucs: [],
      selectedColor: '', // Màu sắc được chọn
      selectedSize: '', // Kích thước 
      sortOrder: 'newest', // Mặc định sắp xếp theo mới nhất
    };
  },
  computed: { 
    filteredDanhMucs() { 
      return this.danh_mucs.filter(dm => dm.slug !== this.slug); 
    },
    filteredProductsByColor() { 
      console.log("Selected Color:", this.selectedColor);  
      if (this.selectedColor) { 
        return this.products.filter(product => product.color === this.selectedColor); 
      } 
      return this.products; 
    }, 
    filteredProductsByColorAndSize() { 
      console.log("Selected Size:", this.selectedSize); 
      let filtered = this.filteredProductsByColor; 
      if (this.selectedSize) { 
        filtered = filtered.filter(
          product => product.sizes.some(size => size.size_product === this.selectedSize && size.so_luong > 0) 
        ); 
      } 
        return filtered; 
    },
    availableColors() {
      const colors = this.products.map(product => product.color);
      return [...new Set(colors)]; // Loại bỏ các màu sắc trùng lặp
    },
    availableSizes() { 
    const sizes = this.products.flatMap(product => 
        product.sizes
            .filter(size => size.so_luong > 0) // Lọc những size có so_luong lớn hơn 0
            .map(size => size.size_product)
    ); 
    return [...new Set(sizes)]; // Loại bỏ các kích thước trùng lặp
    },
    colorClasses() {
      return {
        'Đỏ': 'border-danger bg-danger',
        'Xanh': 'border-primary bg-primary',
        'Vàng': 'border-warning bg-warning',
        'Đen': 'bg-dark',
        'Trắng': 'bg-light',
        'Xám': 'border-secondary bg-secondary',
        'Hồng': 'bg-pink',
        'Xanh Lá': 'border-success bg-success',
        'Nâu':'bg-brown'
      };
    },
    colorNames() {
      return {
        'Đỏ': 'Đỏ',
        'Xanh': 'Xanh',
        'Vàng': 'Vàng',
        'Đen': 'Đen',
        'Trắng': 'Trắng',
        'Xám': 'Xám',
        'Hồng': 'Hồng',
        'Xanh Lá': 'Xanh Lá',
        'Nâu': 'Nâu'
      };
    }
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    fetchProducts() {
      axios.get(`/api/danh-muc-san-pham/${this.slug}`)
        .then(response => {
          this.products = response.data.list_product;
          this.danh_mucs = response.data.danh_mucs;
          this.sortProducts(this.sortOrder); 
        })
        .catch(error => {
          console.error("Đã xảy ra lỗi khi lấy dữ liệu:", error);
        });
    },
    sortProducts(order) {
      this.sortOrder = order;
      if (order === 'asc') {
        this.products.sort((a, b) => {
          const priceA = a.gia_km >= 1 ? a.gia_km : a.gia;
          const priceB = b.gia_km >= 1 ? b.gia_km : b.gia;
          return priceA - priceB;
        });
      } else if (order === 'desc') {
        this.products.sort((a, b) => {
          const priceA = a.gia_km >= 1 ? a.gia_km : a.gia;
          const priceB = b.gia_km >= 1 ? b.gia_km : b.gia;
          return priceB - priceA;
        });
      } else if (order === 'newest') {
        this.products.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
      }
      console.log("Sorted Products:", this.products); // Debug: Kiểm tra sản phẩm đã sắp xếp
    },
    selectColor(color) {
      this.selectedColor = color;
    },
    selectSize(size) {
      this.selectedSize = size;
    },
    formattedPrice(product) {
      const gianew = product.gia_km > 0 ? product.gia_km : product.gia;
      return new Intl.NumberFormat('vi-VN').format(gianew);
    },
    discountPercentage(product) {
      if (product.gia_km >= 1) {
        return Math.round(((product.gia - product.gia_km) / product.gia) * 100);
      }
      return 0;
    },
    handleImageError(event) {
      event.target.src = '/public/uploads/logo/logocs1.png';
    },
    getDanhMucName(id_dm) { 
      const danhMuc = this.danh_mucs.find(dm => dm.id === id_dm); 
      return danhMuc ? danhMuc.ten_dm : 'Unknown';
    },
    navigateToCategory(slug) { 
      window.location.href = `/danh-muc-san-pham/${slug}`;
    },
  }
};
</script>





<style scoped>
  .bg-brown{
    color: brown;
    background-color: brown;
  }
  .bg-pink{
    color: pink;
    background-color: pink;
  }
</style>

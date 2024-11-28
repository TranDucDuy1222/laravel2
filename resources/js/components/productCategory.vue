<template>
  <div class="mx-xl-5 mt-2 row">
    <h3 class="text-black my-2">Bộ Lọc Sản Phẩm</h3>
    <div class="col-12 overflow-x-auto d-flex">
      <!-- Danh mục -->
      <div class="mx-1 menu-ngang">
        <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Danh mục
        </p>
        <ul class="dropdown-menu">
          <li v-for="dm in filteredDanhMucs" :key="dm.id" class="d-flex align-items-center">
            <a class="w-100 d-flex align-items-center" :href="`/danh-muc-san-pham/${dm.slug}`">
              <p class="text-start mb-0 ms-3 me-2">{{ dm.ten_dm }}</p>
            </a>
          </li>
        </ul>
      </div>

      <!-- Màu sắc -->
      <div class="mx-1">
        <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Màu Sắc
        </p>
        <div class="dropdown-menu">
          <div class="row p-1 justify-content-center">
            <div class="col-6 col-md-4 col-lg-3 mb-3 me-3 text-center" v-for="color in availableColors" :key="color">
              <button class="rounded-circle border" :class="colorClasses[color]" @click="selectColor(color)"
                style="height: 40px; width: 40px;"></button>
              <p>{{ colorNames[color] }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Kích cỡ -->
      <div class="mx-1" v-if="shoeSizesList.length > 0">
          <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kích cỡ giày
          </p>
          <ul class="dropdown-menu">
              <div class="row p-1 justify-content-start g-1" style="width: 210px;">
                  <div class="col-4 text-center" v-for="size in shoeSizesList" :key="size">
                      <button class="custom-button-size" @click="selectSize(size)">
                          {{ size }}
                      </button>
                  </div>
              </div>
          </ul>
      </div>
      <div class="mx-1" v-if="clothingSizesList.length > 0">
          <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kích cỡ quần áo
          </p>
          <ul class="dropdown-menu">
              <div class="row p-1 justify-content-start g-1" style="width: 210px;">
                  <div class="col-4 text-center" v-for="size in clothingSizesList" :key="size">
                      <button class="custom-button-size" @click="selectSize(size)">
                          {{ size }}
                      </button>
                  </div>
              </div>
          </ul>
      </div>
      <div class="mx-1" v-if="accessorySizesList.length > 0">
          <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kích cỡ phụ kiện
          </p>
          <ul class="dropdown-menu">
              <div class="row p-1 justify-content-start g-1" style="width: 210px;">
                  <div class="col-4 text-center" v-for="size in accessorySizesList" :key="size">
                      <button class="custom-button-size" @click="selectSize(size)">
                          {{ size }}
                      </button>
                  </div>
              </div>
          </ul>
      </div>
    </div>

    <div v-if="selectedColor || selectedSize" class="col-12 text-dark">
      <h4 class="my-md-2">Đang lọc theo </h4>
      <div class="d-flex">
        <p v-if="selectedColor" @click="removeColorFilter" class="btn btn-outline-danger mx-1 rounded-3 p-1">
          <i class="fa-solid fa-xmark"></i> Màu : {{ selectedColor }}
        </p>
        <p v-if="selectedSize" @click="removeSizeFilter" class="btn btn-outline-danger mx-1 rounded-3 p-1">
          <i class="fa-solid fa-xmark"></i> Kích cở : {{ selectedSize }}
        </p>
      </div>
    </div>
    <div class="col-12 ">
      <!-- Sắp xếp -->
      <h3 class="text-dark my-2">Sắp xếp theo</h3>
      <div class="overflow-x-auto ">
        <div class="d-flex">
          <p @click="sortProducts('newest')"
            :class="{ 'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true, 'bg-danger text-white': sortOrder === 'newest' }">
            Mới nhất
          </p>
          <p @click="sortProducts('desc')"
            :class="{ 'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true, 'bg-danger text-white': sortOrder === 'desc' }">
            Giá giảm dần
          </p>
          <p @click="sortProducts('asc')"
            :class="{ 'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true, 'bg-danger text-white': sortOrder === 'asc' }">
            Giá tăng dần
          </p>
          <p @click="sortProducts('sold')"
            :class="{ 'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true, 'bg-danger text-white': sortOrder === 'sold' }">
            Đã bán
          </p>
        </div>
      </div>
      <br>
      <!-- show sản phẩm -->
      <div v-if="filteredProductsByColorAndSize.length === 0" class="alert alert-warning">
        Chưa có sản phẩm trong danh mục này.
      </div>
      <div v-else class="row">
        <div v-for="product in filteredProductsByColorAndSize" :key="product.id"
          class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3 ">
          <div class="product-short">
            <div :class="['product-short__container', { 'out-stock': product.trang_thai === 1 }]">
              <div class="card">
                <a :href="`/detail/${product.id}`" id="hover-img-home"
                  :class="{ 'image-container': product.trang_thai === 2 }" class="d-flex justify-content-center align-content-center">
                  <img :src="`/uploads/product/${product.hinh}`" @error="handleImageError" style="max-height: 295px;"
                    alt="Hình sản phẩm" class="img-fluid ">
                  <img v-if="product.trang_thai === 2" src="/public/uploads/logo/logocs1.png" @error="handleImageError"
                    class="overlay-image" alt="">
                  <img v-if="product.trang_thai != 2 && product.gia_km >= 1" src="/public/uploads/logo/sale.png"
                    @error="handleImageError" class="img-sale" alt="">
                </a>
                <div class="card-body">
                  <a href="" class="text-center">
                    <h5 id="hover-sp" class="text-truncate">{{ product.ten_sp }}</h5>
                  </a>
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-sm-7 col-12 text-start">
                          <div class="d-flex align-items-center" v-if="product.trang_thai != 2">
                            <strong id="color-gia">{{ formattedPrice(product) }}đ</strong>
                            <div v-if="product.gia_km >= 1 && discountPercentage(product) > 1"
                              class="bg-text-success text-danger ms-2" style="font-size: 10px;">
                              -{{ discountPercentage(product) }}%
                            </div>
                          </div>
                          <div v-else>
                            <a href="/lien-he" id="hover-sp">
                              <strong id="color-gia">Liên hệ</strong>
                            </a>
                          </div>
                        </div>
                        <div class="col-sm-5 col-12 text-start text-sm-end">
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
      sizes: {
        accessory: ['S/M', 'M/L', 'L/XL'],
        clothing: ['S', 'M', 'L','XL'],
      }
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
      const sizes = this.products.flatMap(product => product.sizes.filter(size => size.so_luong > 0).map(size => size.size_product)); 
      return [...new Set(sizes)]; 
    }, 
    accessorySizesList() { 
      return this.availableSizes.filter(size => this.sizes.accessory.includes(size)); 
    }, 
    clothingSizesList() { 
      return this.availableSizes.filter(size => this.sizes.clothing.includes(size)); 
    }, 
    shoeSizesList() { 
      return this.availableSizes.filter(size => !this.sizes.accessory.includes(size) && !this.sizes.clothing.includes(size)); 
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
        'Nâu': 'bg-brown'
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
      axios.get(`/api/loai-san-pham/${this.slug}`)
        .then(response => {
          this.products = response.data.list_product;
          this.danh_mucs = response.data.danh_mucs;
          this.sortProducts(this.sortOrder);
        })
        .catch(error => {
          console.error("Đã xảy ra lỗi khi lấy dữ liệu:", error);
        });
    },
    handleSortChange(event) { 
      const order = event.target.value; this.sortProducts(order); 
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
      } else if (order === 'sold') {
        this.products.sort((a, b) => b.luot_mua - a.luot_mua);
      }
      console.log("Sorted Products:", this.products); // Debug: Kiểm tra sản phẩm đã sắp xếp
    },
    selectColor(color) {
      this.selectedColor = color;
    },
    selectSize(size) {
      this.selectedSize = size;
    },
    removeColorFilter() {
      this.selectedColor = '';
    },
    removeSizeFilter() {
      this.selectedSize = '';
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
  }
};
</script>

<style scoped>
.bg-brown {
  color: brown;
  background-color: brown;
}

.bg-pink {
  color: pink;
  background-color: pink;
}
</style>
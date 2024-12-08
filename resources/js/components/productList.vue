<template>
  <div class="mx-xl-5 mt-2 row">
    <h3 class="text-black my-md-2">Bộ Lọc Sản Phẩm</h3>
    <div class="col-12 overflow-x-auto d-flex" id="box-menu-ngang">
      <!-- Danh mục -->
      <div class="menu-ngang">
        <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button"
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
        <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <p class="btn btn-outline-secondary p-1 rounded-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Kích cỡ
        </p>
        <ul class="dropdown-menu" >
          <div class="row p-1 justify-content-start g-1" style="width: 210px;">
            <div class="col-4 text-center" v-for="size in availableSizes" :key="size">
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
    <div class="col-12">
      <!-- Sắp xếp -->
      <h3 class="text-dark my-2">Sắp xếp theo</h3>
      <div class="overflow-x-auto " >
        <div class="d-flex">
            <p @click="sortProducts('newest')" 
            :class="{'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true,  'bg-danger text-white': sortOrder === 'newest'}">
                Mới nhất
            </p>
            <p @click="sortProducts('desc')" 
            :class="{'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true,  'bg-danger text-white': sortOrder === 'desc'}">
                Giá giảm dần
            </p>
            <p @click="sortProducts('asc')" 
            :class="{'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true,  'bg-danger text-white': sortOrder === 'asc'}">
                Giá tăng dần
            </p>
            <p @click="sortProducts('sold')" 
            :class="{'border border-dark-subtle text-dark p-1 rounded-3 menu-ngang mx-1 ': true,  'bg-danger text-white': sortOrder === 'sold'}">
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
        <div v-for="product in paginatedProducts" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
          <div class="product-short">
            <div :class="['product-short__container', { 'out-stock': product.trang_thai === 1 }]">
              <div class="card">
                <a :href="`/detail/${product.id}`" id="hover-img-home" :class="{ 'image-container': product.trang_thai === 2 }">
                  <img :src="`/uploads/product/${product.hinh}`" @error="handleImageError" style="max-height: 295px;" alt="Hình sản phẩm" class="w-100">
                  <img v-if="product.trang_thai === 2" src="/public/uploads/logo/logocs1.png" @error="handleImageError" class="overlay-image" alt="">
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
      <!-- Pagination -->
      <nav aria-label="Page navigation example" v-if="shouldShowPagination">
        <ul class="pagination justify-content-center">
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">Previous</a>
          </li>
          <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: page === currentPage }">
            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
          </li>
          <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">Next</a>
          </li>
        </ul>
      </nav>
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
      currentPage: 1, // Trang hiện tại
      itemsPerPage: 12, // Số lượng sản phẩm mỗi trang
      totalPages: 0, // Tổng số trang
    };
  },
  computed: { 
    filteredDanhMucs() { 
      return this.danh_mucs.filter(dm => dm.slug !== this.slug); 
    },
    filteredProductsByColor() {  
      if (this.selectedColor) { 
        return this.products.filter(product => product.color === this.selectedColor); 
      } 
      return this.products; 
    }, 
    filteredProductsByColorAndSize() { 
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
        'Nâu':'bg-brown',
        'Be' : 'bg-be',
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
        'Nâu': 'Nâu',
        'Be' : 'Be',
      };
    },
    paginatedProducts() {
      console.log(`Current Page: ${this.currentPage}`);
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      console.log(`Displaying products from ${start} to ${end}`);
      return this.filteredProductsByColorAndSize.slice(start, end);
    },
    shouldShowPagination() { 
      return this.filteredProductsByColorAndSize.length > this.itemsPerPage; 
    }
  },
  mounted() {
    this.fetchProducts();
    console.log("Received slug: ", this.slug);
  },
  methods: {
    fetchProducts() {
      axios.get(`/api/danh-muc-san-pham/${this.slug}`)
        .then(response => {
          this.products = response.data.list_product;
          this.danh_mucs = response.data.danh_mucs;
          this.totalPages = Math.ceil(this.products.length / this.itemsPerPage);
          this.sortProducts(this.sortOrder); 
        })
        .catch(error => {
          //console.error("Đã xảy ra lỗi khi lấy dữ liệu:", error);
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
      } else if (order === 'sold') {
            this.products.sort((a, b) => b.luot_mua - a.luot_mua);
      }
    },
    selectColor(color) {
      this.selectedColor = color;
      this.currentPage = 1;
    },
    selectSize(size) {
      this.selectedSize = size;
      this.currentPage = 1;
    },
    removeColorFilter() { 
      this.selectedColor = ''; 
      this.currentPage = 1;
    }, 
    removeSizeFilter() { 
      this.selectedSize = '';
      this.currentPage = 1; 
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
    changePage(page) {
      if (page >= 1 && page <= this.totalPages) {
        console.log(`Changing to page: ${page}`);
        this.currentPage = page;
      }
    }
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
  .bg-be{
    color: antiquewhite;
    background-color:  antiquewhite;
  }
</style>

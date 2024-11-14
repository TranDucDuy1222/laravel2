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
        <!-- Hiển thị danh sách danh mục --> 
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
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Màu Sắc
        </p>
        <div class="dropdown-menu">
          <div class="row p-1 justify-content-center">
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-danger bg-danger" style="height: 40px; width: 40px;"></button>
              <p>Đỏ</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-primary bg-primary" style="height: 40px; width: 40px;"></button>
              <p>Xanh</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-warning bg-warning" style="height: 40px; width: 40px;"></button>
              <p>Vàng</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle bg-dark" style="height: 40px; width: 40px;"></button>
              <p>Đen</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border bg-light" style="height: 40px; width: 40px;"></button>
              <p>Trắng</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-secondary bg-secondary" style="height: 40px; width: 40px;"></button>
              <p>Xám</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border bgpink" style="height: 40px; width: 40px;"></button>
              <p>Hồng</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-success bg-success" style="height: 40px; width: 40px;"></button>
              <p>Xanh Lá</p>
            </div>
          </div>
        </div>
        
      </div>
      <!-- Kích cở giày -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Kích cở giày
        </p>
        <ul class="dropdown-menu"> 
          <div class="row p-1 justify-content-start g-1"> 
            <div class="col-4 col-md-3 col-lg-2 text-center"> 
              <button class="border w-100"> 37.5 </button> 
            </div> 
            <div class="col-4 col-md-3 col-lg-2 text-center"> 
              <button class="border w-100"> 37 </button> 
            </div> 
            <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> 
          </div> 
        </ul>
      </div>
      <!-- Kích cở quần áo -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Kích cở quần áo
        </p>
        <ul class="dropdown-menu ">
          <div class="row p-1 justify-content-center g-1">
            <div class="col-6 col-md-3 col-lg-2 text-center" style="width: 35px;"> <button class="border w-100"> S </button> </div> 
            <div class="col-6 col-md-3 col-lg-2 text-center" style="width: 35px;"> <button class="border w-100"> M </button> </div> 
            <div class="col-6 col-md-3 col-lg-2 text-center" style="width: 35px;"> <button class="border w-100"> L </button> </div> 
            <div class="col-6 col-md-3 col-lg-2 text-center" style="width: 35px;"> <button class="border w-100"> XL </button> </div>           
          </div>
        </ul>
      </div>
    </div>
    <div class="col-12">
      <!-- Sắp xếp -->
      <div class="d-flex justify-content-end">
        <div class="">
          <button class="btn btn-outline-secondary rounded-pill dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Sắp xếp
          </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item">Giá tăng dần</li>
            <li class="dropdown-item">Giá giảm dần</li>
            <li class="dropdown-item">Mới Nhất</li>
          </ul>
        </div>
      </div>
      <br>
      <!-- show sản phẩm -->
      <div>
    <div v-if="products.length === 0" class="alert alert-warning">
      Chưa có sản phẩm trong danh mục này.
    </div>
    <div v-else class="row">
      <div v-for="product in products" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 mb-3">
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
  </div>
</template>
<script>
import axios from 'axios';

export default {
  props: ['slug'],
  data() {
    return {
      products: [], // Khởi tạo mảng sản phẩm rỗng
      danh_mucs: [] // Khởi tạo mảng danh mục rỗng
    };
  },
  computed: { 
    filteredDanhMucs() { 
      return this.danh_mucs.filter(dm => dm.slug !== this.slug); 
    } 
  },
  mounted() {
    // Gửi yêu cầu AJAX để lấy dữ liệu JSON từ controller với slug được truyền vào
    axios.get(`/api/danh-muc-san-pham/${this.slug}`)
      .then(response => {
        this.products = response.data.list_product;
        this.danh_mucs = response.data.danh_mucs;
        console.log(this.products);
      })
      .catch(error => {
        console.error("Đã xảy ra lỗi khi lấy dữ liệu:", error);
      });
  },
  methods: {
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
/* Thêm CSS cho component nếu cần */
</style>

<template>
  <div>
    <div v-if="products.length === 0" class="alert alert-warning">
      Chưa có sản phẩm trong danh mục này.
    </div>
    <div v-else class="row">
      <div v-for="product in products" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 mb-3">
        <div class="product-short">
          <div class="product-short__container">
            <div class="card">
              <a :href="`/product/${product.id}`" id="hover-img-home" :class="{ 'image-container': product.trang_thai === 3 }">
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
    }
  }
};
</script>

<style scoped>
/* Thêm CSS cho component nếu cần */
</style>

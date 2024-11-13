<template>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
      <div class="product-short">
        <div class="product-short__container">
          <div class="card">
            <a :href="`/product/${product.id}`" id="hover-img-home">
              <img :src="`/uploads/product/${product.hinh}`"
                   @error="handleImageError"
                   style="max-height: 295px;" alt="" class="w-100">
              <img v-if="product.trang_thai === 3" src="/public/uploads/logo/logocs1.png"
                   @error="handleImageError"
                   class="overlay-image" alt="">
            </a>
            <div class="card-body">
              <a href="" class="text-center">
                <h5 id="hover-sp">{{ product.ten_sp }}</h5>
              </a>
              <div class="row">
                <div class="col-12">
                  <div class="row">
                    <div class="col-7 text-start">
                      <div class="d-flex align-items-center">
                        <strong id="color-gia">{{ gia }}đ</strong>
                        <div v-if="product.gia_km >= 1 && discountPercentage > 1"
                             class="bg-text-success text-danger ms-2" style="font-size: 10px;">
                          -{{ discountPercentage }}%
                        </div>
                      </div>
                    </div>
                    <div class="col-5 text-end">
                      <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                      <span class="pd-detail__click-count">Đã Bán ({{ product.luot_mua || 0 }})</span>
                    </div>
                  </div>
                </div>
                <div class="col-12">{{ product.danhMuc.ten_dm }}</div>
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
  </template>
  
  <script>
  export default {
    props: ['product'],
    computed: {
      gia() {
        return new Intl.NumberFormat('vi-VN').format(this.product.gia_km > 0 ? this.product.gia_km : this.product.gia);
      },
      discountPercentage() {
        if (this.product.gia_km >= 1) {
          return Math.round(((this.product.gia - this.product.gia_km) / this.product.gia) * 100);
        }
        return 0;
      }
    },
    methods: {
      handleImageError(event) {
        event.target.src = 'public/uploads/logo/logocs1.png';
      }
    }
  };
  </script>
  
  <style scoped>
  /* Thêm CSS cho component nếu cần */
  </style>
  
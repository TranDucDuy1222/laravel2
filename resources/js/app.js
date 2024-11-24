import { createApp } from 'vue';
import AddressForm from './components/AddressForm.vue';
import ProductList from './components/productList.vue';
import productCategory from './components/productCategory.vue';
import SearchComponent from './components/search.vue';

// Tạo ứng dụng cho AddressForm
const appAddDC = createApp({
    components: {
        'address-form': AddressForm,
    }
});
appAddDC.mount('#appAddDC');

// Tạo ứng dụng cho ProductList với slug từ URL
const urlParams = new URLSearchParams(window.location.search);

// Danh mục sản phẩm
const slug_list = urlParams.get('slug');
const productListApp = createApp({
    data() {
        return {
            slug: slug_list
        };
    },
    components: {
        'product-list': ProductList
    }
});
productListApp.mount('#product_list');

// Tất cả sản phẩm và giảm giá
const slug_category = urlParams.get('slug');
const productCategoryApp = createApp({
    data() {
        return {
            slug: slug_category
        };
    },
    components: {
        'product-category': productCategory
    }
});
productCategoryApp.mount('#product_category');

// Tất cả sản phẩm và giảm giá
const slug_search = urlParams.get('slug');
const searchapp = createApp({
    // data() {
    //     return {
    //         slug: slug_search
    //     };
    // },
    components: {
        'search-component': SearchComponent
    }
});
searchapp.mount('#searchApp');

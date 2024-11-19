import { createApp } from 'vue';
import AddressForm from './components/AddressForm.vue';
import ProductList from './components/productList.vue';

// Tạo ứng dụng cho AddressForm
const appAddDC = createApp({
    components: {
        'address-form': AddressForm,
    }
});
appAddDC.mount('#appAddDC');

// Tạo ứng dụng cho ProductList với slug từ URL
const urlParams = new URLSearchParams(window.location.search);
const slug = urlParams.get('slug') || 'tat-ca-san-pham';

const productListApp = createApp({
    data() {
        return {
            slug: slug
        };
    },
    components: {
        'product-list': ProductList
    }
});
productListApp.mount('#product_list');

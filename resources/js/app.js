import './bootstrap';
import { createApp } from 'vue';
import AddressForm from './components/AddressForm.vue';
import Productvue from './components/Products.vue';
import router from './router'; // Đảm bảo đường dẫn chính xác đến file router.js

const app = createApp({
    components: {
        'address-form': AddressForm,
        'show-product': Productvue
    }
});

app.use(router);
app.mount('#appAddDC');

const show_product = createApp({});
show_product.use(router);
show_product.component('show-product', Productvue);
show_product.mount('#show_product');
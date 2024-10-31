import './bootstrap';
import { createApp } from 'vue';
import AddressForm from './components/AddressForm.vue';

const app = createApp({
    components: {
        'address-form': AddressForm
    }
});

app.mount('#appAddDC');

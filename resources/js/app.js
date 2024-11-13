import './bootstrap';
import { createApp } from 'vue';
import AddressForm from './components/AddressForm.vue';
import axios from 'axios';

const app = createApp({
    components: {
        'address-form': AddressForm
    }
});

app.mount('#appAddDC');

import { createApp } from 'vue';
import AddressForm from './components/AddressForm.vue';
import ProductList from './components/productList.vue';
import ProductCategory from './components/productCategory.vue';
import SearchComponent from './components/search.vue';

document.addEventListener("DOMContentLoaded", function() {
    // Tạo ứng dụng cho AddressForm
    const appAddDC = document.getElementById('appAddDC');
    if (appAddDC) {
        const addressFormApp = createApp({
            components: {
                'address-form': AddressForm,
            }
        });
        addressFormApp.mount('#appAddDC');
    }

    // Tạo ứng dụng cho ProductList với slug từ URL
    const productListElement = document.getElementById('product_list');
    if (productListElement) {
        const urlParams = new URLSearchParams(window.location.search);
        let slug_list = urlParams.get('slug');
        if (!slug_list) { 
            slug_list = 'default-slug';
        }
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
    }

    // Tạo ứng dụng cho ProductCategory
    const productCategoryElement = document.getElementById('product_category');
    if (productCategoryElement) {
        const urlParams = new URLSearchParams(window.location.search);
        const slug_category = urlParams.get('slug');
        const productCategoryApp = createApp({
            data() {
                return {
                    slug: slug_category
                };
            },
            components: {
                'product-category': ProductCategory
            }
        });
        productCategoryApp.mount('#product_category');
    }

    // Tạo ứng dụng cho SearchComponent
    const searchAppElement = document.getElementById('searchApp');
    if (searchAppElement) {
        const searchApp = createApp({
            components: {
                'search-component': SearchComponent
            }
        });
        searchApp.mount('#searchApp');
    }
});

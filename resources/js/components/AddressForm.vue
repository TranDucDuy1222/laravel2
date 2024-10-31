<template>
    <div>
        <div class="form-group">
            <label for="inputCity">Tỉnh / Thành Phố</label>
            <select class="form-control" v-model="tinhtp" @change="updateDistricts">
                <option v-for="tinh in dsTinh" :key="tinh.ID" :value="tinh">
                    {{ tinh.Name }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputDistrict">Quận / Huyện</label>
            <select class="form-control" v-model="quanhuyen" v-if="tinhtp && tinhtp.Districts">
                <option v-for="quan in tinhtp.Districts" :key="quan.ID" :value="quan">
                    {{ quan.Name }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputWard">Phường / Xã</label>
            <select class="form-control" v-model="phuongxa" v-if="quanhuyen && quanhuyen.Wards">
                <option v-for="px in quanhuyen.Wards" :key="px.ID" :value="px">
                    {{ px.Name }}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputAddress">Địa Chỉ Cụ Thể</label>
            <input type="text" v-if="phuongxa" v-model="address" class="form-control" id="inputAddress" name="diachichitiet">
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dsTinh: [],
            tinhtp: null,
            quanhuyen: null,
            phuongxa: null,
            address: '',
            ho_ten: '',
            phone: ''
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/FE/JS/data.js') // Cập nhật đường dẫn
                .then(res => {
                    this.dsTinh = res.data;
                })
                .catch(err => {
                    console.log('Không tải được dữ liệu về địa chỉ');
                });
        },
        updateDistricts() {
            this.quanhuyen = null;
            this.phuongxa = null;
        }
    },
    watch: {
        tinhtp(newVal) {
            if (newVal && newVal.Districts) {
                this.quanhuyen = newVal.Districts[0];
            }
        },
        quanhuyen(newVal) {
            if (newVal && newVal.Wards) {
                this.phuongxa = newVal.Wards[0];
            }
        }
    }
};
</script>

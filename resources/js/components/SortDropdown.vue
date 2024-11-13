<template>
  <div class="d-flex justify-content-end">
    <div class="">
      <button @click="toggleDropdown" class="btn btn-outline-secondary rounded-pill dropdown-toggle" role="button">
        Sắp xếp
      </button>
      <ul v-if="isOpen" class="dropdown-menu">
        <li class="dropdown-item" id="new" @click="sort('new')">Mới Nhất</li>
        <li class="dropdown-item" id="tang_dan" @click="sort('tang_dan')">Giá tăng dần</li>
        <li class="dropdown-item" id="giam_dan" @click="sort('giam_dan')">Giá giảm dần</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  slug: {
    type: String,
    required: true
  }
});

const emit = defineEmits(['sort']);

const isOpen = ref(false);

function toggleDropdown() {
  isOpen.value = !isOpen.value;
}

function sort(order) {
  emit('sort', { order, slug: props.slug });
  toggleDropdown();
}
</script>

<style scoped>
.dropdown-menu {
  display: block;
}
</style>

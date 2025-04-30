<script setup>
import { ref } from "vue";

const message = ref("This is an Inertia App.");
</script>

<template>
  <h1>Hello World!</h1>
  <div class="bg-red-500">{{ message }}</div>
</template>

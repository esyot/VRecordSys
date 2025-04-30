<script setup>
import { ref, onMounted, onBeforeUnmount, defineProps } from "vue";

import { Link } from "@inertiajs/vue3";

defineProps({
  user: Object,
});

const isMobileMenuOpen = ref(false);
const isUserMenuOpen = ref(false);
const isMobileUserMenuOpen = ref(false);

const desktopMenuRef = ref(null);
const mobileMenuRef = ref(null);

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const toggleUserMenu = () => {
  isUserMenuOpen.value = !isUserMenuOpen.value;
};

const toggleMobileUserMenu = () => {
  isMobileUserMenuOpen.value = !isMobileUserMenuOpen.value;
};

const handleClickOutside = (event) => {
  if (desktopMenuRef.value && !desktopMenuRef.value.contains(event.target)) {
    isUserMenuOpen.value = false;
  }

  if (mobileMenuRef.value && !mobileMenuRef.value.contains(event.target)) {
    isMobileUserMenuOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside);
});
</script>

<template>
  <header class="bg-white shadow-md relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex-shrink-0 text-xl font-semibold text-gray-800">V-Record</div>

        <nav class="hidden md:flex space-x-6 text-gray-700">
          <Link href="/" class="hover:text-blue-600">Home</Link>
          <Link href="/about" class="hover:text-blue-600">About</Link>
        </nav>

        <div class="hidden md:block relative" ref="desktopMenuRef">
          <button
            @click="toggleUserMenu"
            class="text-gray-700 font-medium focus:outline-none"
          >
            Hello, {{ user.name }}
          </button>

          <div
            v-show="isUserMenuOpen"
            class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md z-20"
          >
            <Link
              href="/logout"
              class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"
              >Logout</Link
            >
          </div>
        </div>

        <div class="md:hidden">
          <button @click="toggleMobileMenu" class="text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div v-show="isMobileMenuOpen" class="md:hidden px-4 pb-4 space-y-2">
      <a href="/" class="block text-gray-700 hover:text-blue-600">Home</a>
      <a href="/about" class="block text-gray-700 hover:text-blue-600">About</a>

      <div class="relative" ref="mobileMenuRef">
        <button
          @click="toggleMobileUserMenu"
          class="w-full text-left text-gray-700 font-medium focus:outline-none"
        >
          Hello, {{ user.name }}
        </button>

        <div
          v-show="isMobileUserMenuOpen"
          class="mt-2 w-full bg-white shadow rounded-md py-2"
        >
          <Link href="/logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
            >Logout</Link
          >
        </div>
      </div>
    </div>
  </header>

  <slot></slot>
</template>

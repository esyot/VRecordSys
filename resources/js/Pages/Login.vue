<script setup>
import { ref, defineProps } from "vue";
import AboutModal from "@/Modals/AboutModal.vue";
import Login from "@/Components/Login.vue";
import SignUp from "@/Components/SignUp.vue";
import { useToast } from "vue-toastification";

const isOpenAboutModal = ref(false);

const toggleAboutModal = () => {
  isOpenAboutModal.value = !isOpenAboutModal.value;
};

const props = defineProps({
  success: String,
});

if (props.success) {
  const toast = useToast();
  toast.success(props.success, {
    position: "top-right",
    duration: 3000,
  });
}
const selectedType = ref("login");

const selectType = (action) => {
  selectedType.value = action;
};
</script>

<template>
  <AboutModal v-if="isOpenAboutModal" @toggleAboutModal="toggleAboutModal"></AboutModal>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded shadow-md p-8 mx-4">
      <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
      <h3 class="text-center">
        Welcome to <strong>V-Record</strong>!
        <i
          @mouseover="toggleAboutModal"
          class="fas fa-circle-info fa-sm hover:opacity-50 cursor-pointer text-gray-500"
        ></i>
      </h3>
      <div class="flex justify-center">
        <button
          @click="selectType('login')"
          :class="
            selectedType === 'login'
              ? 'px-4 py-2 border hover:opacity-50 text-blue-500 '
              : 'px-4 py-2 border hover:opacity-50 opacity-20'
          "
        >
          Login
        </button>
        <button
          @click="selectType('signup')"
          :class="
            selectedType === 'signup'
              ? 'px-4 py-2 border hover:opacity-50 text-blue-500 '
              : 'px-4 py-2 border hover:opacity-50 opacity-20'
          "
        >
          Sign-Up
        </button>
      </div>
      <Login v-if="selectedType === 'login'"></Login>

      <SignUp v-if="selectedType === 'signup'"></SignUp>
    </div>
  </div>
</template>

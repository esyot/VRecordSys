<script setup>
import { useForm } from "@inertiajs/vue3";
import AboutModal from "@/Modals/AboutModal.vue";
import { ref } from "vue";
import { useToast } from "vue-toastification";

const form = useForm({
  email: "",
  password: "",
});

const isOpenAboutModal = ref(false);

const toggleAboutModal = () => {
  isOpenAboutModal.value = !isOpenAboutModal.value;
};

function submit() {
  const toast = useToast();

  form.post("/login/submit", {
    onSuccess: () => {
      toast.success("You are logged in successfully!", {
        position: "top-right",
        duration: 3000,
      });
    },
    onError: () => {
      toast.error(
        "There was an error logging in with your credentials, please check correctly!",
        {
          position: "top-right",
          duration: 3000,
        }
      );
    },
  });
}
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
          class="fas fa-circle-info hover:opacity-50 cursor-pointer text-gray-500"
        ></i>
      </h3>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1" for="email"
            >Email</label
          >
          <input
            v-model="form.email"
            placeholder="Input email"
            type="email"
            id="email"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200"
            required
            autofocus
          />
        </div>

        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1" for="password"
            >Password</label
          >
          <input
            v-model="form.password"
            type="password"
            placeholder="Input password"
            id="password"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
        >
          Log In
        </button>
      </form>
    </div>
  </div>
</template>

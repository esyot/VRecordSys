<script setup>
import { useToast } from "vue-toastification";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "",
  password: "",
});

function submit() {
  const toast = useToast();

  form.post("/login/submit", {
    onSuccess: () => {
      toast.success("You are successfully logged in!", {
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

      <i class="text-red-500" v-if="$page.props.errors">{{ $page.props.errors.email }}</i>
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

      <i class="text-red-500" v-if="$page.props.errors">{{
        $page.props.errors.password
      }}</i>
    </div>

    <button
      type="submit"
      class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
    >
      Log In
    </button>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const form = useForm({
  name: "",
  email: "",
  password_1: "",
  password_2: "",
});

const submit = () => {
  const toast = useToast();

  form.post("/signup/submit", {
    onError: () => {
      toast.error(
        "There was an error with your submission, please check the fields correctly."
      );
    },
  });
};
</script>

<template>
  <form @submit.prevent="submit">
    <div class="mb-4">
      <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Name</label>
      <input
        v-model="form.name"
        placeholder="Input name"
        type="text"
        id="name"
        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200"
        autofocus
      />
      <i class="text-red-500" v-if="$page.props.errors">{{ $page.props.errors.name }}</i>
    </div>
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
        autofocus
      />
      <i class="text-red-500" v-if="$page.props.errors">{{ $page.props.errors.email }}</i>
    </div>

    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1" for="password_1"
        >Password</label
      >
      <input
        v-model="form.password_1"
        type="password"
        placeholder="Input password"
        id="password_1"
        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200"
      />
      <i class="text-red-500" v-if="$page.props.errors">{{
        $page.props.errors.password_1
      }}</i>
    </div>

    <div class="mb-6">
      <label class="block text-sm font-medium text-gray-700 mb-1" for="password"
        >Re-Type Password</label
      >
      <input
        v-model="form.password_2"
        type="password"
        placeholder="Input password"
        id="password_2"
        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200"
      />
      <i class="text-red-500" v-if="$page.props.errors">{{
        $page.props.errors.password_2
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

<script setup>
import { defineEmits, defineProps } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const emit = defineEmits(["toggleAddVehicleModal"]);

const closeModal = () => {
  emit("toggleAddVehicleModal");
};

const form = useForm({
  plate_no: "",
  type: "",
});

const submitForm = () => {
  const toast = useToast();
  form.post("/vehicle/submit", {
    onSuccess: (response) => {
      toast.success(response.props.success, {
        position: "top-right",
        duration: 3000,
      });

      closeModal();
    },
    onError: () => {
      toast.error("There was an error during submission, please check the fields.");
    },
  });
};
</script>

<template>
  <div
    @click.self="closeModal"
    class="flex fixed justify-center items-center inset-0 bg-gray-800 bg-opacity-50"
  >
    <form
      @submit.prevent="submitForm"
      class="bg-white rounded-lg w-full max-w-md border-t-4 border-blue-500 mx-2"
    >
      <div class="flex justify-between space-x-4 items-center border-b-2 rounded-t p-2">
        <h1 class="text-xl font-bold">Add Record</h1>
        <i
          @click="closeModal"
          class="fas fa-circle-xmark text-red-500 hover:opacity-50 hover:cursor-pointer"
        ></i>
      </div>

      <div class="space-y-4 mt-4 p-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Plate Number</label>
          <input
            type="text"
            v-model="form.plate_no"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
            placeholder="Enter plate number"
          />

          <i class="text-red-500" v-if="$page.props.errors">{{
            $page.props.errors.plate_no
          }}</i>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Type:</label>
          <select
            v-model="form.type"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
          >
            <option value="">Select an option</option>
            <option value="check-in">Check-in</option>
            <option value="check-out">Check-out</option>
          </select>
          <i class="text-red-500" v-if="$page.props.errors">{{
            $page.props.errors.type
          }}</i>
        </div>
      </div>
      <div class="flex justify-end border-t bg-gray-100 p-2 rounded-b-xl">
        <button
          type="submit"
          class="px-4 py-2 text-blue-100 bg-blue-500 rounded hover:opacity-50"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</template>

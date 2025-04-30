<script setup>
import { defineEmits } from "vue";
const emit = defineEmits(["toggleAboutModal"]);

const closeModal = () => {
  emit("toggleAboutModal");
};
</script>

<template>
  <div
    @click.self="closeModal"
    class="flex fixed justify-center items-center inset-0 bg-gray-800 bg-opacity-50 z-50"
  >
    <section
      class="bg-white max-w-3xl mx-auto p-6 text-gray-800 rounded-xl shadow"
      @mouseleave="closeModal"
    >
      <p class="mb-4">
        The primary functionality of this website is to serve as a digital record system
        for vehicles entering and exiting an establishment. It tracks and logs essential
        data such as the time of entry, time of exit, and vehicle details. This system
        aims to enhance security, improve traffic monitoring, and ensure proper
        documentation within controlled environments like schools, offices, or gated
        communities.
      </p>

      <p class="mb-4">
        Records can be reviewed for auditing purposes and help administrators manage
        vehicle flow efficiently. The system is designed with usability in mind, making it
        easy for guards or authorized personnel to use with minimal training.
      </p>
    </section>
  </div>
</template>

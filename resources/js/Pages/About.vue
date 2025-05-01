<script setup>
import Layout from "@/Layouts/Layout.vue";
import { defineProps } from "vue";

const props = defineProps({
  user: Object,
});
</script>

<template>
  <Layout :user="props.user">
    <section class="max-w-3xl mx-auto p-6 text-gray-800">
      <h1 class="text-3xl font-bold mb-4 text-blue-600">About This Website</h1>

      <p class="mb-4">
        This website was created as part of the final examination project for the course
        <span class="font-semibold">DC303</span>. It demonstrates the practical
        application of concepts learned in the course, particularly in front-end web
        development and user interface design.
      </p>

      <p class="mb-4">
        Built using <span class="font-semibold">Vue.js</span>, powered by
        <span class="font-semibold">Inertia.js</span>, and styled with
        <span class="font-semibold">Tailwind CSS</span>, this project emphasizes
        responsive design, clean code, and functional implementation suitable for
        real-world applications.
      </p>

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

      <div class="mt-8 border-t pt-4">
        <h2 class="text-xl font-semibold mb-2 text-gray-700">Developed by:</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li><span class="font-medium">Reinhard Esteban</span>, BSIT-IV</li>
          <li><span class="font-medium">Mika Laruga</span>, BSIT-III</li>
        </ul>
      </div>
    </section>
  </Layout>
</template>

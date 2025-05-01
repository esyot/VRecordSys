<script setup>
import Layout from "@/Layouts/Layout.vue";
import AddVehicleModal from "@/Modals/AddVehicleModal.vue";
import { router } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";

const props = defineProps({
  vehicles: Object,
  selected_type: String,
  selected_order: String,
  search_value: String,
  user: Object,
});

const isOpenAddVehicleModal = ref(false);

const search = ref(props.search_value ?? "");
const type = ref(props.selected_type ?? "");
const order = ref(props.selected_order ?? "");

const toggleAddVehicleModal = () => {
  isOpenAddVehicleModal.value = !isOpenAddVehicleModal.value;
};

const paginationControl = (link) => {
  router.visit(link);
};

const filterControl = () => {
  router.get("/dashboard/filter", {
    search: search.value,
    type: type.value,
    order: order.value,
  });
};
const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleString("en-US", {
    year: "numeric",
    month: "long",
    day: "2-digit",
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
    timeZoneName: "short",
  });
};
</script>

<template>
  <Layout :user="props.user">
    <AddVehicleModal
      v-if="isOpenAddVehicleModal"
      @toggleAddVehicleModal="toggleAddVehicleModal"
    ></AddVehicleModal>
    <div class="p-4">
      <div class="flex flex-wrap justify-between items-center mb-2">
        <h1 class="text-xl font-bold w-full sm:w-auto">Records</h1>
        <div class="flex flex-wrap justify-between items-center w-full sm:w-auto">
          <div class="flex flex-wrap gap-2 items-center mb-4 sm:mb-0">
            <h1 class="text-sm sm:text-base">Filter:</h1>

            <div class="border px-4 py-2 flex items-center space-x-2">
              <input
                type="text"
                v-model="search"
                class="outline-none"
                placeholder="Search plate #"
              />
              <i
                class="fas fa-magnifying-glass hover:opacity-50 cursor-pointer"
                @click="filterControl"
              ></i>
            </div>

            <select
              v-model="type"
              @change="filterControl"
              class="px-4 py-2 border text-sm sm:text-base"
            >
              <option value="">All</option>
              <option value="check-in">Check-in</option>
              <option value="check-out">Check-out</option>
            </select>

            <select
              v-model="order"
              @change="filterControl"
              class="px-4 py-2 border text-sm sm:text-base"
            >
              <option value="" selected disabled>Select order</option>
              <option value="ASC">ASC</option>
              <option value="DESC">DESC</option>
            </select>
          </div>
        </div>
      </div>

      <div class="flex justify-end mb-2">
        <button
          @click="toggleAddVehicleModal"
          class="px-4 py-2 text-blue-100 bg-blue-500 rounded hover:opacity-50"
        >
          Add Record
        </button>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
          <thead>
            <tr class="bg-gray-100">
              <th class="py-2 px-4 border-b text-left">Plate Number:</th>
              <th class="py-2 px-4 border-b text-left">Type</th>
              <th class="py-2 px-4 border-b text-left">Date & Time</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(vehicle, index) in vehicles.data" :key="index">
              <td class="py-2 px-4 border-b">{{ vehicle.plate_no }}</td>
              <td
                :class="
                  vehicle.type === 'check-in'
                    ? 'py-2 px-4 border-b text-green-600'
                    : 'py-2 px-4 border-b text-red-600'
                "
              >
                {{ vehicle.type }}
              </td>
              <td class="py-2 px-4 border-b">{{ formatDate(vehicle.created_at) }}</td>
            </tr>
          </tbody>
        </table>

        <div class="flex items-center justify-center space-x-4 p-2">
          <i
            @click="paginationControl(vehicles.first_page_url)"
            class="fa-solid fa-angles-left hover:opacity-50 cursor-pointer"
          ></i>

          <i
            @click="paginationControl(vehicles.prev_page_url)"
            class="fas fa-chevron-left hover:opacity-50 cursor-pointer"
          ></i>

          <span class="text-sm sm:text-base">
            Page {{ vehicles.current_page }} of {{ vehicles.last_page }}
          </span>

          <i
            @click="paginationControl(vehicles.next_page_url)"
            class="fas fa-chevron-right hover:opacity-50 cursor-pointer"
          ></i>

          <i
            @click="paginationControl(vehicles.last_page_url)"
            class="fa-solid fa-angles-right hover:opacity-50 cursor-pointer"
          ></i>
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
@media (max-width: 640px) {
  .filter-wrapper {
    flex-direction: column;
    align-items: flex-start;
  }

  table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }

  .pagination-wrapper {
    flex-direction: column;
    align-items: center;
  }
}
</style>

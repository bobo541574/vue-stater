<template>
  <div class="h-screen flex overflow-hidden bg-gray-100">
    <!-- Start sidebar -->
    <Sidebar :sidebarOpen="sidebarOpen" @toggleSidebar="toggleSidebar" />
    <!-- End sidebar -->

    <div class="w-full h-full overflow-hidden">
      <!-- Start navbar -->
      <Navbar :sidebarOpen="sidebarOpen" @toggleSidebar="toggleSidebar" />
      <!-- End navbar -->

      <main
        class="
          w-full
          h-full
          flex-1
          relative
          overflow-y-auto
          focus:outline-none
          py-2
          px-4
          pb-48
        "
      >
        <!-- <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
          </div>
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
              <div
                class="border-4 border-dashed border-gray-200 rounded-lg h-96"
              ></div>
            </div>
          </div>
        </div> -->
        <div class="py-6">
          <slot></slot>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import Sidebar from "../layouts/Sidebar.vue";
import Navbar from "../layouts/Navbar.vue";

export default {
  name: "MainLayout",

  components: {
    Sidebar,
    Navbar,
  },
  setup() {
    const sidebarOpen = ref(false);

    const toggleSidebar = (status) => {
      sidebarOpen.value = status;
    };

    return {
      sidebarOpen,
      toggleSidebar,
    };
  },
};
</script>
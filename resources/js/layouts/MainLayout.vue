<template>
  <div class="h-screen flex overflow-hidden bg-gray-100">
      <sidebar></sidebar>
      <div class="w-full h-full overflow-hidden">
        <navbar></navbar>
        <main class="w-full h-full flex-1 relative overflow-y-auto focus:outline-none py-2 px-8 pb-48">
          <slot></slot>
        </main>
      </div>
  </div>
</template>

<script setup>
import Sidebar from "@/layouts/Sidebar.vue";
import Navbar from "@/layouts/Navbar.vue";

</script>
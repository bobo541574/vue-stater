<template>
  <main-layout>
    <div class="mx-auto text-3xl font-semibold">Home</div>
    <div class="flex justify-center my-6">
      <base-input type="text" id="name" name="name" v-model="form.name" />
      <base-input type="number" id="price" name="price" v-model="form.price" />
    </div>
  </main-layout>
</template>

<script>
import { onMounted, inject, reactive } from "vue";
import BaseInput from "../components/BaseInput.vue";
export default {
  components: { BaseInput },
  name: "Home",

  setup() {
    const eventBus = inject("eventBus");
    const trans = inject("trans");
    const form = reactive({
      name: "",
      price: 0,
    });

    onMounted(() => {
      eventBus.on("localeChange", (data) => {
        console.log(trans(data));
      });
    });

    return {
      form,
    };
  },
};
</script>
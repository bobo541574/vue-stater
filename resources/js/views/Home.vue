<template>
  <main-layout>
    <div class="mx-auto text-3xl font-semibold">Home</div>
    <div class="flex justify-center my-6">
      <base-input
        type="text"
        id="name"
        name="name"
        :classes="'border-red-700'"
        v-model="form.name"
      />
      <base-input type="number" id="price" name="price" v-model="form.price" />
    </div>
    <div class="border bg-white p-4">
      <base-image-upload @upload="uploadImages" />
    </div>
  </main-layout>
</template>

<script>
import { onMounted, inject, reactive } from "vue";
export default {
  name: "Home",

  setup() {
    const eventBus = inject("eventBus");
    const trans = inject("trans");
    const form = reactive({
      name: "",
      price: 0,
      images: [],
    });

    onMounted(() => {
      eventBus.on("localeChange", (data) => {
        console.log(trans(data));
      });
    });

    const uploadImages = (images) => {
      console.log(images);
      form.images = images;
    };

    return {
      form,
      uploadImages,
    };
  },
};
</script>
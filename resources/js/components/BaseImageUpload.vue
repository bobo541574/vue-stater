<template>
  <div class="w-full">
    <div
      class="
        px-6
        py-4
        bg-gray-100
        border-2 border-gray-300 border-dashed
        rounded
      "
    >
      <div
        class="flex flex-wrap space-y-2 space-x-4 justify-around items-center"
      >
        <template
          v-for="(image, index) in images"
          :key="`${image.name}-${index}`"
        >
          <div class="mx-4">
            <div class="border shadow-sm rounded-sm bg-white p-2">
              <img
                :src="getImageUrl(image)"
                class="mx-auto w-60"
                :alt="image.name"
              />
              <div class="flex justify-center items-center space-x-4 mt-2">
                <div
                  class="
                    bg-red-500
                    hover:bg-red-400
                    rounded-sm
                    shadow-sm
                    p-1
                    text-white
                    cursor-pointer
                  "
                  @click.prevent="removeImage(image)"
                >
                  <XCircleIcon class="inline-block w-8 h-8" />
                </div>
                <div
                  class="
                    bg-green-500
                    hover:bg-red-400
                    rounded-sm
                    shadow-sm
                    p-1
                    text-white
                    cursor-pointer
                  "
                  @click.prevent="confirmImage(image)"
                >
                  <CheckCircleIcon class="inline-block w-8 h-8" />
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-if="images && images.length == 0">
          <div
            class="
              h-36
              flex
              items-center
              text-xs text-blue-500
              font-bold
              mx-auto
            "
          >
            <ExclamationCircleIcon class="w-5 h-5 font-bold" />
            <span>&nbsp; PNG, JPG, GIF up to 5MB</span>
          </div>
        </template>
      </div>
    </div>
    <div class="flex justify-center items-center pt-2">
      <label class="relative cursor-pointer">
        <div
          class="
            cursor-pointer
            border
            shadow-sm
            rounded
            p-2
            text-gray-500
            border-gray-500
            hover:border-gray-400 hover:text-gray-400
          "
        >
          <PhotoIcon class="w-8 h-8" />
          <input
            type="file"
            name="images"
            id="images"
            class="sr-only"
            multiple
            @change.prevent="processImages"
          />
        </div>
      </label>
    </div>
  </div>
</template>

<script>
import {
  PhotoIcon,
  XCircleIcon,
  CheckCircleIcon,
  ExclamationCircleIcon,
} from "@heroicons/vue/24/outline";
import { reactive } from "vue";
export default {
  name: "BaseImageUpload",

  components: {
    PhotoIcon,
    XCircleIcon,
    CheckCircleIcon,
    ExclamationCircleIcon,
  },

  setup(props, { emit }) {
    const images = reactive([]);

    const uploadImages = (e) => {
      console.log("upload: ", e.target);
    };

    const getImageUrl = (image) => {
      return URL.createObjectURL(image);
    };

    const processImages = (e) => {
      let uploadImages = e.target.files;
      images.push(...uploadImages);
      emitter();
    };

    const removeImage = (data) => {
      let filteredImages = images.filter((image) => image.name !== data.name);
      console.log(filteredImages);
      Object.assign(images, filteredImages);
    };

    const confirmImage = (data) => {
      images.filter((image) => image.name);
    };

    const emitter = () => {
      emit("upload", images);
    };

    return {
      images,
      uploadImages,
      getImageUrl,
      removeImage,
      confirmImage,
      processImages,
    };
  },
};
</script>
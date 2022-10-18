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
      <div class="flex flex-wrap space-y-2 space-x-4 justify-around">
        <div
          v-for="(image, index) in getImages"
          :key="`${image.name}-${index}`"
          class="mx-4"
        >
          <div class="border shadow-sm rounded-sm bg-white p-2">
            <img
              :src="getImageUrl(image)"
              class="mx-auto w-60"
              :alt="image.name"
              @click="previewImage(image)"
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
        <div v-if="getImages && getImages.length == 0">
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
        </div>
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

    <base-modal ref="previewModal" size="2xl">
      <template #body>
        <img :src="getPreviewImage" class="mx-auto" />
      </template>
      <template v-if="cropable" #footer>
        <div class="flex justify-center space-x-4 mt-5">
          <button
            type="button"
            class="
              justify-center
              rounded
              border border-transparent
              bg-red-600
              px-4
              py-2
              text-base
              font-medium
              text-white
              shadow-sm
              hover:bg-red-700
              focus:outline-none
              focus:ring-2
              focus:ring-red-500
              focus:ring-offset-2
              sm:text-sm
            "
            @click="hide"
          >
            Cancel
          </button>
          <button
            type="button"
            class="
              justify-center
              rounded
              border border-transparent
              bg-indigo-600
              px-4
              py-2
              text-base
              font-medium
              text-white
              shadow-sm
              hover:bg-indigo-700
              focus:outline-none
              focus:ring-2
              focus:ring-indigo-500
              focus:ring-offset-2
              sm:text-sm
            "
            @click="confirm"
          >
            Confirm
          </button>
        </div>
      </template>
    </base-modal>
  </div>
</template>

<script>
import { computed, reactive, ref } from "vue";

// components
import BaseModal from "Resources/components/BaseModal.vue";
import {
  PhotoIcon,
  XCircleIcon,
  CheckCircleIcon,
  ExclamationCircleIcon,
} from "@heroicons/vue/24/outline";

export default {
  name: "BaseImageUpload",

  components: {
    PhotoIcon,
    XCircleIcon,
    CheckCircleIcon,
    ExclamationCircleIcon,
    "base-modal": BaseModal,
  },

  props: {
    cropable: {
      default: false,
      type: Boolean,
      required: false,
    },
  },

  setup(props, { emit }) {
    // variables
    const { cropable } = reactive(props);
    const previewModal = ref(null);
    const image = ref(null);
    const form = reactive({
      images: [],
      uploadedImages: [],
    });
    const config = {
      title: "Confirmation",
      titleClasses: "text-lg font-medium leading-6 text-gray-900",
      message: "Are you sure?",
      messageClasses: "text-sm text-gray-500",
      icon: "CheckIcon",
      iconClasses: "h-6 w-6 text-green-600",
      cancel: "Cancel",
      cancelClasses:
        "inline-flex w-full justify-center rounded border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:text-sm",
      confirm: "Confirm",
      confirmClasses:
        "inline-flex w-full justify-center rounded border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm",
      confirmAction: async () => {
        console.log("callback");
        previewModal.value.hide();
      },
    };

    // computed
    const getPreviewImage = computed(() => {
      return URL.createObjectURL(image.value);
    });

    const getImages = computed(() => {
      return form.images;
    });

    // methods
    const uploadImages = (e) => {
      console.log("upload: ", e.target);
    };

    const getImageUrl = (image) => {
      return URL.createObjectURL(image);
    };

    const setPreviewImage = (data) => {
      return (image.value = data);
    };

    const processImages = (e) => {
      let images = e.target.files;
      form.images.push(...images);

      uploadToStorage(images);
      emitter();
    };

    const uploadToStorage = (images) => {
      let toUploadImages = Array.from(images).map((data) => {
        return {
          name: data.name,
          image: `${data.lastModified}-${data.name}`,
        };
      });
      form.uploadedImages.push(...toUploadImages);
    };

    const previewImage = (image) => {
      setPreviewImage(image);
      previewModal.value.modal();
    };

    const removeImage = (data) => {
      form.images = form.images.filter(
        (image) => image.name !== data.name
      );

      form.uploadedImages = form.uploadedImages.filter(
        (image) => image.name !== data.name
      );

      emitter();
    };

    const confirmImage = (data) => {
      images.filter((image) => image.name);
    };

    const emitter = () => {
      emit("upload", form.uploadedImages);
    };

    const hide = () => {
      previewModal.value.hide();
    };

    const confirm = () => {
      console.log("confirm");
      hide();
    };

    return {
      cropable,
      config,
      hide,
      confirm,
      previewModal,
      form,
      getImages,
      getPreviewImage,
      uploadImages,
      previewImage,
      getImageUrl,
      removeImage,
      confirmImage,
      processImages,
    };
  },
};
</script>
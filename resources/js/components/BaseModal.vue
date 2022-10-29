<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="hide">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        />
      </TransitionChild>

      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div
          class="
            flex
            min-h-full
            items-end
            justify-center
            p-4
            text-center
            sm:items-center sm:p-0
          "
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <DialogPanel :class="getModalSize">
              <div>
                <!-- Header -->
                <slot name="header">
                  <div
                    v-if="hasConfig"
                    class="
                      mx-auto
                      flex
                      h-12
                      w-12
                      items-center
                      justify-center
                      rounded-full
                      bg-green-100
                    "
                  >
                    <component
                      :is="getIcon"
                      :class="getIconClass"
                      aria-hidden="true"
                    />
                  </div>
                </slot>

                <!-- Body -->
                <slot name="body">
                  <div v-if="hasConfig" class="mt-3 text-center sm:mt-5">
                    <DialogTitle as="h3" :class="getTitleClass">{{
                      getTitle
                    }}</DialogTitle>
                    <div class="mt-2">
                      <p :class="getMessageClass">
                        {{ getMessage }}
                      </p>
                    </div>
                  </div>
                </slot>
              </div>

              <!-- Footer -->
              <slot name="footer">
                <div
                  v-if="hasConfig"
                  class="flex justify-between space-x-4 mt-5"
                >
                  <button type="button" :class="getCancelClass" @click="hide">
                    {{ getCancel }}
                  </button>
                  <button
                    type="button"
                    :class="getConfirmClass"
                    @click="getConfirmAction()"
                  >
                    {{ getConfirm }}
                  </button>
                </div>
              </slot>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { computed, reactive, ref } from "vue";

// components
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon } from "@heroicons/vue/24/outline";

export default {
  name: "BaseModal",

  components: {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    CheckIcon,
  },

  props: {
    config: {
      // default: {
      //   title: "Confirmation",
      //   titleClasses: "text-lg font-medium leading-6 text-gray-900",
      //   message: "Are you sure?",
      //   messageClasses: "text-sm text-gray-500",
      //   icon: "CheckIcon",
      //   iconClasses: "h-6 w-6 text-green-600",
      //   cancel: "Cancel",
      //   cancelClasses:
      //     "inline-flex w-full justify-center rounded border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:text-sm",
      //   confirm: "Confirm",
      //   confirmClasses:
      //     "inline-flex w-full justify-center rounded border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm",
      //   confirmAction: null,
      // },
      default: {},
      type: Object,
      required: false,
    },
    size: {
      default: "lg",
      type: [String],
      required: false,
    },
  },

  setup(props) {
    // variables
    /**
     * title, titleClasses, message, messageClasses, icon, iconClasses, cancel, cancelClasses, cancelAction, confirm, confirmClasses, confirmAction
     */
    const { config, size } = reactive(props);
    const open = ref(false);

    // computed
    const hasConfig = computed(() => {
      return config && Object.keys(config).length > 0;
    });

    const getModalSize = computed(() => {
      let classes =
        "relative transform overflow-hidden rounded bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:p-6 sm:w-full";
      return `${classes} ${size}`;
    });

    const getTitle = computed(() => {
      return config.title ?? "";
    });

    const getTitleClass = computed(() => {
      return (
        config.titleClasses ?? "text-lg font-medium leading-6 text-gray-900"
      );
    });

    const getMessage = computed(() => {
      return config.message ?? "";
    });

    const getMessageClass = computed(() => {
      return config.messageClasses ?? "text-sm text-gray-500";
    });

    const getIcon = computed(() => {
      return config.icon ?? "CheckIcon";
    });

    const getIconClass = computed(() => {
      return config.iconClasses ?? "h-6 w-6 text-green-600";
    });

    const getCancel = computed(() => {
      return config.cancel ?? "Cancel";
    });

    const getCancelClass = computed(() => {
      return (
        config.cancelClasses ??
        "inline-flex w-full justify-center rounded border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:text-sm"
      );
    });

    const getConfirm = computed(() => {
      return config.confirm ?? "Confirm";
    });

    const getConfirmClass = computed(() => {
      return (
        config.confirmClasses ??
        "inline-flex w-full justify-center rounded border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-sm"
      );
    });

    // methods
    const modal = () => {
      open.value = true;
    };

    const hide = () => {
      open.value = false;
    };

    const getConfirmAction = () => {
      return config.confirmAction();
    };

    const callback = async () => {
      await config.confirmAction();
    };

    return {
      open,
      size,
      getModalSize,
      getTitle,
      getTitleClass,
      getMessage,
      getMessageClass,
      getIcon,
      getIconClass,
      getCancel,
      getCancelClass,
      getConfirm,
      getConfirmClass,
      hasConfig,
      modal,
      hide,
      callback,
      getConfirmAction,
    };
  },
};
</script>
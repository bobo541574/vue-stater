<template>
  <div class="relative">
    <input
      :type="getType"
      :id="getId"
      :name="getName"
      :placeholder="getPlaceholder"
      :class="getClass"
      :value="modelValue"
      @input="handlerInput"
    />
  </div>
</template>

<script>
import { computed } from "@vue/reactivity";
export default {
  name: "BaseInput",

  props: {
    id: {
      default: null,
      type: String,
      required: false,
    },
    name: {
      default: null,
      type: String,
      required: false,
    },
    placeholder: {
      default: null,
      type: String,
      required: false,
    },
    type: {
      default: "text",
      type: String,
      required: false,
    },
    classes: {
      default: null,
      type: [String, Array],
      required: false,
    },
    modelValue: {
      default: null,
      type: [String, Number, Boolean, null],
      required: true,
    },
  },

  setup(props, { emit }) {
    const { id, name, placeholder, type, classes, modelValue } = props;

    const getId = computed(() => {
      return id;
    });

    const getName = computed(() => {
      return name;
    });

    const getPlaceholder = computed(() => {
      return placeholder;
    });

    const getType = computed(() => {
      return type;
    });

    const getClass = computed(() => {
      let css = [
        "shadow-sm border border-gray-300 px-4 py-2 w-full rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500",
      ];

      css.push(classes);

      return css;
    });

    const handlerInput = (e) => {
      if (type == "number") {
        console.log("Number: ", e.target.value.trim());
      }
      emit("update:modelValue", e.target.value.trim());
    };

    return {
      getId,
      getName,
      getPlaceholder,
      getType,
      getClass,
      handlerInput,
    };
  },
};
</script>
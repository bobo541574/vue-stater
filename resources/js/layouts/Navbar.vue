<template>
  <div class="p-4 flex justify-between item-center shadow">
    <a href="#" class="hover:text-gray-700" @click="toggleSidebar">
      <Bars3Icon class="h-6 w-6" aria-hidden="true" />
    </a>
    <div class="ml-4 flex items-center md:ml-6">
      <Menu as="div" class="ml-3 relative">
        <div>
          <MenuButton
            class="
              max-w-xs
              bg-white
              flex
              items-center
              text-sm
              rounded-full
              focus:outline-none
              focus:ring-2
              focus:ring-offset-2
              focus:ring-indigo-500
            "
          >
            <span class="sr-only">Open user menu</span>
            <img class="h-8 w-8" :src="selectedLang.icon" alt="" />
          </MenuButton>
        </div>
        <transition
          enter-active-class="transition ease-out duration-100"
          enter-from-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-75"
          leave-from-class="transform opacity-100 scale-100"
          leave-to-class="transform opacity-0 scale-95"
        >
          <MenuItems
            class="
              origin-top-right
              absolute
              z-20
              right-0
              mt-2
              py-1
              w-48
              rounded-md
              shadow-lg
              bg-white
              ring-1 ring-black ring-opacity-5
              focus:outline-none
            "
          >
            <MenuItem v-for="(item, index) in lang" :key="index">
              <div
                :id="index"
                class="
                  w-full
                  flex
                  items-center
                  p-2
                  text-sm text-gray-700
                  hover:bg-gray-100
                  cursor-pointer
                "
                @click="changeLocale(item.key)"
              >
                <span class="ml-2"> {{ $t(`message.${item.key}`) }} </span>
              </div>
            </MenuItem>
          </MenuItems>
        </transition>
      </Menu>

      <!-- Profile dropdown -->
      <!-- <Menu as="div" class="ml-3 relative">
        <div>
          <MenuButton
            class="
              max-w-xs
              bg-white
              flex
              items-center
              text-sm
              rounded-full
              focus:outline-none
              focus:ring-2
              focus:ring-offset-2
              focus:ring-indigo-500
            "
          >
            <span class="sr-only">Open user menu</span>
            <img
              class="h-8 w-8 rounded-full"
              src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt=""
            />
          </MenuButton>
        </div>
        <transition
          enter-active-class="transition ease-out duration-100"
          enter-from-class="transform opacity-0 scale-95"
          enter-to-class="transform opacity-100 scale-100"
          leave-active-class="transition ease-in duration-75"
          leave-from-class="transform opacity-100 scale-100"
          leave-to-class="transform opacity-0 scale-95"
        >
          <MenuItems
            class="
              origin-top-right
              absolute
              right-0
              mt-2
              w-48
              rounded-md
              shadow-lg
              py-1
              bg-white
              ring-1 ring-black ring-opacity-5
              focus:outline-none
            "
          >
            <MenuItem
              v-for="item in userNavigation"
              :key="item.name"
              v-slot="{ active }"
            >
              <a
                :href="item.href"
                :class="[
                  active ? 'bg-gray-100' : '',
                  'block px-4 py-2 text-sm text-gray-700',
                ]"
                >{{ item.name }}</a
              >
            </MenuItem>
          </MenuItems>
        </transition>
      </Menu> -->
    </div>
  </div>
</template>

<script>
import { ref, reactive, inject, onMounted } from "vue";

import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

import { BellIcon, Bars4Icon, Bars3Icon } from "@heroicons/vue/24/outline";
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
const userNavigation = [
  { name: "Your Profile", href: "#" },
  { name: "Settings", href: "#" },
  { name: "Sign out", href: "#" },
];

const lang = [
  {
    name: "myanmar",
    key: "mm",
    icon: "/images/myanmar.png",
  },
  {
    name: "english",
    key: "en",
    icon: "/images/united-kingdom.png",
  },
];

export default {
  name: "Navbar",

  components: {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    Bars4Icon,
    MagnifyingGlassIcon,
    Bars3Icon,
  },

  setup(props, { emit }) {
    const sidebarOpen = ref(false);
    const eventBus = inject("eventBus");
    const selectedLang = reactive({
      name: "myanmar",
      key: "mm",
      icon: "/images/myanmar.png",
    });

    const toggleSidebar = () => {
      eventBus.emit("toggleSidebar", (sidebarOpen.value = !sidebarOpen.value));
    };

    const changeLocale = (locale) => {
      eventBus.emit("localeChange", locale ?? "mm");
      Object.assign(
        selectedLang,
        ...lang.filter((l) => {
          return l.key == locale;
        })
      );
    };

    return {
      lang,
      sidebarOpen,
      userNavigation,
      selectedLang,
      toggleSidebar,
      changeLocale,
    };
  },
};
</script>

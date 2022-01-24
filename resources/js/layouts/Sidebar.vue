<template>
  <!-- Static sidebar for desktop -->
  <div class="hidden md:flex md:w-64 md:flex-shrink-0">
    <div class="flex flex-col w-64">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex-1 flex flex-col min-h-0 bg-gray-800">
        <div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900">
          <img
            class="h-8 w-auto"
            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
            alt="Workflow"
          />
        </div>
        <div class="flex-1 flex flex-col overflow-y-auto">
          <nav class="flex-1 px-2 py-4 space-y-1">
            <router-link
              v-for="item in navigation"
              :key="item.name"
              :class="[
                item.current
                  ? 'bg-gray-900 text-white'
                  : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
              ]"
              :to="{ name: item.route }"
            >
              <component
                :is="item.icon"
                :class="[
                  item.current
                    ? 'text-gray-300'
                    : 'text-gray-400 group-hover:text-gray-300',
                  'mr-3 flex-shrink-0 h-6 w-6',
                ]"
                aria-hidden="true"
              />
              <span class="hidden md:flex">
                {{ item.name }}
              </span>
            </router-link>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  Dialog,
  DialogOverlay,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

import {
  CalendarIcon,
  ChartBarIcon,
  FolderIcon,
  HomeIcon,
  InboxIcon,
  UsersIcon,
  XIcon,
} from "@heroicons/vue/outline";
import { ref } from "vue";

const navigation = [
  {
    name: "Dashboard",
    href: "#",
    icon: HomeIcon,
    current: true,
  },
  {
    name: "Team",
    href: "#",
    icon: UsersIcon,
    current: false,
  },
  {
    name: "Projects",
    href: "#",
    icon: FolderIcon,
    current: false,
  },
  {
    name: "Calendar",
    href: "#",
    icon: CalendarIcon,
    current: false,
  },
  {
    name: "Documents",
    href: "#",
    icon: InboxIcon,
    current: false,
  },
  {
    name: "Reports",
    href: "#",
    icon: ChartBarIcon,
    current: false,
  },
];

export default {
  name: "Sidebar",

  components: {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    CalendarIcon,
    ChartBarIcon,
    FolderIcon,
    HomeIcon,
    InboxIcon,
    UsersIcon,
    XIcon,
  },

  props: {
    sidebarOpen: {
      default: false,
    },
  },

  setup() {
    return {
      navigation,
    };
  },
};
</script>
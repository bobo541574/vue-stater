import { createApp } from "vue";

import { router } from "./plugins/vue-router";

// Components
import Master from "../js/layouts/Master.vue";
import MainLayout from "../js/layouts/MainLayout.vue";

const app = createApp(Master);
app.use(router);
app.component("m-layout", MainLayout);

app.mount("#app");

export default app;

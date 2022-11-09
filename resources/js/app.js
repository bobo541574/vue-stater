import "@/vendor.js";

import app from "@/root.js";

import { router } from "@/plugins/vue-router.js";
// import { i18n } from "@/plugins/i18n.js";
import mitt from "mitt";

const emitter = mitt();

app.use(router);
// app.use(i18n);
app.provide("eventBus", emitter);
// app.provide("trans", testing);

app.mount("#app");

import "./component.js";

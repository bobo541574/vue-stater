import app from "./root";

import { router } from "Resources/plugins/vue-router";
import {i18n, t} from "Resources/plugins/i18n";
import mitt from 'mitt';

const emitter = mitt();

app.use(router);
app.use(i18n);
app.provide("eventBus", emitter);
app.provide("trans", t);

app.mount("#app");

require('./component')

import app from "./root.js";

import MainLayout from "@/layouts/MainLayout.vue";
import BaseInput from "@/components/BaseInput.vue";
import BaseImageUpload from "@/components/BaseImageUpload.vue";
import RealTimeMessage from "@/views/RealTimeMessage.vue";

app.component("main-layout", MainLayout);
app.component("base-input", BaseInput);
app.component("base-image-upload", BaseImageUpload);
app.component("real-time-message", RealTimeMessage);

import app from "./root";

import MainLayout from "Resources/layouts/MainLayout.vue";
import BaseInput from "Resources/components/BaseInput.vue";
import BaseImageUpload from "Resources/components/BaseImageUpload.vue";

app.component("main-layout", MainLayout);
app.component("base-input", BaseInput);
app.component("base-image-upload", BaseImageUpload);

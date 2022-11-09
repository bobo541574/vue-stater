import { createWebHistory, createRouter } from "vue-router";

import store from "@/store";
import routes from "@/routes";

export const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    console.log(store.state);
    if (to.meta.auth && !store.state.auth.user.token) {
        next({
            name: "login", //redo set login
        });
    } else if (store.state.auth.user.token && to.meta.guest) {
        next({
            name: "home",
        });
    }
    next();
});

router.onError((error) => {
    console.error("load fail ", error);
    if (/loading chunk \d* failed./i.test(error.message)) {
        window.location.reload();
    }
});

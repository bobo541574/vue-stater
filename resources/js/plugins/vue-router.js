import { createWebHistory, createRouter } from "vue-router";

import store from "../store";
import routes from "../routes";

export const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.state.auth.authenticated) {
        next({
            name: "login", //redo set login
        });
    } else if (store.state.auth.authenticated && to.meta.guest) {
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

import Home from "../views/Home.vue";
import Login from "../views/Login.vue";

export default [
    {
        path: "/",
        component: Home,
        name: "home",
        meta: {
            permissions: "global",
            auth: true,
        },
    },
    {
        path: "/login",
        component: Login,
        name: "login",
        meta: {
            permissions: "global",
        },
    },
];

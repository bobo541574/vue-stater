import Home from "@/views/Home.vue";
import Login from "@/views/Login.vue";

export default [
    // {
    //     path: "/",
    //     redirect: "/dashboard",
    //     meta: {
    //         auth: true,
    //     },
    // },
    {
        path: "/",
        component: Home,
        name: "home",
        meta: {
            auth: true,
        },
    },
    {
        path: "/login",
        component: Login,
        name: "login",
        meta: {
            guest: true,
        },
    },
];

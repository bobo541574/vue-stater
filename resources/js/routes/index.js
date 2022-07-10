import Home from "Resources/views/Home.vue";
import Login from "Resources/views/Login.vue";

export default [
    {
        path: "/",
        redirect: "/dashboard",
        meta: {
            auth: true,
        },
    },
    {
        path: "/dashboard",
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

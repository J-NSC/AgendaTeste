const AuthRoutes = {
    path: '/auth',
    component: () => import('@/Layouts/blank/BlankLayout.vue'),
    meta: {
        requiresAuth: false
    },
    children: [
        {
            name: 'Side Login',
            path: '/auth/login',
            component: () => import('@/Pages/Auth/SideLogin.vue')
        },
        {
            name: 'Error',
            path: '/auth/404',
            component: () => import('@/Pages/Auth/Error.vue')
        }
    ]
};

export default AuthRoutes;

import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },

        {
            path: '/auth/login',
            name: 'login',
            component: () => import('../views/auth/login.vue')

        },
        {
            path: '/auth/register',
            name: 'register',
            component: () => import('../views/auth/register.vue')

        },

        {
            path: '/tasks',
            name: 'Task',
            component: () => import('../views/tasks/index.vue'),

        },
        {
            path: '/task/edit/:id',
            name: 'edit',
            component: () => import('../views/tasks/editTask.vue'),

        },
    ]
})

// router.beforeEach((to, from, next) => {
//   // console.log(store.state.isAuthenticated)
//   // if (to.meta.requiresAuth && !store.state.isAuthenticated) {
//   //   next({ name: 'login' });
//   // } else {
//   //   next();
//   // }
// });

export default router

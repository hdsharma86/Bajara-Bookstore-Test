import {createRouter, createWebHistory} from "vue-router";
import store from "./store.js";
import AuthLayout from './layouts/AuthLayout.vue';
import DefaultLayout from './layouts/DefaultLayout.vue';
import Dashboard from './pages/Dashboard.vue';
import Login from "./pages/Login.vue";
import Users from "./pages/Users.vue";
import Books from "./pages/Books.vue";
import Profile from "./pages/Profile.vue";
import AddUser from "./pages/AddUser.vue";
import AddBook from './pages/AddBook.vue';
import EditUser from "./pages/EditUser.vue";
import EditBook from "./pages/EditBook.vue";
const routes = [
    {
        path: '/admin',
        name: 'admin',
        redirect: '/admin/login',
        children: [
          {
            path: 'login',
            name: 'admin.login',
            component: Login,
            meta: {
              requiresGuest: true
            },
          },
          {
              path: 'dashboard',
              name: 'admin.dashboard',
              component: Dashboard,
              meta: {
                  requiresAuth: true
              },
          },
          {
            path: 'users',
            name: 'admin.users',
            component: Users,
            meta: {
                requiresAuth: true
            }
          },
          {
            path: 'add-user',
            name: 'admin.users.add',
            component: AddUser,
            meta: {
                requiresAuth: true
            },
          },
          {
            path: 'update-user/:id',
            name: 'admin.users.update',
            component: EditUser,
            meta: {
                requiresAuth: true
            },
          },
          {
            path: 'books',
            name: 'admin.books',
            component: Books,
            meta: {
                requiresAuth: true
            },
          },
          {
            path: 'add-book',
            name: 'admin.books.add',
            component: AddBook,
            meta: {
                requiresAuth: true
            },
          },
          {
            path: 'update-book/:id',
            name: 'admin.books.update',
            component: EditBook,
            meta: {
                requiresAuth: true
            },
          },
          {
            path: 'profile',
            name: 'admin.profile',
            component: Profile,
            meta: {
                requiresAuth: true
            },
          },
        ]
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({name: 'admin.login'})
  } else if (to.meta.requiresGuest && store.state.user.token) {
    next({name: 'admin.dashboard'})
  } else {
    next();
  }
})

export default router;
<template>
    <div class="navbar bg-gray-800 bg-base-100">
        <div class="flex-1">
            <router-link to="/admin/dashboard">
                <span class="btn text-xl">Bajara Bookstore Admin</span>
            </router-link>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><router-link to="/admin/profile">Profile</router-link></li>
                <li><a @click.prevent="logout">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="bg-gray-300 h-screen w-64 fixed shadow-lg drawer">
        <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col items-center justify-center">
              <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
            
            </div> 
            <div class="drawer-side">
              <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label> 
              <ul class="menu p-4  w-64 min-h-full bg-base-200 text-base-content">
                <li><router-link to="/admin/users">Users</router-link></li>
                <li><router-link to="/admin/books">Books</router-link></li>
              </ul>
            
            </div>
          </div>
    </div>

    <!-- Content Area -->
    <div class="ml-64">
        <div class="py-8 px-4">
            <slot />
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import store from "../store";
import router from "../router";

const logout = () => {
    store.dispatch('logout')
        .then(() => {
            router.push({ name: 'admin.login' })
        })
}
</script>
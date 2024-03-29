<template>
    <div class="navbar bg-gray-800 sticky top-0 z-50 h-2">
        <div class="flex-1 hidden lg:block">
            <router-link to="/admin/dashboard">
                <span class="text-white text-xl">Bajara Bookstore Admin</span>
            </router-link>
        </div>
        <div class="sm:hidden sm:block">
            <details class="dropdown">
                <summary class="m-1 btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </summary>
                <ul class="p-2 mt-1 shadow menu dropdown-content z-[1] bg-base-300 rounded-box w-72">
                    <li class="text-lg text-black"><router-link to="/admin/users">Users</router-link></li>
                    <li class="text-lg text-black"><router-link to="/admin/books">Books</router-link></li>
                </ul>
            </details>
        </div>
        
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><router-link class="text-white" to="/admin/profile">Profile</router-link></li>
                <li class="text-white ml-3"><a @click.prevent="logout">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="bg-gray-900 h-screen w-36 fixed shadow-lg drawer hidden lg:block">
        <div class="drawer drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col items-center justify-center">
            </div> 
            <div class="drawer-side">
              <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label> 
              <ul class="menu p-4 w-36 min-h-full bg-base-300 text-base-content">
                <li><router-link to="/admin/users">Users</router-link></li>
                <li><router-link to="/admin/books">Books</router-link></li>
              </ul>
            </div>
          </div>
    </div>

    <!-- Content Area -->
    <div class="lg:ml-36">
        <div class="py-8 px-4 border-2 border-solid m-2 rounded-box min-h-screen">
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
<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Add New User</h1>
        <div class="overflow-x-auto border-2 mt-9 bg-white">
            <div class="hero-content text-center">
                
                <form @submit.prevent="saveUser" class="w-full mx-auto">
                    <div class="space-y-4">
                      <div>
                        <input v-model="formData.name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" />
                      </div>
                      <div>
                        <input v-model="formData.email" type="text" placeholder="Email" class="input input-bordered w-full max-w-xs" />
                      </div>
                      <div>
                        <input v-model="formData.password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" />
                      </div>
                
                      <!-- Submit Button -->
                      <div>
                        <router-link to="/admin/users">
                            <button type="submit" class="btn btn-outline">Cancel</button>
                        </router-link>
                        <button type="submit" class="btn btn-outline">Add User</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>   
    </DefaultLayout>
</template>
<script setup>
import { ref, reactive, computed, onMounted, watch } from "vue";
import store from "../store";
import router from "../router";
import axiosClient from "../axios";
import DefaultLayout from '../layouts/DefaultLayout.vue';
const formData = reactive({
    name: '',
    email: '',
    password: ''
});
const saveUser = () => {
    axiosClient.post('/users', formData).then((response) => {
        router.push('/admin/users');
    })
}
</script>
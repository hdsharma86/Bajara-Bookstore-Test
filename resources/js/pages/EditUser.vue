<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Update User</h1>
        <div class="overflow-x-auto border-2 mt-9 bg-white">
            <div class="hero-content text-center">
                <form autocomplete="off" @submit.prevent="updateUser" class="w-full mx-auto">
                    <div class="space-y-4">
                      <div>
                        <input v-model="formData.name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" />
                      </div>
                      <div>
                        <input disabled v-model="formData.email" type="text" placeholder="Email" class="input input-bordered w-full max-w-xs" />
                      </div>
                      <div>
                        <input v-model="formData.password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" />
                      </div>
                      <div>
                        <router-link to="/admin/users">
                            <button type="submit" class="btn btn-outline">Cancel</button>
                        </router-link>
                        <button type="submit" class="btn btn-outline">Update User</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>   
    </DefaultLayout>
</template>
<script setup>
import { ref, reactive, computed, onMounted, watch } from "vue";
import { useRoute } from 'vue-router';
import store from "../store";
import router from "../router";
import axiosClient from "../axios";
import DefaultLayout from '../layouts/DefaultLayout.vue';
const route = useRoute();

const formData = reactive({
    name: '',
    email: '',
    password: ''
});

const updateUser = () => {
    axiosClient.post('/users', formData).then((response) => {
        router.push('/admin/users');
    })
    axiosClient.put('/users/'+route.params.id, formData).then((response) => {
        router.push('/admin/users');
    }).catch((error) => {
        console.log(error);
    })
}

const getUserDetail = () => {
    const userId = route.params.id;
    axiosClient.post('/user', {'id': userId}).then((response) => {
        const data = response.data[0];
        formData.name = data.name;
        formData.email = data.email;
    })
}

onMounted(() => {
    getUserDetail();
})
</script>
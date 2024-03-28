<template>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-300">
        <div class="card w-96 bg-base-100 shadow-xl">
            <div class="card-body">
                <p class="text-red-900">{{ errorMessage }}</p>
                <form @submit.prevent="handleSubmit">
                    <h2 class="card-title">Admin Login!</h2>
                    <div class="py-3">
                        <input v-model="form.email" name="email" type="text" placeholder="Account" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    </div>
                    <div class="py-3">
                        <input v-model="form.password" name="password" wire:model="password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" autocomplete="off" />
                    </div>
                    <button type="submit" class="btn">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import {reactive, ref} from 'vue';
import store from "../store";
import router from "../router";
const form = reactive({
    email: '',
    password: ''
});
let loading = ref(false);
const errorMessage = ref();
const handleSubmit = () => {
    store.dispatch('login', form)
    .then((response) => {
        console.log('Error', response);
        if(!response.error){
            router.push({name: 'admin.dashboard'})
        } else {
            errorMessage.value = response.error;
        }
    })
    .catch(({response}) => {
        errorMessage.value = response.error;
        loading.value = false;
    })
}
</script>
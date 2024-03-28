<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Add New Book</h1>
        <div class="overflow-x-auto border-2 mt-9 bg-white">
            <div class="hero-content text-center">
                
                <form @submit.prevent="saveBook" class="w-full mx-auto">
                    <div class="space-y-4">
                      <!-- Text Input -->
                      <div>
                        <input v-model="formData.name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs" />
                      </div>
                
                      <!-- Email Input -->
                      <div>
                        <textarea v-model="formData.description" placeholder="Description" class="textarea textarea-bordered textarea-lg w-full max-w-xs" ></textarea>
                      </div>
                
                      <!-- Password Input -->
                      <div>
                        <input v-model="formData.price" type="text" placeholder="Price" class="input input-bordered w-full max-w-xs" />
                      </div>
                
                      <!-- Submit Button -->
                      <div>
                        <router-link to="/admin/books">
                            <button type="submit" class="btn btn-outline">Cancel</button>
                        </router-link>
                        <button type="submit" class="btn btn-outline">Add Book</button>
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
    description: '',
    price: ''
});
const saveBook = () => {
    axiosClient.post('/books', formData).then((response) => {
        router.push('/admin/books');
    })
}
</script>
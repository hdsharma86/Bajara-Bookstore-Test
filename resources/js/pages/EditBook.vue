<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Update Book</h1>
        <div class="overflow-x-auto border-2 mt-9 bg-white">
            <div class="hero-content text-center">
                <form @submit.prevent="updateBook" class="w-full mx-auto">
                    <div class="space-y-4">

                        <div>
                            <input v-model="formData.name" type="text" placeholder="Name"
                                class="input input-bordered w-full max-w-xs" />
                        </div>

                        <div>
                            <textarea v-model="formData.description" placeholder="Description"
                                class="textarea textarea-bordered textarea-lg w-full max-w-xs"></textarea>
                        </div>

                        <div>
                            <input v-model="formData.price" type="text" placeholder="Price"
                                class="input input-bordered w-full max-w-xs" />
                        </div>

                        <div>
                            <router-link to="/admin/books">
                                <button type="submit" class="btn btn-outline">Cancel</button>
                            </router-link>
                            <button type="submit" class="btn btn-outline">Update Book</button>
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
import { useRoute } from 'vue-router';
const route = useRoute();

const formData = reactive({
    name: '',
    description: '',
    price: ''
});

const updateBook = () => {
    axiosClient.put('/books/'+route.params.id, formData).then((response) => {
        router.push('/admin/books');
    }).catch((error) => {
        console.log(error);
    })
}

const getBookDetail = () => {
    const bookId = route.params.id;
    axiosClient.post('/book', {'id': bookId}).then((response) => {
        const data = response.data[0];
        formData.name = data.name;
        formData.description = data.description;
        formData.price = data.price;
    })
}

onMounted(() => {
    getBookDetail();
})
</script>
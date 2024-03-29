<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Update Book</h1>
        <div class="overflow-x-auto border-2 mt-9 bg-white">
            <div class="hero-content text-center">
                <div class="hero-content flex-col lg:flex-row">
                    <img v-if="previewFile" :src="previewFile" alt="Preview" class="max-w-sm rounded-lg shadow-2xl">
                    <img v-else v-show="bookImage" :src="`/img/${bookImage}`" class="max-w-sm rounded-lg shadow-2xl" />
                    <div>
                        <form @submit.prevent="updateBook" class="w-full mx-auto">
                            <div class="space-y-4">
                                <div>
                                    <input v-model="formData.name" type="text" placeholder="Name"
                                        class="input input-bordered w-full max-w-xs border-solid" />
                                </div>

                                <div>
                                    <textarea v-model="formData.description" placeholder="Description"
                                        class="textarea textarea-bordered textarea-lg w-full max-w-xs border-solid"></textarea>
                                </div>

                                <div>
                                    <input v-model="formData.price" type="text" placeholder="Price"
                                        class="input input-bordered w-full max-w-xs border-solid" />
                                </div>
                                <div>
                                    <input @change="handleFile" type="file"
                                        class="border-solid file-input file-input-bordered w-full max-w-xs" />
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

const file = ref();
const hasFile = ref(false);
const bookImage = ref('');
const previewFile = ref();
const formData = reactive({
    name: '',
    description: '',
    price: '',
    file: ''
});

const handleFile = (e) => {
    file.value = e.target.files[0];
    hasFile.value = true;

    const selectedFile = e.target.files[0];
    if (selectedFile) {
        const reader = new FileReader();
        reader.onload = () => {
            previewFile.value = reader.result;
        };
        reader.readAsDataURL(selectedFile);
    };
}

const updateBook = () => {

    const payload = {
        name: formData.name,
        description: formData.description,
        price: formData.price
    }

    payload._method = "put";

    if (hasFile.value) {
        formData.file = file.value;
        payload.file = file.value;
    }

    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    }

    axiosClient.post('/books/' + route.params.id, payload, config).then((response) => {
        router.push('/admin/books');
    }).catch((error) => {
        console.log(error);
    })
}

const getBookDetail = () => {
    const bookId = route.params.id;
    axiosClient.post('/book', { 'id': bookId }).then((response) => {
        const data = response.data[0];
        formData.name = data.name;
        formData.description = data.description;
        formData.price = data.price;
        bookImage.value = data.images[0].name;
    })
}

onMounted(() => {
    getBookDetail();
})
</script>
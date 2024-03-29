<template>
  <DefaultLayout>
    <h1 class="text-2xl font-bold">Add New Book</h1>
    <div class="overflow-x-auto border-2 mt-9 bg-white">
      <div class="hero-content text-center">

        <form @submit.prevent="saveBook" class="w-full mx-auto">
          <div class="space-y-4">
            <!-- Text Input -->
            <div>
              <input v-model="formData.name" type="text" placeholder="Name"
                class="input input-bordered border-2 w-full max-w-xs border-solid" />
            </div>

            <!-- Email Input -->
            <div>
              <textarea v-model="formData.description" placeholder="Description"
                class="textarea textarea-bordered textarea-lg w-full max-w-xs border-solid"></textarea>
            </div>

            <!-- Password Input -->
            <div>
              <input v-model="formData.price" type="text" placeholder="Price"
                class="input input-bordered w-full max-w-xs border-solid" />
            </div>

            <div>
              <input @change="handleFile" type="file" class="file-input file-input-bordered w-full max-w-xs border-solid" />
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

const file = ref();
const hasFile = ref(false);
const formData = reactive({
  name: '',
  description: '',
  price: '',
  file: ''
});

const handleFile = (e) => {
  file.value = e.target.files[0];
  hasFile.value = true;
  console.log(file.value);
}

const saveBook = () => {
  if (hasFile.value) {
    formData.file = file.value;
  }
  const config = {
    headers: {
      'content-type': 'multipart/form-data'
    }
  }
  axiosClient.post('/books', formData, config).then((response) => {
    router.push('/admin/books');
  })
}
</script>
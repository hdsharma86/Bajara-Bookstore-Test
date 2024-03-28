<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Books</h1>
        <div class="flex justify-end text-right">
          <router-link to="/admin/add-book">
            <button class="btn btn-outline btn-sm">+ Add New</button>
          </router-link>
        </div>
        <div class="overflow-x-auto border-2 mt-9">
          <table class="table">
            <!-- head -->
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(book, index) in books">
                <th>{{ index + 1 }}</th>
                <td>{{ book.name }}</td>
                <td>{{ truncate(book.description, 30) }}</td>
                <td>{{ book.price }}</td>
                <td>
                  <router-link :to="`/admin/update-book/${book.id}`">
                    <button class="btn btn-ghost btn-xs">Edit</button>
                  </router-link>
                  
                  <button @click="removeUser(user)" class="btn btn-ghost btn-xs">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>   
        <div class="pt-2">
          <v-pagination
            v-model="page"
            :length="pageCount"
          ></v-pagination>
        </div>
    </DefaultLayout>
</template>
<script setup>
import DefaultLayout from '../layouts/DefaultLayout.vue';
import { ref, computed, onMounted, watch } from "vue";
import store from "../store";
import router from "../router";
import axiosClient from "../axios";

const books = ref();
const total = ref();
const page = ref(1);
const pageCount = ref(0);

const getBooks = (page = 1) => {
    axiosClient.get(`/books?page=${page}`).then((response) => {
        books.value = response.data.data;
        total.value = response.data.total;
        pageCount.value = response.data.last_page;
    })
}

const removeBook = (book) => {
    axiosClient.delete('/books/'+book.id).then((response) => {
        getBooks();
    }).catch((error) => {
        console.log(error);
    })
}

watch(page, (newPage) => {
  getBooks(newPage);
})

const truncate = (value, length) => {
  if (value.length > length) {
    return value.substring(0, length) + "...";
  } else {
    return value;
  }
}

onMounted(() => {
  getBooks();
})
</script>
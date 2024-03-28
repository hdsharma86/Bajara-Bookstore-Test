<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Users</h1>
        <div class="flex justify-end text-right">
          <router-link to="/admin/add-user">
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
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(user, index) in users">
                  <th>{{ index + 1 }}</th>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>
                    <router-link :to="`/admin/update-user/${user.id}`">
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
import { ref, computed, onMounted, watch } from "vue";
import store from "../store";
import router from "../router";
import axiosClient from "../axios";
import DefaultLayout from '../layouts/DefaultLayout.vue';

const users = ref();
const total = ref();
const page = ref(1);
const pageCount = ref(0);

const getUsers = (page = 1) => {
    axiosClient.get(`/users?page=${page}`).then((response) => {
      console.log(response)
        users.value = response.data.data;
        total.value = response.data.total;
        pageCount.value = response.data.last_page;
    })
}

const removeUser = (user) => {
    axiosClient.delete('/users/'+user.id).then((response) => {
        getUsers();
    }).catch((error) => {
        console.log(error);
    })
}

watch(page, (newPage) => {
  getUsers(newPage);
})

onMounted(() => {
    getUsers();
})
</script>
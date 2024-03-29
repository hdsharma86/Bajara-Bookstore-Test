<template>
    <DefaultLayout>
        <h1 class="text-2xl font-bold">Admin Profile</h1>
        <div class="overflow-x-auto border-2 mt-9">
            <div class="text-center pt-3">
              <div v-show="errorMessage" class="text-red">
                <span>{{errorMessage}}</span>
              </div>

              <div v-show="successMessage" class="text-green">
                <span>{{successMessage}}</span>
              </div>
            </div>
            <div class="hero-content text-center">
                <form autocomplete="off" @submit.prevent="updateProfile" class="w-full mx-auto">
                    <div class="space-y-4">
                      <div>
                        <input v-model="formData.name" type="text" placeholder="Name" class="input input-bordered w-full max-w-xs border-solid" />
                      </div>
                      <div>
                        <input disabled v-model="formData.email" type="text" placeholder="Email" class="input input-bordered w-full max-w-xs border-solid" />
                      </div>
                      <div>
                        <input v-model="formData.password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs border-solid" />
                      </div>
                      <div>
                        <router-link to="/admin/dashboard">
                            <button type="submit" class="btn btn-outline">Cancel</button>
                        </router-link>
                        <button type="submit" class="btn btn-outline">Update Profile</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>    
    </DefaultLayout>
</template>
<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import store from "../store";
import router from "../router";
import axiosClient from "../axios";
import DefaultLayout from '../layouts/DefaultLayout.vue';

const formData = reactive({
    name: '',
    email: '',
    password: '',
    uid: ''
});

const successMessage = ref('');
const errorMessage = ref('');

const updateProfile = () => {
    validate();
    const payload = {
        name: formData.name
    }

    payload._method = "put";

    axiosClient.post('/profile/'+formData.uid, payload).then((response) => {
      errorMessage.value = '';
      successMessage.value = "Profile has been updated successfully."
    }).catch((error) => {
        console.log(error);
    })
}

const validate = () => {
  if(formData.name === ''){
    return errorMessage.value = "Name can't be empty."
  }
}

const getProfileDetail = () => {
  axiosClient.post('/user').then((response) => {
    formData.name = response.data.name;
    formData.email = response.data.email;
    formData.uid = response.data.id;
  })
}

onMounted(() => {
  getProfileDetail();
})
</script>
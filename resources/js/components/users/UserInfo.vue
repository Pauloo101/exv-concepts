<template>
      <div>
        <div class="flex justify-between items-center pb-4">
                    <kabel>Applicants with direct visa application</kabel>
                    <!-- <label for="table-search" class="sr-only">Search</label> -->
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Applicant">
                    </div>
                </div>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                First Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Last Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Email
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Visa Type
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Country of Origin
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Accepted
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Address
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Mobile Number
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Comments
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr @click="showUserModal(user)" v-for="(user, index) in users" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{user?.first_name}}
                            </th>
                            <td class="py-4 px-6">
                                {{user?.last_name}}
                            </td>
                            <td class="py-4 px-6">
                                {{user?.email}}
                            </td>
                            <td class="py-4 px-6">
                                {{user?.visa_type}}
                            </td>
                            <td class="py-4 px-6">
                                {{user?.visa_form?.country_origin}}
                            </td>
                            <td class="py-4 px-6">
                                {{user?.visa_form?.accepted}}
                            </td>
                            <td class="py-4 px-6">
                                {{user?.visa_form?.address}}
                            </td>
                            <td class="py-4 px-6">
                                {{user?.visa_form?.mobile_number}}
                            </td>
                            <td class="py-4 px-6">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
    </div>
    <UserModal v-if="isUserModalShown" :user="user" :file="file" @close="isUserModalShown = false "></UserModal>
</template>
<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import UserModal from './userModal.vue';
const users = ref()
const isUserModalShown = ref(false);
const user = ref()
const file  = ref()
const showUserModal = (userInfo)=>{
    file.value = userInfo?.visa_form?.files ?  JSON.parse(userInfo.visa_form.files) : {};
    user.value = userInfo;
    isUserModalShown.value = true
}

onMounted(async ()=>{
    const response = await axios.get(`${window.origin}/api/admin/get-direct-work-visa`);
    users.value = response.data;
});

</script>

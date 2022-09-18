<template>
    <div
        class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
    >
        <div class="w-full max-w-md space-y-8">
            <div>
                <!-- <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" /> -->
                <h1 class="text-blue-400 mx-auto w-auto text-center text-6xl">
                    EXV
                </h1>
                <h2
                    class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"
                >
                    Welcome
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    {{ " " }}
                    <span
                        class="font-medium text-indigo-600 hover:text-indigo-500"
                        >start your visa application process</span
                    >
                </p>
            </div>
            <div class="mt-8 space-y-6">
                <input type="hidden" name="remember" value="true" />
                <div class="-space-y-px rounded-md shadow-sm">
                    <div class="mb-2">
                        <label for="first-name">First Name </label>
                        <input v-model="registerForm.firstName"
                            id="first-name"
                            name="first-name"
                            class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="First Name"
                        />
                    </div>

                    <div class="mb-2">
                        <label for="last-name">Last Name</label>
                        <input v-model="registerForm.lastName"
                            id="last-name"
                            name="last-name"
                            class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="Last Name"
                        />
                    </div>

                    <div class="mb-2">
                        <label for="email-address">Email address</label>
                        <input v-model="registerForm.email"
                            id="email-address"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required=""
                            class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="Email address"
                        />
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input v-model="registerForm.password"
                            id="password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            required=""
                            class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="Password"
                        />
                    </div>
                </div>

                <!-- <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>

            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
            </div>
          </div> -->

                <div>
                    <button
                        @click="handleRegistration"
                        class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <LockClosedIcon
                                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                aria-hidden="true"
                            />
                        </span>
                        Sign Up
                    </button>

                    <div class="text-center mt-4">
                        <a
                            class="text-indigo-600 hover:text-indigo-500"
                            @click="gotoLogin"
                        >
                            Already Registered ? Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useRouter } from "vue-router";
import { LockClosedIcon } from "@heroicons/vue/20/solid";
import { reactive } from "vue";
import { useAuthStore } from "../store";

const registerForm = reactive({
    email: "",
    password: "",
    firstName: "",
    lastName: "",
});
const router = useRouter();
const authStore = useAuthStore()
const gotoLogin = () => router.push("/");
const handleRegistration = async () =>{
    const response = await authStore.userRegister({...registerForm});
    if(response){
        router.replace({'name':'MyApplication'})
    }
}
</script>

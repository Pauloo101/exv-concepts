<template>
    <div class="mt-10 sm:mt-0">
        <div class="">
            <div class="mt-5 md:mt-0">
            <div >
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="country-of-origin" class="block text-sm font-medium text-gray-700">Country of origin</label>
                            <input v-model="applicationForm.country_origin" required type="text" name="country-of-origin" id="country-of-origin" autocomplete="country-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Country of origin">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="mobile-number" class="block text-sm font-medium text-gray-700">Mobile Number (Add your country code (e.g +44(UK), +234(NGN), +91(IN)))</label>
                            <input v-model="applicationForm.mobile_number" required type="text" name="mobile-number" id="mobile-number" autocomplete="mobile" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Mobile number">
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="address" class="block text-sm font-medium text-gray-700"> Home Address</label>
                            <input v-model="applicationForm.address" required type="text" name="address" id="address" autocomplete="address-line1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  placeholder="address">
                        </div>

                        <!-- <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button @click="saveForm" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { inject, onMounted, reactive } from "vue";
import { ToastEmitter } from "../../constants/visa-constants";
import { useVisaApplicationStore } from "../../store";
const emitter = inject('emitter');
const visaApplicationStore = useVisaApplicationStore();
const applicationForm = reactive({
    country_origin:"",
    mobile_number:"",
    address:""
});
const saveForm = async () => {
    await visaApplicationStore.saveApplicationForm({...applicationForm});
    emitter.emit(ToastEmitter.SuccessToast, "details updated successfully");
};

onMounted(()=>{
    applicationForm.address = visaApplicationStore.visaApplicationForm.address
    applicationForm.mobile_number = visaApplicationStore.visaApplicationForm.mobile_number
    applicationForm.country_origin = visaApplicationStore.visaApplicationForm.country_origin
})
</script>

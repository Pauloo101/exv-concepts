<template>
<div>
    <div class="flex justify-evenly">
        <div :class="{ 'outline outline-4 outline-blue-500' : selectedVisaApplicationType === visaTypes.Tier4ToTier2}"  @click="selectedVisaApplicationType = visaTypes.Tier4ToTier2" class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Move from Tier 4 to Tier 2 Visa</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Select this if you currently on a student visa</p>
        </div>
        <div :class="{ 'outline outline-4 outline-blue-500' : selectedVisaApplicationType === visaTypes.DirectWorkVisa}" @click="selectedVisaApplicationType = visaTypes.DirectWorkVisa" class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Apply for a direct work Visa</h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Select this to start your work visa application.
            </p>
            <!-- <span class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Apply for a direct work Visa
                <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </span> -->
        </div>
    </div>

    <div class="flex justify-center">
        <button @click="updateSelectedVisaApplication" :disabled="!selectedVisaApplicationType" class="mt-3 inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Continue
        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
    </div>

</div>
</template>
<script setup>
import { ref } from 'vue';
import { visaTypes } from '../../constants/visa-constants';
import { useVisaApplicationStore } from './../../store'
    const emits = defineEmits(['VisaTypeSelected'])
    const visaApplicationStore = useVisaApplicationStore();
    const selectedVisaApplicationType = ref("");
    const updateSelectedVisaApplication = async ()=>{
        await visaApplicationStore.updateVisaApplicationType(selectedVisaApplicationType.value)
        emits('VisaTypeSelected')
    }

</script>


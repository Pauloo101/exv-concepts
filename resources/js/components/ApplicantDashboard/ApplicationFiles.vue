<template>
    <div>
        <div class="px-8 mt-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3" v-for="(requiredfile, index) in requiredFiles" :key="index" >
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">{{requiredfile}}</label>
                    <input @change="selectFile($event, requiredfile)" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                    <template v-if="uploadedFiles">
                        <label v-if="uploadedFiles[requiredfile]"> File uploaded is {{uploadedFiles[requiredfile].path}} </label>
                    </template>
                    <label v-else > No file added that represent {{requiredfile}} </label>
                </div>
            </div>
        </div>
        <div class="row px-12">
            <button  @click="testupload" :disabled="isUploading" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center disabled:cursor-not-allowed disabled:bg-blue-400">
                <svg v-if="isUploading" aria-hidden="true" role="status" class="inline mr-3 w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
                Upload
            </button>


        </div>
    </div>
</template>
<script setup>
import { computed, inject, ref } from 'vue';
import { ToastEmitter, visaRequirements } from '../../constants/visa-constants';
import { useVisaApplicationStore } from '../../store';
const emitter = inject('emitter');
const files = ref(new FormData());
const selectedFiles = ref([]);
const visaApplicationStore = useVisaApplicationStore()
const selectedVisaType = computed(() => visaApplicationStore.selectedVisaApplicationType);
const uploadedFiles = computed(() => {
    if(visaApplicationStore.visaApplicationForm.file){
        return JSON.parse(visaApplicationStore.visaApplicationForm.files);
    }
    return false
});
const requiredFiles = ref(visaRequirements[selectedVisaType.value]);
const isUploading  = ref(false);
const selectFile = async (e, requiredFile)=>{
    let file = e.target.files[0]
    if (file) {
        files.value.append(requiredFile, file)
        selectedFiles.value.push(requiredFile)
    }else{
        let index = selectedFiles.value.indexOf[requiredFile];
        selectedFiles.value.splice(index, 1);
        files.value.delete(requiredFile)
    }
}
const testupload = async () => {
    isUploading.value = true;
    files.value.append('selectedFiles', selectedFiles.value);
    await visaApplicationStore.uploadFile(files.value);
    emitter.emit(ToastEmitter.SuccessToast, "Files uploaded successfully")
    isUploading.value = false;
}
const cv = ref('')
</script>

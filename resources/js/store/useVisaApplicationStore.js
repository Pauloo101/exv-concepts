import { useLocalStorage } from "@vueuse/core"
import { defineStore } from "pinia";
import { VisaApplicationservice } from "../services/visa-application-service"

export const useVisaApplicationStore = defineStore('visa-application-store',{
  state: () =>{
    return useLocalStorage('visa-application-store',{
            selectedVisaApplicationType:"",
            visaApplicationForm: {
              mobile_number: "",
              country_origin: "",
              accepted: "",
              address: "",
              comments: "",
              files:""
            }
          })
  },
  actions:{
    async updateVisaApplicationType(selectedVisaApplicationType){
      const visaApplicationservice = new VisaApplicationservice();
      const response = await visaApplicationservice.updateVisaApplicationType(selectedVisaApplicationType);
      this.selectedVisaApplicationType = selectedVisaApplicationType
      return response
    },
    async getVisaApplicationType(){
      const visaApplicationservice = new VisaApplicationservice();
      const response = await visaApplicationservice.getVisaApplicationType();
      this.selectedVisaApplicationType = response
      return response
    },
    async getApplicationForm(){
      const visaApplicationservice = new VisaApplicationservice();
      const response  = await visaApplicationservice.getApplicationForm();
      this.visaApplicationForm =  {
        mobile_number : response.mobile_number || "",
        country_origin : response.country_origin || "",
        // accepted : response.accepted || "",
        address : response.address || "",
        comments : response.comments || "",
        files : response.files || {},
      }
      return response
    },
    async saveApplicationForm (applicationForm){
      const visaApplicationservice = new VisaApplicationservice();
      const response = await visaApplicationservice.saveApplicationForm(applicationForm);

    },
    async uploadFile(formDataIncludingFiles){
      const visaApplicationservice = new VisaApplicationservice();
      const response = await visaApplicationservice.uploadFile(formDataIncludingFiles);
    }
  },
})

import axios from "axios"

export class VisaApplicationservice{
  constructor(baseUrl){
    this.baseUrl = baseUrl || window.origin
  }

  async getVisaApplicationType(){
    try {
      const response  = await axios.get('/api/user/visa-type')
      return response.data
    } catch (error) {
      throw new Error('Failed to get Visa Type')
    }
  }

  async updateVisaApplicationType(visaType){
    try {
      const response = await axios.post('/api/user/update-visa-type', {
        visa_type: visaType
      });
      return response.data
    } catch (error) {
      throw new Error('Failed to update visa Application Type')
    }
  }

  async getApplicationForm(){
    try {
      const response = await axios.get('/api/user/application-form')
      return response.data
    } catch (errors) {
      throw new Error('Failed to get application form');
    }
  }

  async saveApplicationForm(applicationForm){
    try {
      const response = await axios.post('/api/user/save-form', {
        ...applicationForm
      });
      return response.data;
    } catch (errors) {
      throw new Error('Failed to save applicationForm')
    }
  }

  async uploadFile(formDataIncludingFiles){
    try {
      const response = await axios.post('/api/user/upload-file', formDataIncludingFiles,{
        headers: { "Content-Type": "multipart/form-data" },
        onUploadProgress: function(progressEvent) {
          this.uploadPercentage = parseInt(
            Math.round((progressEvent.loaded / progressEvent.total) * 100)
          );
        }
      })
      return response.data
    } catch (errors) {
      throw new Error('Failed to upload file(s)')
    }
  }

}

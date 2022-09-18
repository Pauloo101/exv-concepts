import axios from "axios";

export class AdminService{
  constructor(baseUrl){
    this.baseUrl = baseUrl || window.origin;
  }

  async getTier4ToTier2Applicant(){
    try {
      const response = await axios.get('api/admin/tier4-to-tier2')
      return response.data
    } catch (error) {
      throw new Error('failed to load tier4-to-tier2 data')
    }
  }

  async getDirectWorkVisa(){
    try {
      const response = await axios.get('api/admin/get-direct-work-visa')
      return response.data
    } catch (error) {
      throw new Error('failed to load direct-work-visa data')
    }
  }

  async addComments({comment, applicant_id}){
    try {
      const response = await axios.post('api/admin/add-comment', {
        params:{
          comment: comment,
          applicant_id:applicant_id
        }
      })
    } catch (error) {
      throw new Error('failed to add comment data')
    }
  }

  async setApplicantInterview({applicant_id, interview}){
    try {
      const response = await axios.post('api/admin/set-applicant-interview',{
        applicant_id: applicant_id,
        interview: interview
      })
      return response.data
    } catch (error) {
      throw new Error(' failed to set interview data')
    }
  }

  async downloadFile({applicant_id, filename}){
      await axios({
              url: "/api/admin/download-file",
              methods: "GET",
              params: {
                  applicant_id: applicant_id,
                  filename:filename
              },
              responseType: "blob"
      })
      .then(response => {
            var fileURL = window.URL.createObjectURL(
                new Blob([response.data])
            );
            var fileLink = document.createElement("a");
            fileLink.href = fileURL;
            fileLink.setAttribute("download", filename);
            document.body.appendChild(fileLink);
            fileLink.click();
      })
      .catch(err => {
          console.log(err);
      });
  }

}

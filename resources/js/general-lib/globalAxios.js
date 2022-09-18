import axios from "axios";

export function setAxiosGlobally(){
    let bearerToken = localStorage.getItem("bearerToken") || localStorage.getItem('adminBearerToken') || null;
    axios.defaults.headers.common['Authorization'] = `Bearer ${bearerToken}`
    axios.interceptors.request.use((config) =>{
      return config
    });
    axios.interceptors.response.use(
      (response) =>{
        return response
      },
      (error)=>{
        console.log(error)
        if(error.response.data.error == "Unauthenticated" || error.response.data.error == "CSRF token mismatch."){
          location.replace('/');
        }
      }
    );
    window.axios = axios;
}

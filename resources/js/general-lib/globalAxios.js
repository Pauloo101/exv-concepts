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
        // console.log(error.response.data)
        if(error.response.data.message == "Unauthenticated." || error.response.data.error == "CSRF token mismatch."){
          localStorage.removeItem("bearerToken");
          localStorage.removeItem("adminBearerToken");
          location.replace('/');
        }
      }
    );
    window.axios = axios;
}

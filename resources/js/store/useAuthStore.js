import { defineStore } from 'pinia'
import { useLocalStorage } from '@vueuse/core'
import { AuthService } from '../services/auth-service'
// const authService = new AuthService();
export const useAuthStore = defineStore('auth', {
  state: ()=>{
   return useLocalStorage('auth',{
            user:null,
            adminUser:null,
          })
  },
  actions: {
    async userLogin({email, password}){
      const authService = new AuthService();
      const response = await authService.userLogin({email, password});
      this.user = response.user
      return response;
    },
    async adminLogin({email, password}){
      const authService = new AuthService();
      const response = await authService.adminLogin({email, password});
      this.adminUser = response.user
      return response;
    },
    async userRegister({email, password, firstName, lastName}){
      const authService = new AuthService();
      const response = await authService.userRegister({email, password, firstName, lastName});
      this.user = response.user;
      return response;
    }
  },
  getters:{
    isAuth: (state) => {
      return localStorage.getItem('bearerToken') || false;
    },
    isAuthAdmin: (state) => {
      return localStorage.getItem('adminBearerToken') || false;
    }
  }
})

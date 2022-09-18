import { createRouter, createWebHistory } from "vue-router"
import { MyApplication } from "../components/ApplicantDashboard";
import { UserInfo, UserTable } from "../components/users";
import { LoginPage, RegisterPage, AdminLoginPage, AdminDashboardPage } from "../pages";
import { useAuthStore } from "../store";
const requireAuthAdmin = (to , from, next) =>{
  // const authStore = useAuthStore();
  if(localStorage.getItem('adminBearerToken')) next();
  else next({name:'Admin'})
}

const requireUserAuth = (to , from , next) =>{
  // const authStore = useAuthStore();
  if(localStorage.getItem('bearerToken')) next();
  else next({name:'Login'})
}

const requireGuest= (to , from , next) =>{
  // const authStore = useAuthStore();
  if(localStorage.getItem('bearerToken')){
    next({name:'MyApplication'})
  }else if(localStorage.getItem('adminBearerToken')){
    next({name:'Admin'})
  }else{
    next()
  }
}


const routes =[
    {
      path:'/',
      name:'Login',
      component:LoginPage,
      beforeEnter:requireGuest
    },
    {
      path:'/myapplication',
      name:'MyApplication',
      component:MyApplication,
      beforeEnter:requireUserAuth
    },
    {
      path:'/register',
      name:'Register',
      component:RegisterPage,
      beforeEnter:requireGuest
    },
    {
      path:'/admin',
      name:'Admin',
      component:AdminLoginPage,
      beforeEnter:requireGuest
    },
    {
      path:'/dashboard',
      name:'Dashboard',
      component:AdminDashboardPage,
      beforeEnter:requireAuthAdmin,
      children:[
        {path:'/dashboard', component:UserTable},
        {path:'/dashboard/userinfo', component:UserInfo}
      ]
    }
]

const router = createRouter({
  history:createWebHistory(),
  routes:routes
})


export default router;

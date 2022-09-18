import axios from "axios"
import { setAxiosGlobally } from "../general-lib/globalAxios"

export class AuthService {


    constructor(baseUrl) {
      this.baseUrl = baseUrl || window.origin
    }

    async userLogin({email, password}) {
      try {
        const response = await axios.post('/api/userlogin', {
          email: email,
          password: password
        })
        localStorage.setItem('bearerToken', response.data.token)
        setAxiosGlobally();
        return response.data
      } catch (errors) {
        // Notification of error
        return false
      }
    }

    async adminLogin({email, password}) {
      try {
        const response = await axios.post(`${this.baseUrl}/api/adminlogin`, {
          email: email,
          password: password
        })
        localStorage.setItem('adminBearerToken', response.data.token)
        setAxiosGlobally();
        return response.data
      } catch (errors) {
        // Notification of erroe
        return false
      }
    }

    async userRegister({email, password, firstName, lastName}) {
      try {
          const response = await axios.post(`${this.baseUrl}/api/userregister`, {
            first_name: firstName,
            last_name: lastName,
            password: password,
            email: email
          })
          localStorage.setItem('bearerToken', response.data.token)
          setAxiosGlobally();
          return response.data
      } catch (errors) {
        throw new Error('User registration failed')
      }

    }


}

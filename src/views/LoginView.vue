<script setup>
    import axios from 'axios'
    const api_url = "http://localhost/eljohn_perez2/api/";
    
    
    async function form() {
        let myForm = document.getElementById("logForm")
        let alert = document.getElementById("errAlert")
        let formData = new FormData(myForm);
      try {
        const response = await axios.post(api_url+'login', formData);
        console.log(response);
          if(response.data.code == 1) {
            //   const redirectPath = route.query.redirect || '/dashboard';
            //   router.push(redirectPath)
            location.href = '/dashboard';
            localStorage.setItem("apiData", JSON.stringify(response.data.sess_data));
            alert.classList.add("hidden");
          }else{
            alert.classList.remove("hidden");
          }
        
      } catch (error) {
        console.error('Error fetching data:', error);
      }
   }
   
</script>

<template>
    <div class="container mx-auto flex justify-center items-center h-screen bg-gray-300">
        <div class="max-w bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 w-96">
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Login</h5>
                </a>
                    <div class="hidden p-2 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" id="errAlert" role="alert">
                      Incorrect email or password
                    </div>
                <form @submit.prevent="form" id="logForm">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

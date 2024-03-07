<script setup>
    import axios from 'axios'
    import { ref, onMounted } from 'vue'
    
    const access = ref([]);
    const api_url = "http://localhost/eljohn_perez2/api/";
    
    onMounted(async () => {
      try {
        const response = await axios.get(api_url+'get-access');
        access.value = response.data.data;
        
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    });
    
    async function addEmployee() {
        let alert = document.getElementById("errAlert")
        let myForm = document.getElementById("addEmpForm")
        let formData = new FormData(myForm);
        
      try {
        const response = await axios.post(api_url+'add-employee', formData);
        console.log(response);
        
          if(response.data.code == 1) {
            alert.classList.remove("hidden");
            location.reload();
          }else{
            alert.classList.add("hidden");
          }
        
      } catch (error) {
        console.error('Error fetching data:', error);
      }
   }
   
</script>

<template>


    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                       Create new employee
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                
                    <div class="hidden p-2 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" id="errAlert" role="alert">
                      Employee Created Successfully
                    </div>
                    
                    <form @submit.prevent="addEmployee" id="addEmpForm">
                        <div>
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname</label>
                            <input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                        <div>
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname</label>
                            <input type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                            <input type="number" name="age" id="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="job_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job title</label>
                            <input type="text" name="job_title" id="job_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="access_level_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Access level</label>
                            <select id="access_level_id" name="access_level_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option selected disabled>Select access level</option>
                                <option v-for="role in access" :key="role.id" :value="role.access_level_id">
                                    {{role.description}}
                                </option>
                            </select>
                        </div>
                        
                         <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="text" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="birth_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                            <input type="date" name="birth_date" id="birth_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                        <button type="submit" class="mt-5 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save employee</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<style lang="scss" scoped>

</style>
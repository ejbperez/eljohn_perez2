<script setup>
    import AddModal from '@/components/AddModal.vue';
    import axios from 'axios'
    import {provide, ref, onMounted } from 'vue'
    
    const api_url = "http://localhost/eljohn_perez2/api/";
    const employees = ref([]);
    const selectedOption = ref('');
    const firstname = ref('');
    const lastname = ref('');
    const email = ref('');
    const job_title = ref('');
    const emp_id = ref('');
    const user = ref('');
    
    const access_level = ref('');
    
    onMounted(() => {
      loadEmployee();
      
        let getStorage =  localStorage.getItem('apiData')
        let access = JSON.parse(getStorage);
        
        access_level.value = access.access_level_id;
        user.value = access.firstname;
        // let dataObj = {'id':JSON.parse(getStorage.id)}
    
        // console.log(id)
      
    });
    
    async function loadEmployee() {
      try {
        
        const response = await axios.post(api_url+'get-employees',{'access_level': selectedOption.value});
        employees.value = response.data.data;
        
      } catch (error) {
        console.error('Error fetching data:', error);
      }
      
   }
   
   async function logout() {
      location.href = '/';
      localStorage.clear();
   }
   
   
   async function openModal(id) {
        let modal = document.getElementById("update-modal")
        modal.classList.remove("hidden");
        
        try {
            
            const response = await axios.post(api_url+'get-employeebyid',{'id':id});
            
            emp_id.value = response.data.data[0].id;
            firstname.value = response.data.data[0].firstname;
            lastname.value = response.data.data[0].lastname;
            email.value = response.data.data[0].email;
            job_title.value = response.data.data[0].job_title;
            
        } catch (error) {
            console.error('Error fetching data:', error);
        }
   }
   
   function closeModal() {
        let modal = document.getElementById("update-modal")
        modal.classList.add("hidden");
   }
   
   
   async function updateEmployee() {
        let myForm = document.getElementById("updateForm")
        let formData = new FormData(myForm);
        
        // for (const value of formData.values()) {
        //   console.log(value);
        // }
        // return false
        
      try {
        const response = await axios.post(api_url+'update-employee', formData);
        console.log(response);
        
          if(response.data.code == 1) {
            location.reload();
          }else{
            console.log(response)
          }
        
      } catch (error) {
        console.error('Error fetching data:', error);
      }
   }
   
   async function deleteEmployee(id) {
      try {
        await axios.post(api_url+'delete-employee', {'id': id});
        location.reload();
      } catch (error) {
        console.error('Error fetching data:', error);
      }
   }
   
</script>

<template>
    <AddModal/>
    
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
       <span class="sr-only">Open sidebar</span>
       <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
       </svg>
    </button>
    
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
       <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <div class="text-center mb-5">
            <span class="h4 uppercase ">Welcome</span><br>
            <span class="text-3xl">{{user}}</span><br>
        </div>
        <hr>
          <ul class="space-y-2 font-medium mt-5">
             <li>
                <a href="#" class="bg-blue-200 flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-blue-300 dark:hover:bg-gray-700 group">
                   <span class="ms-3">Dashboard</span>
                </a>
             </li>
             
              <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group" @click="logout">
                   <span class="ms-3">Logout</span>
                </a>
             </li>
          </ul>
       </div>
    </aside>
    
    <div class="p-4 sm:ml-64">
       <div class="p-4 rounded-lg">
          <div class="mt-5">
            
                <div class="inline-flex mb-5 py-5 px-3" role="group">
                 <button type="button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add Employee</button>
                 
                <select  v-model="selectedOption" @change="loadEmployee" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 blockpx-5 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value>All</option>
                    <option value="1">Super User</option>
                    <option value="2">Normal User</option>
                 </select>
                    
                </div>
               
                  <div class="relative overflow-x-auto">
                      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                              <th scope="col" class="px-6 py-3">
                                  Employee name
                              </th>
                              <th scope="col" class="px-6 py-4">
                                  Email
                              </th>
                              <th scope="col" class="px-6 py-4">
                                  Job title
                              </th>
                              <th scope="col" class="px-6 py-4">
                                  Access level
                              </th>
                              <th scope="col" class="px-6 py-4">
                                  Date created
                              </th>
                              <th scope="col" class="px-6 py-4">
                                  Action
                              </th>
                          </thead>
                          <tbody>
                              <tr v-for="employee in employees" :key="employee.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-70">
                                <td class="px-6 py-4">{{ employee.firstname }} {{ employee.lastname }}</td>
                                <td class="px-6 py-4">{{ employee.email }}</td>
                                <td class="px-6 py-4">{{ employee.job_title }}</td>
                                <td class="px-6 py-4">{{ employee.description }}</td>
                                <td class="px-6 py-4">{{ employee.date_created }}</td>
                                <td class="px-6 py-4" v-if="employee.id != 1" >
                                    <div v-if="access_level == 1">
                                    
                                        <button type="button" data-modal-target="update-modal" data-modal-toggle="update-modal" class=" px-3 py-2 text-xs text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" @click="openModal(employee.id)">Update</button>
                                    
                                        <button type="button" class=" px-3 py-2 text-xs text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" @click="deleteEmployee(employee.id)">Delete</button>
                                    
                                    </div>
                                    
                                    <div v-else>
                                    
                                        <button type="button" data-modal-target="update-modal" data-modal-toggle="update-modal" class=" px-3 py-2 text-xs text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800" @click="openModal(employee.id)">Update</button>
                                    
                                    </div>
                                    
                                    
                                </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  
          </div>
       </div>
    </div>
    
    
    <div id="update-modal" tabindex="-1" aria-hidden="true" class="hidden bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]  max-h-full flex shadow" aria-modal="true" role="dialog">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                       Update employee
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal" @click="closeModal">
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
                    
                    <form @submit.prevent="updateEmployee" id="updateForm">
                        <input :value="emp_id" type="hidden" name="id" id="id" required />
                        <div>
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname</label>
                            <input :value="firstname" type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                        <div>
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname</label>
                            <input :value="lastname" type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input :value="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        
                         <div>
                            <label for="job_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job title</label>
                            <input :value="job_title" type="text" name="job_title" id="job_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                       
                        <button type="submit" class="mt-5 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :data-id="emp_id">Save changes</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<style lang="scss" scoped>

</style>
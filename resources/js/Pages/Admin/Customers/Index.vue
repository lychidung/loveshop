<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


defineProps({
     Customers: Object,
});

const CustomertUse = useForm({

});

function limitCharacters(text, limit) {
     if (text && text.length > limit) {
          return text.substring(0, limit) + '...';
     }
     return text;
}

function destroy(name, id, status) {
     if(status === 1)
     {
          Swal.fire({
          title: '"' + name + '"',
          text: "Do you want to lock account this?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "btn-success",
          confirmButtonText: "Yes, lock it!"
     }).then((result) => {
          if (result.isConfirmed) {
               Swal.fire({
                    title: "Locked!",
                    text: "The account has been locked.",
                    icon: "success"
               });
               CustomertUse.delete(route('customers.lock', id));
          }
     });
     }
     else{
          Swal.fire({
          title: '"' + name + '"',
          text: "Do you want to unlock account this?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "btn-success",
          confirmButtonText: "Yes, lock it!"
     }).then((result) => {
          if (result.isConfirmed) {
               Swal.fire({
                    title: "Unlocked!",
                    text: "The account has been unlocked.",
                    icon: "success"
               });
               CustomertUse.delete(route('customers.lock', id));
          }
     });
     }
     
};

function create() {
     CustomertUse.get(route('customers.create'));
}

</script>

<template>

     <Head title="Quản lý sản phẩm" />
     <AuthenticatedLayout>
          <div class="flex">
               <SlideBar> </SlideBar>
               <div class="py-12 w-full">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                              <div class="card">
                                   <div class="p-6">

                                        <div class="items-center justify-between mb-6">

                                             <h3 class="card-title mr-6 mb-6">Customers Management</h3>

                                             <div class="flex items-center justify-between">
                                                  <Search></Search>

                                                  <!-- <ButtonCreate @click="create()"></ButtonCreate> -->

                                             </div>
                                        </div>

                                        <div class="overflow-x-auto">
                                             <div class="min-w-full inline-block align-middle">
                                                  <div class="overflow-hidden">
                                                       <table
                                                            class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                            <thead>
                                                                 <tr>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           ID.
                                                                      </th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Name
                                                                      </th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Phone</th>

                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Email</th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Status</th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Action</th>

                                                                 </tr>
                                                            </thead>
                                                            <tbody
                                                                 v-if="Customers && Customers.data.length > 0"
                                                                 class="divide-y divide-gray-200 dark:divide-gray-700">
                                                                 <tr v-for="customers in Customers.data"
                                                                      class="bg-gray-50 dark:bg-gray-700/50 ">
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           #{{ customers.id }}
                                                                      </td>
                                                                      <th scope="row"
                                                                           class="flex items-center gap-2 px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                                           <img class="w-20 h-20 "
                                                                                :src="'/Images/' + customers.image"
                                                                                alt="Product Image">
                                                                           <div
                                                                                class="text-wrap ml-4 text-sm font-medium text-gray-500 dark:text-gray-200">
                                                                                {{ customers.name }}
                                                                           </div>
                                                                      </th>
                                                                      
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           {{ customers.phone }}
                                                                      </td>
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           {{ customers.email }}
                                                                      </td>
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           <span v-if="customers.status === 0"
                                                                                class="text-xs text-white bg-danger rounded-md px-1 py-0.5">Private</span>
                                                                           <span v-if="customers.status === 1"
                                                                                class="text-xs text-white bg-success rounded-md px-1 py-0.5">Public</span>
                                                                      </td>
                                                                      <td class="px-4 py-4 justi">
                                                                           <div class="flex justify-center">
                                                                                
                                                                                <button
                                                                                     @click="destroy(customers.name, customers.id, customers.status)"
                                                                                     type="button"
                                                                                     class="m-4 text-white ">
                                                                                     <i class="mdi mdi-cog">
                                                                                          

                                                                                          <svg class="fill-current text-gray-600 hover:text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                                                               viewBox="0 0 50 50"
                                                                                               width="20px"
                                                                                               height="20px">
                                                                                               <path
                                                                                                    d="M 25 3 C 18.363281 3 13 8.363281 13 15 L 13 20 L 9 20 C 7.355469 20 6 21.355469 6 23 L 6 47 C 6 48.644531 7.355469 50 9 50 L 41 50 C 42.644531 50 44 48.644531 44 47 L 44 23 C 44 21.355469 42.644531 20 41 20 L 37 20 L 37 15 C 37 8.363281 31.636719 3 25 3 Z M 25 5 C 30.566406 5 35 9.433594 35 15 L 35 20 L 15 20 L 15 15 C 15 9.433594 19.433594 5 25 5 Z M 9 22 L 41 22 C 41.554688 22 42 22.445313 42 23 L 42 47 C 42 47.554688 41.554688 48 41 48 L 9 48 C 8.445313 48 8 47.554688 8 47 L 8 23 C 8 22.445313 8.445313 22 9 22 Z M 25 30 C 23.300781 30 22 31.300781 22 33 C 22 33.898438 22.398438 34.6875 23 35.1875 L 23 38 C 23 39.101563 23.898438 40 25 40 C 26.101563 40 27 39.101563 27 38 L 27 35.1875 C 27.601563 34.6875 28 33.898438 28 33 C 28 31.300781 26.699219 30 25 30 Z" />
                                                                                          </svg>
                                                                                     </i>
                                                                                </button>

                                                                           </div>

                                                                      </td>

                                                                 </tr>

                                                            </tbody>
                                                       </table>
                                                  </div>

                                             </div>
                                        </div>
                                        <Pagination
                                             class="text-blue-800  flex justify-end mt-6 px-6 sm:items-center sm:justify-right"
                                             :links="Customers.links"></Pagination>
                                   </div>

                              </div>

                         </div>
                    </div>

               </div>

          </div>

     </AuthenticatedLayout>

</template>

<script>

const deleteProduct = (name, id) => {
     Swal.fire({
          title: '"' + name + '"',
          text: "Do you want to delete this product?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
     }).then((result) => {
          if (result.isConfirmed) {
               Swal.fire({
                    title: "Deleted!",
                    text: "Your product has been deleted.",
                    icon: "success"
               });
               ProductUse.delete(route('products.destroy', id));

          }
     });
};

</script>
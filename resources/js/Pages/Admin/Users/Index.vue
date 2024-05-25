<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


defineProps({
     Users: Object,
});

// const ProductUse = useForm({

// });

// function destroy(name, id){
//      Swal.fire({
//           title: '"' + name + '"',
//           text: "Do you want to delete this product?",
//           icon: "warning",
//           showCancelButton: true,
//           confirmButtonColor: "#d33",
//           cancelButtonColor: "btn-success",
//           confirmButtonText: "Yes, delete it!"
//      }).then((result) => {
//           if (result.isConfirmed) {
//                Swal.fire({
//                     title: "Deleted!",
//                     text: "Your product has been deleted.",
//                     icon: "success"
//                });
//                ProductUse.delete(route('products.destroy', id));
//           }
//      });
// };

// function create() {
//      ProductUse.get(route('products.create'));
// }

</script>

<template>
     <Head title="Quản lý sản phẩm" />
     <AuthenticatedLayout>
          <div class="flex">
               <SlideBar> </SlideBar>
               <div class="py-12 w-full">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  mb-12">
                              <div class="items-center justify-between mb-2">

                                   <h3 class="mt-5 ml-5 card-title mr-6 mb-6">Users Management</h3>

                                   <div class="m-5 flex items-center justify-between">
                                        <Search></Search>

                                        <ButtonCreate @click="create()"></ButtonCreate>

                                   </div>
                              </div>

                         </div>
                         <div v-if="Users && Users.data.length > 0" class="grid grid-cols-3  overflow-hidden shadow-sm sm:rounded-lg gap-5">
                              <div v-for="users in Users.data" :key="Users.id" class="card">
                                   <div class="text-center">
                                        <div class="text-end p-5 pb-0">
                                             <button data-fc-target="dropdown-target2" data-fc-type="dropdown"
                                                  type="button" data-fc-placement="bottom-end">
                                                  <i class="mdi mdi-dots-vertical text-xl"></i>
                                             </button>
                                        </div>
                                        <div class="p-7 pt-0 -mt-5">
                                             <img :src="'/Images/' +  users.image "
                                                  class="rounded-full h-24 border-4 mx-auto dark:border-gray-700"
                                                  alt="profile-image">

                          
                                             <div class="py-5 text-start">
                                                  <p class="text-gray-400"><strong>Full Name :</strong> <span
                                                            class="ms-2">{{ users.name }}</span></p>

                                                  <p class="text-gray-400 pt-3"><strong>Address :</strong><span
                                                            class="ms-2">{{ users.address }}</span></p>

                                                  <p class="text-gray-400 pt-3"><strong>Email :</strong> <span
                                                            class="ms-2">{{ users.email }}</span></p>

                                                  <p class="text-gray-400 pt-3"><strong>Gender :</strong> <span
                                                            class="ms-2">{{ users.gender }}</span></p>
                                             </div>

                                             <button type="button"
                                                  class="btn bg-primary text-white rounded-full hover:bg-primary/80 transition-all duration-500">Lock account</button>
                                        </div>
                                   </div>
                              </div><!-- end card -->

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
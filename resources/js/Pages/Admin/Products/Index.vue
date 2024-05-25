<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


defineProps({
     product: Object,
});

const ProductUse = useForm({
     searchProduct: ""
});

function destroy(name, id) {
     Swal.fire({
          title: '"' + name + '"',
          text: "Do you want to delete this product?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "btn-success",
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

function create() {
     ProductUse.get(route('products.create'));
}

function submitForm() {
     
    window.location.href = "/Admin/Products/Index?searchProduct=" + ProductUse.searchProduct;
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

                                             <h3 class="card-title mr-6 mb-6">Product Management</h3>

                                             <div class="flex items-center justify-between">
                                                  <form class="flex flex-col gap-6" @submit.prevent="submitForm"
                                                       name="createForm" method="GET" enctype="multipart/form-data">
                                                       <div class=" md:flex hidden items-center relative w-80">
                                                            <div
                                                                 class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
                                                                 <svg xmlns="http://www.w3.org/2000/svg"
                                                                      viewBox="0 0 50 50" class="opacity-60"
                                                                      width="16px" height="16px">
                                                                      <path
                                                                           d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z" />
                                                                 </svg>
                                                            </div>
                                                            <input type="text"
                                                                 class="form-input pe-8 ps-4 bg-gray-500/10 border-transparent focus:border-transparent placeholder:opacity-60"
                                                                 placeholder="Search..." v-model="searchProduct">
                                                       </div>
                                                  </form>
                                                  <ButtonCreate @click="create()"></ButtonCreate>

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
                                                                           Product
                                                                      </th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Price</th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           In-stock</th>
                                                                      <th scope="col"
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                                           Status</th>
                                                                      <th scope="col "
                                                                           class="px-4 py-4 text-start text-sm font-medium text-gray-500 flex place-content-center">
                                                                           Action</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody v-if="product && product.data.length > 0"
                                                                 class="divide-y divide-gray-200 dark:divide-gray-700">
                                                                 <tr v-for="products in product.data"
                                                                      class="bg-gray-50 dark:bg-gray-700/50 ">
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           #{{ products.id_product }}
                                                                      </td>
                                                                      <th scope="row"
                                                                           class="flex items-center gap-2 px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                                           <img class="w-20 h-20 "
                                                                                :src="'/Images_product/' + products.image"
                                                                                alt="Product Image">
                                                                           <div
                                                                                class="text-wrap ml-4 text-sm font-medium text-gray-500 dark:text-gray-200">

                                                                                {{ products.product_name }}
                                                                           </div>
                                                                      </th>
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           {{ products.price }}</td>
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           {{ products.total_in_stock }}</td>
                                                                      <td
                                                                           class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                           <span v-if="products.status === 0"
                                                                                class="text-xs text-white bg-danger rounded-md px-1 py-0.5">Private</span>
                                                                           <span v-if="products.status === 1"
                                                                                class="text-xs text-white bg-success rounded-md px-1 py-0.5">Selling</span>
                                                                      </td>
                                                                      <td class="px-4 py-4 justi">
                                                                           <div class="flex justify-center">
                                                                                <a :href="route('products.edit', { id: products.id_product })"
                                                                                     type="button"
                                                                                     class="m-4 text-white">
                                                                                     <i class="mdi mdi-cog">
                                                                                          <svg class="fill-current text-gray-600 hover:text-yellow-500"
                                                                                               xmlns="http://www.w3.org/2000/svg"
                                                                                               viewBox="0 0 50 50"
                                                                                               width="20px"
                                                                                               height="20px">
                                                                                               <path
                                                                                                    d="M47.16,21.221l-5.91-0.966c-0.346-1.186-0.819-2.326-1.411-3.405l3.45-4.917c0.279-0.397,0.231-0.938-0.112-1.282 l-3.889-3.887c-0.347-0.346-0.893-0.391-1.291-0.104l-4.843,3.481c-1.089-0.602-2.239-1.08-3.432-1.427l-1.031-5.886 C28.607,2.35,28.192,2,27.706,2h-5.5c-0.49,0-0.908,0.355-0.987,0.839l-0.956,5.854c-1.2,0.345-2.352,0.818-3.437,1.412l-4.83-3.45 c-0.399-0.285-0.942-0.239-1.289,0.106L6.82,10.648c-0.343,0.343-0.391,0.883-0.112,1.28l3.399,4.863 c-0.605,1.095-1.087,2.254-1.438,3.46l-5.831,0.971c-0.482,0.08-0.836,0.498-0.836,0.986v5.5c0,0.485,0.348,0.9,0.825,0.985 l5.831,1.034c0.349,1.203,0.831,2.362,1.438,3.46l-3.441,4.813c-0.284,0.397-0.239,0.942,0.106,1.289l3.888,3.891 c0.343,0.343,0.884,0.391,1.281,0.112l4.87-3.411c1.093,0.601,2.248,1.078,3.445,1.424l0.976,5.861C21.3,47.647,21.717,48,22.206,48 h5.5c0.485,0,0.9-0.348,0.984-0.825l1.045-5.89c1.199-0.353,2.348-0.833,3.43-1.435l4.905,3.441 c0.398,0.281,0.938,0.232,1.282-0.111l3.888-3.891c0.346-0.347,0.391-0.894,0.104-1.292l-3.498-4.857 c0.593-1.08,1.064-2.222,1.407-3.408l5.918-1.039c0.479-0.084,0.827-0.5,0.827-0.985v-5.5C47.999,21.718,47.644,21.3,47.16,21.221z M25,32c-3.866,0-7-3.134-7-7c0-3.866,3.134-7,7-7s7,3.134,7,7C32,28.866,28.866,32,25,32z" />
                                                                                          </svg>
                                                                                     </i>
                                                                                </a>
                                                                                <button
                                                                                     @click="destroy(products.product_name, products.id_product)"
                                                                                     type="button"
                                                                                     class="m-4 text-white ">
                                                                                     <i class="mdi mdi-cog">
                                                                                          <svg class="fill-current text-gray-600 hover:text-red-600"
                                                                                               xmlns="http://www.w3.org/2000/svg"
                                                                                               viewBox="0 0 32 32"
                                                                                               width="20px"
                                                                                               height="20px">
                                                                                               <path
                                                                                                    d="M 13.59375 4 L 13.28125 4.28125 L 12.5625 5 L 6 5 L 6 7 L 7 7 L 7 25 C 7 26.644531 8.355469 28 10 28 L 22 28 C 23.644531 28 25 26.644531 25 25 L 25 7 L 26 7 L 26 5 L 19.4375 5 L 18.71875 4.28125 L 18.40625 4 Z M 14.4375 6 L 17.5625 6 L 18.28125 6.71875 L 18.59375 7 L 23 7 L 23 25 C 23 25.554688 22.554688 26 22 26 L 10 26 C 9.445313 26 9 25.554688 9 25 L 9 7 L 13.40625 7 L 13.71875 6.71875 Z M 11 11 L 11 22 L 13 22 L 13 11 Z M 15 11 L 15 22 L 17 22 L 17 11 Z M 19 11 L 19 22 L 21 22 L 21 11 Z" />
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
                                             :links="product.links"></Pagination>
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
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

defineProps({
    Orders: Object,
    OrderDetails: Object,
    Vouchers: Object,
});


</script>
<template>
    {{ ProductItem }}

    <Head title="Quản lý sản phẩm" />
    <AuthenticatedLayout>
        <div class="flex">
            <SlideBar> </SlideBar>
            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="card">
                            <div class="p-6">
                                <div class="mb-10">
                                    <div class="flex flex-wrap justify-between items-center pb-7">

                                        <div>
                                            <a href="index.html" class="flex justify-center">
                                                <div
                                                    class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                                    <svg id="Layer_1" data-name="Layer 1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.22 74.57">
                                                        <title>love</title>
                                                        <path class="cls-1"
                                                            d="M25,58.52l-2.07,12L0,72.3q.9-9.42,1.81-18.75t2-18.76H17.82q-1.08,5.93-2.11,11.83T14,58.52c.85,0,1.68,0,2.51,0H19l3,0c1,0,2,0,3,0Zm34.54-5.3A20.12,20.12,0,0,1,58.56,58a19.89,19.89,0,0,1-2,4.29,20.37,20.37,0,0,1-2.88,3.66,19.36,19.36,0,0,1-3.66,2.85,18.24,18.24,0,0,1-4.29,1.85,17.25,17.25,0,0,1-4.81.67,16.62,16.62,0,0,1-4.58-.63,16,16,0,0,1-4-1.74,15,15,0,0,1-5.64-6.21,16.91,16.91,0,0,1-1.63-8.77A19.92,19.92,0,0,1,26,49.31a20.52,20.52,0,0,1,2-4.25,21.16,21.16,0,0,1,2.86-3.67l.08-.08.2.33c.55.85,1.08,1.68,1.62,2.56l2.61,4.34a3.16,3.16,0,0,0,2.78,1.58,6.69,6.69,0,0,0-.74,1.28,7.13,7.13,0,0,0-.55,2.26A7.92,7.92,0,0,0,37,55.93a6.23,6.23,0,0,0,.81,2,4.74,4.74,0,0,0,1.49,1.5,4.08,4.08,0,0,0,2.19.56,5.3,5.3,0,0,0,2.33-.5,5.76,5.76,0,0,0,1.82-1.35,7.39,7.39,0,0,0,1.23-2,7.61,7.61,0,0,0,.56-2.29,7.45,7.45,0,0,0-.17-2.27,5.74,5.74,0,0,0-.84-1.94,4.62,4.62,0,0,0-1.5-1.38,4.26,4.26,0,0,0-2-.52l2.18-1.24c.84-.48,1.61-.91,2.44-1.36,1.54-.84,3.24-1.78,5-2.86,1-.6,2-1.23,2.93-1.88l.13.13a13.87,13.87,0,0,1,3.11,5.47,18.89,18.89,0,0,1,.71,7.14ZM94.31,36,81.59,72.57l-13.46.75L58.7,38l12.9-1.19,3.6,20.54L82,35.23,94.31,36Zm27.83,16.05a36,36,0,0,1-.68,4.7q-4.65.3-9.27,1L103,59.06a6.08,6.08,0,0,0,2,3.11,5.27,5.27,0,0,0,3.49,1.16,8.23,8.23,0,0,0,2.4-.4,21.9,21.9,0,0,0,2.63-1c.87-.4,1.72-.85,2.53-1.31s1.52-.89,2.1-1.27L115.82,71.6A13.45,13.45,0,0,1,113.43,73a16.29,16.29,0,0,1-2.62.92,20,20,0,0,1-2.72.52,24.31,24.31,0,0,1-2.66.16,14.94,14.94,0,0,1-4.83-.73,12.89,12.89,0,0,1-3.85-2,13.6,13.6,0,0,1-2.92-3.09,17,17,0,0,1-1.94-3.89,21.4,21.4,0,0,1-1-4.47,23.52,23.52,0,0,1-.09-4.75,27.44,27.44,0,0,1,.85-5,26.49,26.49,0,0,1,1.76-4.85,22.81,22.81,0,0,1,2.68-4.3A19,19,0,0,1,99.67,38a16.11,16.11,0,0,1,4.47-2.33,16.38,16.38,0,0,1,5.34-.84,13.31,13.31,0,0,1,4.34.67,10.89,10.89,0,0,1,3.4,1.83,11.51,11.51,0,0,1,2.49,2.8,14.67,14.67,0,0,1,1.61,3.55,19.75,19.75,0,0,1,.79,4.09,24.39,24.39,0,0,1,0,4.36Zm-10.7-1.41a8.08,8.08,0,0,0,0-1.55,4.38,4.38,0,0,0-.43-1.45,2.81,2.81,0,0,0-.87-1.06,2.32,2.32,0,0,0-1.46-.42,3.36,3.36,0,0,0-1.94.58,6,6,0,0,0-1.53,1.45,9.9,9.9,0,0,0-1.13,1.91,16.33,16.33,0,0,0-.71,1.89l8.06-.75,0-.6Z" />
                                                        <path class="cls-2"
                                                            d="M44.11,24.59c2.54-1.54,4.42-3,7.57-2.49,5.92.88,9.63,8.18,5.18,13.19A26.9,26.9,0,0,1,51,39.66c-2.61,1.56-5.43,3-7.43,4.18L38.12,47l-2.65-4.39c-3.18-5.28-8.79-12.35-7.29-18.86,1.05-4.56,5.39-6.49,9.47-5.35,3.65,1,4.7,3.26,6.46,6.23Z" />
                                                        <path class="cls-3"
                                                            d="M35.16,9.89C39,7.56,41.82,5.42,46.59,6.13c7.07,1,12.06,8.18,10.49,14.85a11.43,11.43,0,0,0-4.95-2,10.23,10.23,0,0,0-6.94,1.3,10.63,10.63,0,0,0-6.69-4.94L38,15.19a11.05,11.05,0,0,0-7.68.93c-.26.14-.51.29-.76.45a10,10,0,0,0-4.44,5.94c0,.16-.09.34-.13.54-1.49,6.49,2.36,12.77,5.73,18l-4.56,2.61-4-6.63c-4.81-8-13.27-18.67-11-28.49C12.68,1.68,19.23-1.25,25.4.49c5.51,1.56,7.1,4.93,9.76,9.4Z" />
                                                    </svg>
                                                </div>

                                            </a>
                                        </div> <!-- logo-dark end -->

                                        <div>
                                            <h4 class="text-lg dark:text-white">Invoice<br>
                                                <strong>Staff: #{{ Orders.id_user }}</strong>
                                            </h4>
                                        </div>

                                    </div> <!-- flex-end -->
                                    <hr class="dark:border-gray-700">
                                </div>

                                <div class="mb-14">
                                    <div class="flex flex-wrap items-center justify-between gap-6">

                                        <div>
                                            <p class="font-medium dark:text-white mb-0.5"><b> {{ Orders.full_name }} </b></p>
                                            <p class="text-sm">
                                                {{ Orders.address }} <br>
                                                0{{ Orders.phone }}</p>
                                        </div> <!-- col-end -->

                                        <div>
                                            <div class="flex sm:justify-end space-y-2">

                                                <div class="grid gap-3">

                                                    <div class="grid grid-cols-4 gap-x-3">
                                                        <h6
                                                            class="col-span-2 font-semibold text-gray-500 dark:text-gray-200">
                                                            Order Date:</h6>
                                                        <p class="col-span-2 sm:text-end text-gray-400">{{
        Orders.date_order }}</p>
                                                    </div> <!-- grid-end -->

                                                    <div class="grid grid-cols-4 gap-x-3">
                                                        <h6
                                                            class="col-span-2 font-semibold text-gray-500 dark:text-gray-200">
                                                            Order Status:</h6>
                                                        <p class="col-span-2 sm:text-end text-gray-400">
                                                            <span v-if="Orders.status === 1"
                                                                class="inline-flex items-center px-1 text-xs font-medium">
                                                                Pending </span>
                                                            <span v-if="Orders.status === 2"
                                                                class="inline-flex items-center px-1 text-xs font-medium">
                                                                Processing </span>
                                                            <span v-if="Orders.status === 3"
                                                                class="inline-flex items-center px-1 text-xs font-medium">
                                                                Delivered </span>
                                                            <span v-if="Orders.status === 0"
                                                                class="inline-flex items-center px-1 text-xs font-medium">
                                                                Cancel </span>


                                                        </p>
                                                    </div> <!-- grid-end -->

                                                    <div class="grid grid-cols-4 gap-x-3">
                                                        <h6
                                                            class="col-span-2 font-semibold text-gray-500 dark:text-gray-200">
                                                            Order ID:</h6>
                                                        <p class="col-span-2 sm:text-end text-gray-400">
                                                            #{{ Orders.id }}</p>
                                                    </div> <!-- grid-end -->

                                                </div> <!-- grid-end -->

                                            </div> <!-- flex-end -->
                                        </div> <!-- col-end -->

                                    </div> <!-- grid-end -->
                                </div>

                                <div class="mb-5">
                                    <div class="flex flex-col">
                                        <div class="-m-1.5 overflow-x-auto">
                                            <div class="p-1.5 min-w-full inline-block align-middle">
                                                <div class="overflow-hidden">

                                                    <table class="min-w-full">

                                                        <thead
                                                            class="border-b py-3 border-gray-200 dark:border-gray-600">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    #</th>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    Item</th>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    Size</th>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    Color</th>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    Quantity</th>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    Price</th>
                                                                <th scope="col"
                                                                    class="px-4 py-4 text-left text-sm font-medium text-gray-500 dark:text-white">
                                                                    Amount</th>
                                                            </tr> <!-- tr-end -->
                                                        </thead> <!-- thead-end -->
                                                        <tbody v-if="OrderDetails && OrderDetails.data.length > 0">
                                                            <tr v-for="OrderDetail in OrderDetails.data"
                                                                :key="OrderDetail.id_order"
                                                                class="border-b text-gray-500 transition-all duration-300 dark:text-gray-400 dark:border-gray-700">
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200 font-medium">
                                                                    {{ OrderDetail.id_product_variation_sizes }} </td>
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                    {{ OrderDetail.product_name }}</td>
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                    {{ OrderDetail.color_name }}</td>
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                    {{ OrderDetail.size_name }}</td>
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                    {{ OrderDetail.quantity }}</td>
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                    {{ OrderDetail.price }}</td>
                                                                <td
                                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                                    {{ OrderDetail.quantity*OrderDetail.price }}</td>

                                                            </tr> <!-- tr-end -->
                                                        </tbody> <!-- tbody-end -->

                                                    </table> <!-- table-end -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-6 pb-7">

                                    <div class="col-span-1 mt-10">
                                        <p class="font-medium text-xs mb-2 dark:text-white">Note</p>
                                        <p class="text-xs">{{ Orders.note }}.</p>
                                    </div> <!-- col-end -->

                                    <div class="col-span-1">
                                        <div class="flex sm:justify-end space-y-2">

                                            <div class="grid gap-3">
                                            
                                                <div class="grid grid-cols-4 gap-x-3">
                                                    <h6
                                                        class="col-span-2 font-semibold text-gray-500 dark:text-gray-200">
                                                        Discout:</h6>
                                                    <p class="col-span-2 sm:text-end text-gray-400"> {{ Orders.value }}  ({{ Orders.voucher_type }})
                                                    </p>
                                                </div> <!-- grid-end -->

                                                
                                                <hr class="dark:border-gray-700">

                                                <h3 class="text-2xl text-end pt-5 dark:text-white">
                                                    {{ Orders.total_amount }} VNĐ</h3>
                                            </div> <!-- grid-end -->

                                        </div> <!-- flex-end -->
                                    </div> <!-- col-end -->

                                </div> <!-- grid-end -->

                                <hr class="dark:border-gray-700">

                                <div class="mt-5">
                                    <div class="flex sm:justify-end gap-2 items-center print:hidden">
                                        <a href="javascript:window.print()"
                                            class="btn bg-dark text-white rounded py-1"><i
                                                class="mdi mdi-printer-outline text-lg"></i> </a>
                                        <a :href="route('orders.index')" type="button"
                                            class="btn bg-primary text-white py-2 rounded">Back</a>
                                    </div> <!-- flex-end -->
                                </div>

                            </div>
                        </div> <!-- card-end -->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
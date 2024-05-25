<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


defineProps({
    Orders: Object
});

const OrderUse = useForm({

});

function changeStatus(id, change) {
    let noty = null;
    switch (id) {
        case 0:
            noty = "Cancel";
            break;
        case 1:
            noty = "Pending";
            break;
        case 2:
            noty = "Processing";
            break;
        case 3:
            noty = "Delivered";
            break;
    }
    Swal.fire({
        title: "Change Status!",
        text: "You have just changed the status of order #1 to " + noty,
        icon: "success"
    });
    OrderUse.get(route('orders.changeStatus', { id: id, change: change }))

}

// function create() {
//     OrderUse.get(route('products.create'));
// }

</script>

<template>

    <Head title="Quản lý đơn hàng" />
    <AuthenticatedLayout>
        <div class="flex">
            <SlideBar> </SlideBar>
            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="card">
                            <div class="p-6">

                                <div class="items-center justify-between mb-6">

                                    <h3 class="card-title mr-6 mb-6">Orders Management</h3>

                                    <div class="flex items-center justify-between">
                                        <Search></Search>

                                        <!-- <ButtonCreate @click="create()"></ButtonCreate> -->

                                    </div>
                                </div>

                                <div class="overflow-x-auto">
                                    <div class="min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full" data-tablesaw-mode="swipe">
                                                <thead
                                                    class="bg-gray-100 dark:bg-gray-700/50 border-b-2 border-gray-200 dark:border-gray-700">
                                                    <tr>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-sortable-default-col
                                                            data-tablesaw-priority="3"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            ID.</th>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-sortable-default-col
                                                            data-tablesaw-priority="3"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            Order Time</th>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-priority="2"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            Customer Name</th>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-priority="1"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            Method</th>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-priority="4"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            Amount</th>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-priority="4"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            Status</th>
                                                        <th scope="col" data-tablesaw-sortable-col
                                                            data-tablesaw-priority="2"
                                                            class="px-2 py-2.5 text-start text-sm font-medium text-gray-500 dark:text-white">
                                                            Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody v-if="Orders && Orders.data.length > 0"
                                                    class="divide-y divide-gray-100 dark:divide-gray-700">
                                                    <tr v-for="orders in Orders.data">
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            <a class="hover:text-blue-500" :href="route('orders.view', orders.id )">
                                                                #{{ orders.id }}
                                                            </a>
                                                        </td>
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-s text-gray-500 dark:text-gray-200">
                                                            {{ orders.date_order }} {{ orders.time_order }}</td>
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            {{ orders.name }}</td>
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            {{ orders.payment_method }}</td>
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            {{ orders.total_amount }}</td>
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            <span v-if="orders.status == 0"
                                                                class="text-sm text-white bg-danger rounded-md px-1 py-0.5">
                                                                Cancel </span>
                                                            <span v-if="orders.status == 1"
                                                                class="text-sm text-white bg-warning rounded-md px-1 py-0.5">
                                                                Pending </span>
                                                            <span v-if="orders.status == 2"
                                                                class="text-sm text-white bg-primary rounded-md px-1 py-0.5">
                                                                Processing </span>
                                                            <span v-if="orders.status == 3"
                                                                class="text-sm text-white bg-success rounded-md px-1 py-0.5">
                                                                Delivered </span>
                                                        </td>
                                                        <td
                                                            class="px-2 py-2.5 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            <select @change="changeStatus(orders.id, orders.status)"
                                                                v-model="orders.status"
                                                                class="form-select form-select-lg w-6/12">
                                                                <option value="3">Delivered</option>
                                                                <option value="1">Pending</option>
                                                                <option value="2">Processing</option>
                                                                <option value="0">Cancel</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <Pagination
                                    class="text-blue-800  flex justify-end mt-6 px-6 sm:items-center sm:justify-right"
                                    :links="Orders.links"></Pagination>
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
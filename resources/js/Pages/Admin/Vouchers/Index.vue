<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import TextInput from '@/Components/TextInput.vue';
import InputImage from '@/Components/InputImage.vue';
import NumberInput from '@/Components/NumberInput.vue';

import Swal from 'sweetalert2';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}

defineProps({
    Vouchers: Object,
});

function openModal(index, value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12, value13, value14, valueMain) {
    isOpen.value = true
    VoucherUse.index = index;
    VoucherUse.category = 'View',

        form.id = valueMain,
        form.voucher_name = value1,
        form.voucher_code = value2,
        form.voucher_type = value3,
        form.value = value4,
        form.start_time = value5,
        form.start_date = value6,
        form.end_time = value7,
        form.end_date = value8,
        form.voucher_min_spend = value9,
        form.voucher_max_spend = value10,
        form.voucher_use_per_user = value11,
        form.quantity = value12,
        form.status = value14
}

const updateCategory = (event) => {
    VoucherUse.category = event.target.checked ? 1 : 0;
};


const VoucherUse = useForm({
    index: 0,
    category: 'View',
});

const form = useForm({
    id: "",
    voucher_name: "",
    voucher_code: "",
    voucher_type: "",
    value: "",
    start_time: "",
    start_date: "",
    end_time: "",
    end_date: "",
    voucher_min_spend: "",
    voucher_max_spend: "",
    voucher_use_per_user: "",
    quantity: "",
    image: "",
    status: "0",
});

function chooseCategory(category) {
    VoucherUse.category = category;
};

function create() {
    VoucherUse.get(route('vouchers.create'));
}

const submit = () => {
    Swal.fire({
        position: "center-bottom",
        icon: "success",
        title: "Product saved!",
        showConfirmButton: false,
        timer: 1500
    });
    form.post(route('vouchers.update', form.id));
};

function destroy(name, id) {
    Swal.fire({
        title: '"' + name + '"',
        text: "Do you want to delete this voucher?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "btn-success",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted!",
                text: "Your voucher has been deleted.",
                icon: "success"
            });
            VoucherUse.delete(route('vouchers.destroy', id));
        }
    });
};

//

const categories = ref({
    View: [],
    Edit: [],

})

</script>

<script>
export default {
    data() {
        return {
            isVisible: false
        };
    },
    methods: {
        toggleVariants() {
            this.isVisible = !this.isVisible;
        }
    }
};


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
                                    <h3 class="card-title mr-6 mb-6">Voucher Management</h3>
                                    <div class="flex items-center justify-between">
                                        <Search></Search>
                                        <ButtonCreate @click="create()"></ButtonCreate>
                                    </div>
                                </div>

                                <div class="overflow-x-auto">
                                    <div class="min-w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                            ID.
                                                        </th>
                                                        <th scope="col"
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                            Voucher
                                                        </th>
                                                        <th scope="col"
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                            Discount</th>
                                                        <th scope="col"
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                            Start Date</th>
                                                        <th scope="col"
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                            End Date</th>
                                                        <th scope="col "
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500 ">
                                                            Status</th>
                                                        <th scope="col "
                                                            class="px-4 py-4 text-start text-sm font-medium text-gray-500 flex place-content-center">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody v-if="Vouchers && Vouchers.data.length > 0"
                                                    class="divide-y divide-gray-200 dark:divide-gray-700">
                                                    <tr v-for="(voucher, index) in Vouchers.data" :key="voucher"
                                                        class="bg-gray-50 dark:bg-gray-700/50 ">
                                                        <td
                                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            #{{ voucher.id }}
                                                        </td>
                                                        <td
                                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            <button class="text-gray-500  hover:text-blue-500 underline"
                                                                @click="openModal(index, voucher.voucher_name, voucher.voucher_code, voucher.voucher_type,
                voucher.value, voucher.start_time, voucher.start_date, voucher.end_time, voucher.end_date, voucher.voucher_min_spend,
                voucher.voucher_max_spend, voucher.voucher_use_per_user, voucher.quantity, voucher.image, voucher.status, voucher.id
            )"> {{ voucher.voucher_name
                                                                }}
                                                            </button>

                                                        </td>
                                                        <td
                                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            {{ voucher.value }}</td>
                                                        <td
                                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            {{ voucher.start_date }}</td>
                                                        <td
                                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                            {{ voucher.end_date }}</td>
                                                        <td
                                                            class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">

                                                            <span v-if="voucher.status === 1"
                                                                class="text-xs text-white bg-success rounded-md px-1 py-0.5">
                                                                Active </span>
                                                            <span v-if="voucher.status === 0"
                                                                class="text-xs text-white bg-danger rounded-md px-1 py-0.5">
                                                                Expired </span>
                                                            <span v-if="voucher.status === 2"
                                                                class="text-xs text-white bg-warning rounded-md px-1 py-0.5">
                                                                Private </span>
                                                        </td>
                                                        <td class="px-4 py-4 justi">
                                                            <div class="flex justify-center">
                                                                
                                                                <button
                                                                    @click="destroy(voucher.voucher_name, voucher.id)"
                                                                    type="button" class="m-4 text-white ">
                                                                    <i class="mdi mdi-cog">
                                                                        <svg class="fill-current text-gray-600 hover:text-red-600"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 32 32" width="20px"
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
                                    :links="Vouchers.links"></Pagination>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </AuthenticatedLayout>

    <TransitionRoot class="z-50" appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-">
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <!-- Start Tab Group -->
                            <TabGroup>
                                <TabList class="flex space-x-1 rounded-xl bg-blue-900/20 p-1">
                                    <Tab v-for="category in Object.keys(categories)" as="template" :key="category"
                                        v-slot="{ selected }">
                                        <button @click="chooseCategory(category)" :class="[
                'w-full rounded-lg py-2.5 text-sm font-medium leading-5',
                'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                selected
                    ? 'bg-white text-blue-700 shadow'
                    : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',
            ]">
                                            {{ category }}
                                        </button>
                                    </Tab>
                                </TabList>

                                <TabPanels class="mt-2">
                                    <TabPanel :class="[
                'rounded-xl bg-white',
                'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
            ]">
                                    </TabPanel>
                                </TabPanels>

                                <TabPanels class="mt-2">
                                    <TabPanel :class="[
                'rounded-xl bg-white',
                'ring-white/60 ring-offset- ',
            ]">
                                        <form class="flex flex-col gap-6" name="createVoucher" @submit.prevent="submit"
                                            method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Voucher
                                                    Name</label>
                                                <TextInput v-model="form.voucher_name" type="text" name="product_name"
                                                    id="simpleinput"> {{ Vouchers.data[VoucherUse.index].voucher_name }}
                                                </TextInput>
                                            </div>
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Voucher
                                                    Code</label>
                                                <TextInput v-model="form.voucher_code" type="text" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label for="select-code-language" class="mb-2">Type
                                                        Value</label>
                                                    <select v-model="form.voucher_type" name="id_pro_category"
                                                        id="select-code-language" class="w-full selectize-drop-header"
                                                        placeholder="Select a category...">
                                                        <option value="fixed_amount"> Fixed Amount </option>
                                                        <option value="percent"> Percent </option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-gray-600 mb-2" for="simpleinput">Value
                                                    </label>
                                                    <NumberInput v-model="form.value" type="number" name="product_name"
                                                        id="simpleinput">
                                                    </NumberInput>
                                                </div>
                                            </div>


                                            <div>
                                                <label class="block text-gray-600 mb-2" for="example-date">Start
                                                    Date</label>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <input v-model="form.start_date" class="form-input w-full"
                                                        id="example-date" type="date" name="date">
                                                    <input v-model="form.start_time" class="form-input w-full"
                                                        id="example-time" type="time" name="time">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="example-date">End
                                                    Date</label>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <input v-model="form.end_date" class="form-input w-full"
                                                        id="example-date" type="date" name="date">
                                                    <input v-model="form.end_time" class="form-input w-full"
                                                        id="example-time" type="time" name="time">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Min - Max
                                                </label>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <NumberInput v-model="form.voucher_min_spend" type="number"
                                                        name="product_name" id="simpleinput">
                                                    </NumberInput>
                                                    <NumberInput v-model="form.voucher_max_spend" type="number"
                                                        name="product_name" id="simpleinput">
                                                    </NumberInput>
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Use per User
                                                </label>
                                                <NumberInput v-model="form.voucher_use_per_user" type="number"
                                                    name="product_name" id="simpleinput">
                                                </NumberInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Quantity
                                                </label>
                                                <NumberInput v-model="form.quantity" type="number" name="product_name"
                                                    id="simpleinput">
                                                </NumberInput>
                                            </div>

                                            <InputImage v-model="form.image" id="image" name="image" type="file" class="mt-2 block " autofocus />

                                            <div class="flex items-center justify-center gap-5 mt-4 ju">
                                                <div class="flex items-center">
                                                    <input class="form-radio text-success" type="radio" value="1"
                                                        v-model="form.status" id="formRadio">
                                                    <label class="ms-1.5" for="formRadio11">Active</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input class="form-radio text-warning" type="radio" value="2"
                                                        v-model="form.status" id="formRadio">
                                                    <label class="ms-1.5" for="formRadio14">Private</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input class="form-radio text-danger" type="radio" value="0"
                                                        v-model="form.status" id="formRadio">
                                                    <label class="ms-1.5" for="formRadio15">Expired</label>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center mt-3">
                                                <button @click="closeModal()" type="submit"
                                                    class="btn border-success text-success hover:bg-success hover:text-white">Save</button>
                                            </div>
                                        </form>

                                    </TabPanel>
                                </TabPanels>
                            </TabGroup>

                            <!-- End Tab Group -->

                            <DialogTitle v-if="VoucherUse.category === 'View'" as="h3"
                                class="text-lg font-medium leading-6 text-gray-900">
                                Voucher: {{ Vouchers.data[VoucherUse.index].voucher_name }}
                            </DialogTitle>
                            <div v-if="VoucherUse.category === 'View'" class="mt-2">
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> ID: </span> #{{ Vouchers.data[VoucherUse.index].id }}
                                </p>
                                <div class="flex justify-center object-cover">
                                    
                                    <img class="w-full h-36 object-fill" :src="'/Images_voucher/' + Vouchers.data[VoucherUse.index].image">
                                    
                                </div>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Code: </span> <span
                                        class="inline-flex items-center gap-1.5 py-0.5 px-1.5 rounded text-xs font-medium border border-primary text-primary">
                                        {{ Vouchers.data[VoucherUse.index].voucher_code }} </span>
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Type: </span> {{
                Vouchers.data[VoucherUse.index].voucher_type }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Value: </span> {{ Vouchers.data[VoucherUse.index].value }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Start: </span> {{
                Vouchers.data[VoucherUse.index].start_date }} {{
                Vouchers.data[VoucherUse.index].start_time }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> End: </span> {{ Vouchers.data[VoucherUse.index].end_date }}
                                    {{
                Vouchers.data[VoucherUse.index].end_time }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Min - Max: </span> {{
                Vouchers.data[VoucherUse.index].voucher_min_spend }} - {{
                Vouchers.data[VoucherUse.index].voucher_max_spend }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Use per user: </span> {{
                Vouchers.data[VoucherUse.index].voucher_use_per_user }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Quantity: </span> {{
                Vouchers.data[VoucherUse.index].quantity }}
                                </p>
                                <p class="m-1 text-sm text-gray-500">
                                    <span class="font-bold"> Status: </span>
                                    <span v-if="Vouchers.data[VoucherUse.index].status === 1"
                                        class="inline-flex items-center gap-1.5 py-0.5 px-1.5 rounded text-xs font-medium bg-success text-white">
                                        Active </span>
                                    <span v-if="Vouchers.data[VoucherUse.index].status === 0"
                                        class="inline-flex items-center gap-1.5 py-0.5 px-1.5 rounded text-xs font-medium bg-danger text-white">
                                        Expired </span>
                                    <span v-if="Vouchers.data[VoucherUse.index].status === 2"
                                        class="inline-flex items-center gap-1.5 py-0.5 px-1.5 rounded text-xs font-medium bg-warning text-white">
                                        Private </span>
                                </p>

                            </div>

                            <div class="mt-4 flex justify-end">
                                <button v-if="VoucherUse.category === 'View'" type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="closeModal">
                                    Got it, thanks!
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

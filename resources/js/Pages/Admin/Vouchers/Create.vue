<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import TextInput from '@/Components/TextInput.vue';
import NumberInput from '@/Components/NumberInput.vue';

import InputImage from '@/Components/InputImage.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

import Swal from 'sweetalert2';
import SweetAlert from '@/Components/SweetAlert.vue'

defineProps({
    ProductCategories: Object,
    ProductColor: Object,
    ProductSize: Object,
});

const form = useForm({
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


const submit = () => {
    const startDate = new Date(form.start_date)
    const endDate = new Date(form.end_date)

    const [hour1, minute1] = form.end_time.split(':');
    const [hour2, minute2] = form.start_time.split(':');

    const time1InMinutes = parseInt(hour1) * 60 + parseInt(minute1);
    const time2InMinutes = parseInt(hour2) * 60 + parseInt(minute2);

    if (form.voucher_type === "percent") {
        if (form.value >= 1 && form.value <= 100) {
            if (startDate.getTime() === endDate.getTime()) {
                if (time1InMinutes > time2InMinutes) {
                    form.post(route('vouchers.store'));
                    Swal.fire({
                        title: "Created!",
                        text: "Create successful voucher \n" + '"' + form.voucher_name + '"',
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...2",
                        text: "End time must be greater than start time!",
                    });
                }
            } else if (endDate.getTime() < startDate.getTime()) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...3",
                    text: "End date must be greater than start date!",
                });
            } else {
                form.post(route('vouchers.store'));
                Swal.fire({
                    title: "Created!",
                    text: "Create successful voucher \n" + '"' + form.voucher_name + '"',
                    icon: "success"
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Voucher Type is Percent, " + "the value the value must be between 1 and 100!",
            });
        }

    } else {
        if (startDate.getTime() === endDate.getTime()) {
            if (time1InMinutes > time2InMinutes) {
                form.post(route('vouchers.store'));
                Swal.fire({
                    title: "Created!",
                    text: "Create successful voucher \n" + '"' + form.voucher_name + '"',
                    icon: "success"
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...2",
                    text: "End time must be greater than start time!",
                });
            }
        } else if (endDate.getTime() < startDate.getTime()) {
            Swal.fire({
                icon: "error",
                title: "Oops...3",
                text: "End date must be greater than start date!",
            });
        } else {
            form.post(route('vouchers.store'));
            Swal.fire({
                title: "Created!",
                text: "Create successful voucher \n" + '"' + form.voucher_name + '"',
                icon: "success"
            });
        }
    }

};

const updateStatus = (event) => {
    form.status = event.target.checked ? 1 : 0;
};

watch(form.voucher_type, (newVal) => {
    if (newVal === 'percent') {
        // Nếu là loại percent, đảm bảo giá trị nằm trong khoảng từ 0 đến 100
        if (form.value.value < 0 || form.value.value > 100) {
            form.value.value = 12; // Đặt lại giá trị nếu nó không nằm trong khoảng từ 0 đến 100
        }
    }
});

</script>



<template>

    <Head title=" Quản lý voucher" />
    <AuthenticatedLayout>
        <div class="flex">
            <SlideBar> </SlideBar>
            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="card">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <h4 class="card-title mb-4">Add vouchers </h4>
                                    <a :href="route('vouchers.index')" type="button"
                                        class="mr-8 w-40 btn bg-warning text-white">Back</a>
                                </div>


                                <div class="lg:grid-cols-2 gap-6">
                                    <div>
                                        <form class="flex flex-col gap-6" name="createForm" @submit.prevent="submit"
                                            method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Voucher
                                                    Name</label>
                                                <TextInput type="text" v-model="form.voucher_name" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Voucher
                                                    Code</label>
                                                <TextInput type="text" v-model="form.voucher_code" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

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

                                            <!-- <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Value </label>
                                                <TextInput type="text" v-model="form.value" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div> -->

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Value </label>
                                                <NumberInput type="number" v-model="form.value" name="product_name"
                                                    id="simpleinput"></NumberInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="example-date">Start
                                                    Date</label>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <input class="form-input w-full" id="example-date" type="date"
                                                        name="date" v-model="form.start_date">
                                                    <input class="form-input w-full" id="example-time" type="time"
                                                        name="time" v-model="form.start_time">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="example-date">End
                                                    Date</label>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <input class="form-input w-full" id="example-date" type="date"
                                                        name="date" v-model="form.end_date">
                                                    <input class="form-input w-full" id="example-time" type="time"
                                                        name="time" v-model="form.end_time">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Minimum Amount
                                                </label>
                                                <NumberInput type="text" v-model="form.voucher_min_spend"
                                                    name="product_name" id="simpleinput"></NumberInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Maximum Amount
                                                </label>
                                                <NumberInput type="number" v-model="form.voucher_max_spend"
                                                    name="product_name" id="simpleinput"></NumberInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Use per User
                                                </label>
                                                <NumberInput type="number" v-model="form.voucher_use_per_user"
                                                    name="product_name" id="simpleinput"></NumberInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Quantity
                                                </label>
                                                <NumberInput type="number" v-model="form.quantity" name="product_name"
                                                    id="simpleinput"></NumberInput>
                                            </div>

                                            <InputImage id="image" type="file" class="mt-2 block " v-model="form.image"
                                                autofocus />

                                            <div>
                                                <div class="flex items-center">
                                                    <label class="ms-1.5 mr-8" for="formSwitchSquare2">Status</label>

                                                    <input @change="updateStatus()" v-model="form.status" name="status"
                                                        class="form-switch square text-success" type="checkbox"
                                                        id="formSwitchSquare2" checked>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="mr-8 w-40 btn bg-success text-white">Save!</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

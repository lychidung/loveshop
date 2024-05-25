<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import TextInput from '@/Components/TextInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import InputImage from '@/Components/InputImage.vue';
import Swal from 'sweetalert2';

import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({

});

const form = useForm({
    name: '',
    password: '',
    password_confirmation: '',
    phone: '',
    email: '',
    point: '',
    birthday: '',
    address: '',
    gender: '',
    image: '',
    status: '',
});


function submit() {
    Swal.fire({
        title: "Created!",
        text: "Create successful product \n" + '"' + name + '"',
        icon: "success"
    });
    form.post(route('customers.store'));
};

const updateStatus = (event) => {
    form.status = event.target.checked ? 1 : 0;
};


</script>

<template>

    <Head title="Quản lý sản phẩm s" />
    <AuthenticatedLayout>
        <div class="flex">
            <SlideBar> </SlideBar>
            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="card">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <h4 class="card-title mb-4">Add Customer </h4>
                                    <a :href="route('customers.index')" type="button"
                                        class="mr-8 w-40 btn bg-warning text-white">Back</a>
                                </div>


                                <div class="lg:grid-cols-2 gap-6">
                                    <div>
                                        <form class="flex flex-col gap-6" name="createForm" @submit.prevent="submit()"
                                            method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Customer
                                                    Name</label>
                                                <TextInput type="text" v-model="form.name" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Email
                                                </label>
                                                <TextInput type="text" v-model="form.email" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Password
                                                </label>
                                                <TextInput type="text" v-model="form.password" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Confirm
                                                    Password
                                                </label>
                                                <TextInput type="text" v-model="form.password_confirmation"
                                                    name="product_name" id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Phone
                                                </label>
                                                <TextInput type="text" v-model="form.phone" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Address
                                                </label>
                                                <TextInput type="text" v-model="form.address" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Birthday
                                                </label>
                                                <TextInput type="date" v-model="form.birthday" name="product_name"
                                                    id="simpleinput"></TextInput>
                                            </div>

                                            <div>
                                                <label for="select-code-language" class="mb-2">Gender</label>
                                                <select v-model="form.gender" name="id_pro_category"
                                                    id="select-code-language" class="w-full selectize-drop-header"
                                                    placeholder="Select a category...">
                                                    <option value="0"> Nữ </option>
                                                    <option value="1"> Nam </option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Point
                                                </label>
                                                <NumberInput type="number" v-model="form.point" name="product_name"
                                                    id="simpleinput"></NumberInput>
                                            </div>

                                            <div>
                                                <div class="flex items-center">
                                                    <label class="ms-1.5 mr-8" for="formSwitchSquare2">Status</label>

                                                    <input @change="updateStatus()" v-model="form.status" name="status"
                                                        class="form-switch square text-success" type="checkbox"
                                                        id="formSwitchSquare2" checked>
                                                </div>
                                            </div>
                                            <InputImage id="image" type="file" class="mt-2 block " v-model="form.image"
                                                autofocus />
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

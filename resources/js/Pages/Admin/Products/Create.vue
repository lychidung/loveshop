<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import TextInput from '@/Components/TextInput.vue';
import InputImage from '@/Components/InputImage.vue';
import Swal from 'sweetalert2';

import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    ProductCategories: Object,
    ProductColor: Object,
    ProductSize: Object,
});

const form = useForm({
    product_name: '',
    id_pro_category: '',
    description: '',
    status: '0',
    id_color: [],
    id_size: [],
    price: [],
    discount_price: [],
    in_stock: [],
    image: [],
    count_index: 1
});


function submit(name){
    Swal.fire({
        title: "Created!",
        text: "Create successful product \n"+ '"'+name+'"',
        icon: "success"
    });
    form.post(route('products.store', form.count_index));
};

const updateStatus = (event) => {
    form.status = event.target.checked ? 1 : 0;
};

const toggleVariantsCountAdd = () => {
    form.count_index = form.count_index + 1;
};

const toggleVariantsCountDelete = () => {
    if (form.count_index > 1) {
        form.count_index = form.count_index - 1;
    }
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
                                    <h4 class="card-title mb-4">Add products </h4>
                                    <a :href="route('products.index')" type="button"
                                        class="mr-8 w-40 btn bg-warning text-white">Back</a>
                                </div>


                                <div class="lg:grid-cols-2 gap-6">
                                    <div>
                                        <form class="flex flex-col gap-6" name="createForm" @submit.prevent="submit(form.product_name)"
                                            method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Product
                                                    Name</label>
                                                <TextInput type="text" v-model="form.product_name" name="product_name"
                                                    id="simpleinput"></TextInput>

                                            </div>
                                            <div>
                                                <label for="select-code-language" class="mb-2">Product
                                                    Categories</label>
                                                <select v-model="form.id_pro_category" name="id_pro_category"
                                                    id="select-code-language" class="w-full selectize-drop-header"
                                                    placeholder="Select a category...">
                                                    <option v-for="category in ProductCategories" :value="category.id">
                                                        {{ category.category_name }} </option>

                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2"
                                                    for="example-textarea">Description</label>
                                                <textarea v-model="form.description" name="description"
                                                    class="form-input" id="example-textarea" rows="5"></textarea>
                                            </div>

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

                                            <!-- Note -->
                                            <div class="flex gap-8 items-center">
                                                <h4 class="cursor-pointer card-title mb-4 mt-4" id="hehe">
                                                    Add Variants ({{ form.count_index }})</h4>
                                            </div>


                                            <div v-for="index in form.count_index" :key="index" class="flex" id="haha">
                                                <div class="flex flex-wrap gap-6 items-center justify-between">
                                                    <div class="flex gap-6 items-center justify-between">
                                                        <div>
                                                            <label for="select-code-language" class="mb-2">Color</label>
                                                            <select v-model="form.id_color[index]"
                                                                name="id_pro_category" id="select-code-language"
                                                                class="w-full selectize-drop-header"
                                                                placeholder="Select a category...">
                                                                <option v-for="color in ProductColor" :value="color.id">
                                                                    {{ color.color_name }} </option>

                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="select-code-language" class="mb-2">Size</label>
                                                            <select v-model="form.id_size[index]" name="id_pro_category"
                                                                id="select-code-language"
                                                                class="w-full selectize-drop-header"
                                                                placeholder="Select a category...">
                                                                <option v-for="size in ProductSize" :value="size.id">
                                                                    {{ size.size_name }} </option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label class="block text-gray-600 mb-2"
                                                                for="simpleinput">Price
                                                            </label>
                                                            <TextInput type="text" v-model="form.price[index]"
                                                                name="product_name" id="simpleinput"> </TextInput>

                                                        </div>

                                                        <div>
                                                            <label class="block text-gray-600 mb-2"
                                                                for="simpleinput">Discount Price
                                                            </label>
                                                            <TextInput type="text" v-model="form.discount_price[index]"
                                                                name="product_name" id="simpleinput"> </TextInput>

                                                        </div>

                                                        <div>
                                                            <label class="block text-gray-600 mb-2"
                                                                for="simpleinput">Quantity

                                                            </label>
                                                            <TextInput type="text" v-model="form.in_stock[index]"
                                                                name="product_name" id="simpleinput"> </TextInput>
                                                        </div>



                                                    </div>


                                                    <InputImage id="image" type="file" class="mt-2 block "
                                                        v-model="form.image[index]" autofocus />

                                                </div>
                                            </div>


                                        </form>
                                        <div>
                                            <button id="button-add-variant" @click="toggleVariantsCountAdd"
                                                class="mt-7 mr-8 w-20 h-10 btn bg-success text-white">Add</button>
                                            <button @click="toggleVariantsCountDelete"
                                                class="mt-7 mr-8 w-20 h-10 btn bg-danger text-white">Delete</button>
                                        </div>

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

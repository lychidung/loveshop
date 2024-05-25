<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import TextInput from '@/Components/TextInput.vue';
import InputImage from '@/Components/InputImage.vue';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

import { Head, Link, useForm } from '@inertiajs/vue3';



const props = defineProps({
    products: Object,
    ProductItem: Object,
    ProductCategories: Object,
    ProductColor: Object,
    ProductSize: Object,
});

const form = useForm({
    product_name: props.products.product_name,
    id_pro_category: props.products.id_pro_category,
    description: props.products.description,
    status: props.products.status,
});

const formITems = useForm({
    id_product: props.products.id,
    id_color: "",
    id_size: "",
    price: "",
    discount_price: "",
    image: "",
    in_stock: "",
});

const submit = () => {
    Swal.fire({
        position: "center-bottom",
        icon: "success",
        title: "Product saved!",
        showConfirmButton: false,
        timer: 1500
    });
    form.post(route('products.update', props.products.id));
};

const submit2 = () => {
    formITems.post(route('productsitem.store'));
};

const destroy = ($id, $id_product) => {
    Swal.fire({
        title: 'Delete?',
        text: "Do you want to delete this product items?",
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
            formITems.post(route('productsitem.destroy', [$id, $id_product]));
        }
    });
};

const updateStatus = (event) => {
    form.status = event.target.checked ? 1 : 0;
};


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
                                <div class="flex items-center justify-between">
                                    <h4 class="card-title mb-4">Edit products</h4>

                                    <a :href="route('products.index')" type="button"
                                        class="mr-8 w-40 btn bg-warning text-white">Back</a>
                                </div>

                                <div class="lg:grid-cols-2 gap-6">
                                    <div>
                                        <form class="flex flex-col gap-6" name="createForms" @submit.prevent="submit"
                                            method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Product
                                                    Name
                                                </label>
                                                <TextInput type="text" v-model="form.product_name" name="product_name"
                                                    id="simpleinput"> </TextInput>

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
                                                    <input @change="updateStatus()" v-model="form.status"
                                                        :checked="props.products.status === 1" true-value="1"
                                                        false-value="0" name="status"
                                                        class="form-switch square text-success" type="checkbox"
                                                        id="formSwitchSquare2">
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="mr-8 w-full btn bg-success text-white">Save</button>

                                            </div>

                                        </form>
                                    </div>

                                    <!-- Note -->

                                    <h4 class="cursor-pointer card-title mb-4 mt-4" @click="toggleVariants" id="hehe">
                                        Add Variants</h4>


                                    <div v-if="isVisible" id="haha">
                                        <form class="flex flex-col gap-6" name="createForsm" @submit.prevent="submit2"
                                            method="POST" enctype="multipart/form-data">
                                            <div class="flex gap-6 items-center">
                                                <div>
                                                    <div class="flex gap-6 items-center justify-between">
                                                        <div>
                                                            <label for="select-code-language" class="mb-2">Color
                                                            </label>
                                                            <select v-model="formITems.id_color" name="id_pro_category"
                                                                id="select-code-language"
                                                                class="w-full selectize-drop-header"
                                                                placeholder="Select a category...">
                                                                <option v-for="color in ProductColor" :value="color.id">
                                                                    {{ color.color_name }} </option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="select-code-language" class="mb-2">Size</label>
                                                            <select v-model="formITems.id_size" name="id_pro_category"
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
                                                            <TextInput type="text" v-model="formITems.price"
                                                                name="product_name" id="simpleinput"> </TextInput>

                                                        </div>

                                                        <div>
                                                            <label class="block text-gray-600 mb-2"
                                                                for="simpleinput">Discount
                                                                Price
                                                            </label>
                                                            <TextInput type="text" v-model="formITems.discount_price"
                                                                name="product_name" id="simpleinput"> </TextInput>

                                                        </div>

                                                        <div>
                                                            <label class="block text-gray-600 mb-2"
                                                                for="simpleinput">Quantity

                                                            </label>
                                                            <TextInput type="text" v-model="formITems.in_stock"
                                                                name="product_name" id="simpleinput"> </TextInput>
                                                        </div>
                                                    </div>

                                                    <InputImage id="image" type="file" class="mt-2 block "
                                                        v-model="formITems.image" autofocus />

                                                </div>

                                                <div class="items-center justify-between">
                                                    <label class="block text-gray-600 mb-2" for="simpleinput">Create
                                                    </label>
                                                    <button type="submit"
                                                        class="mr-8 w-full btn bg-success text-white">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="card">
                                        <div class="p-6">

                                            <div class="flex items-center justify-between mb-6">
                                                <h3 class="card-title">Product Item</h3>
                                            </div>

                                            <div class="relative overflow-auto">
                                                <table
                                                    class="border-collapse min-w-full border border-primary dark:border-slate-600 bg-white dark:bg-gray-700/50 text-sm shadow-sm">
                                                    <thead class="bg-slate-50 dark:bg-gray-700">
                                                        <tr>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-start">
                                                                Image</th>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-start">
                                                                Color</th>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-start">
                                                                Size</th>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-start">
                                                                Price</th>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-start">
                                                                Discount Price</th>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-center">
                                                                Quantity</th>
                                                            <th
                                                                class="border border-primary dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-center">
                                                                Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody v-if="ProductItem && ProductItem.data.length > 0">
                                                        <tr v-for="ProductItem in ProductItem.data">
                                                            <th scope="row"
                                                                class="flex items-center gap-2 px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                                <img class="w-8 h-8 rounded-full"
                                                                    :src="'/Images_product/' + ProductItem.image"
                                                                    alt="image">
                                                                <div
                                                                    class="whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-200">
                                                                    {{ ProductItem.product_name }}</div>
                                                            </th>
                                                            <td
                                                                class="border border-primary dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                                                {{ ProductItem.color_name }}</td>
                                                            <td
                                                                class="border border-primary dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                                                {{ ProductItem.size_name }}</td>

                                                            <td
                                                                class="border border-primary dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                                                {{ ProductItem.price }}</td>
                                                            <td
                                                                class="border border-primary dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                                                {{ ProductItem.discount_price }}</td>
                                                            <td
                                                                class="border border-primary dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                                                                {{ ProductItem.in_stock }}</td>
                                                            <td
                                                                class="border border-primary dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400 text-center">
                                                                <button
                                                                    @click="destroy(ProductItem.id_pro_item, props.products.id)">
                                                                    Delete </button>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <Pagination
                                                class="text-blue-800  flex justify-end mt-6 px-6 sm:items-center sm:justify-right"
                                                :links="ProductItem.links"></Pagination>
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
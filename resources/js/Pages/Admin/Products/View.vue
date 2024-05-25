<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ButtonCreate from '@/Components/ButtonCreate.vue';
import SlideBar from '@/Components/SlideBar.vue';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,
});


const form = useForm({
    product_name:'',
    id_pro_category: '',
    description: '',
    status: '0'
});

const submit = () => {
    form.post(route('products.store'));
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
                                <h4 class="card-title mb-4">Add products</h4>

                                <div class="lg:grid-cols-2 gap-6">
                                    <div>
                                        <form class="flex flex-col gap-6" name="createForm" @submit.prevent="submit" method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Product
                                                    Name
                                                    </label>
                                                    <h1> {{ props.products.product_name }}  </h1>
                                                    <TextInput type="text" v-model="form.product_name" name = "product_name" id="simpleinput"> </TextInput>

                                            </div>
                                            <div>
                                                <label for="select-code-language" class="mb-2">Product
                                                    Categories</label>
                                                <select v-model="form.id_pro_category" name = "id_pro_category" id="select-code-language" class="w-full selectize-drop-header"
                                                    placeholder="Select a category...">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-gray-600 mb-2"
                                                    for="example-textarea">Description</label>
                                                <textarea v-model="form.description" name = "description" class="form-input" id="example-textarea" rows="5"></textarea>
                                            </div>

                                            <div>
                                                <div class="flex items-center">
                                                    <label class="ms-1.5 mr-8" for="formSwitchSquare2">Status</label>

                                                    <input @change="updateStatus()" v-model="form.status" name="status" class="form-switch square text-success" type="checkbox"
                                                        id="formSwitchSquare2" checked>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <button type="submit"
                                                    class="mr-8 w-40 btn bg-success text-white">Add</button>
                                                <button type="button"
                                                    class="mr-8 w-40 btn bg-warning text-white">Edit</button>
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
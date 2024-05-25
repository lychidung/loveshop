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
    ProductCategories: Object,
});

const form = useForm({
    category_name: props.ProductCategories.category_name,
    description: props.ProductCategories.description,
    image: "",
    status: props.ProductCategories.status,
});

const submit = () => {
    Swal.fire({
        position: "center-bottom",
        icon: "success",
        title: "Product saved!",
        showConfirmButton: false,
        timer: 1500
    });
    form.post(route('categories.update', props.ProductCategories.id));
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
                                    <h4 class="card-title mb-4">Edit categories</h4>

                                    <a :href="route('categories.index')" type="button"
                                        class="mr-8 w-40 btn bg-warning text-white">Back</a>
                                </div>

                                <div class="lg:grid-cols-2 gap-6">
                                    <div>
                                        <form class="flex flex-col gap-6" name="createForms" @submit.prevent="submit"
                                            method="POST" enctype="multipart/form-data">
                                            <div>
                                                <label class="block text-gray-600 mb-2" for="simpleinput">Category
                                                    Name
                                                </label>
                                                <TextInput type="text" v-model="form.category_name" name="product_name"
                                                    id="simpleinput"> </TextInput>

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
                                                        :checked="props.ProductCategories.status === 1" true-value="1"
                                                        false-value="0" name="status"
                                                        class="form-switch square text-success" type="checkbox"
                                                        id="formSwitchSquare2">
                                                </div>
                                            </div>

                                            <InputImage id="image" type="file" class="mt-2 block "
                                                v-model="form.image" autofocus />

                                            <div>
                                                <button type="submit"
                                                    class="mr-8 w-full btn bg-success text-white">Save</button>

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
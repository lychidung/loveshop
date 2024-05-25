<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DatatableBasic from '@/Components/datatables/table-basic.vue'
import SlideBar from '@/Components/SlideBar.vue'

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->
        <div class="flex">
            <SlideBar> </SlideBar>
            <!-- <DatatableBasic> </DatatableBasic> -->

        </div>
    </AuthenticatedLayout>
    
</template>

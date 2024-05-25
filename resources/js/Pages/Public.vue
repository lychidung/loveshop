<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Header1 from '@/Components/Header1.vue';
import Header2 from '@/Components/Header2.vue';
import SliderImage from '@/Components/SliderImage.vue';


defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="YML Store - Cửa hàng thời trang cặp đôi" />
    <div>
        <header class="flex flex-col md:w-auto h-44 bg-color-main relative">
            <!-- header 1 -->
            
            <Header1></Header1>
                
            <!-- Header 2 -->
            <Header2></Header2>
        </header>
        <div class="h-screen">
            <div class =""> 
                <SliderImage></SliderImage>
            </div>
            <div>
                <h1> Bán chạy </h1>
                <div> 
                    
                </div>
            </div>
        </div>
    </div>
</template>



<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.cls-1 {
    fill: #262626;
}

.cls-1,
.cls-2,
.cls-3 {
    fill-rule: evenodd;
}

.cls-2 {
    fill: #f44133;
}

.cls-3 {
    fill: #b81616;
}
</style>

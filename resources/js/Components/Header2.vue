<script setup>

</script>

<template>
    <div class="h-1/2 flex items-center self-center">
        <div class="flex items-center self-center text-base font-semibold gap-10 ml-5">
            <div class="bg-background-button p-2.5 border-solid border-2 border-boder-button rounded hover:bg-color-main-2">
                <a href="" class="flex gap-3">
                    <img src="/images_icon/phone_call.png" alt="" class="object-none">
                    <p class="text-white"> Hotline: <span class="text-lg"> 0909135130</span> </p>
                </a>
            </div>

            <div class="">
                <form class="flex">
                    <div class="relative w-full">
                        <input type="search" id="search-dropdown"
                            class="block p-3.5 w-32rem  xl:w-50rem z-20 text-sm text-gray-400 bg-gray-50 rounded-lg rounded-e-lg  border-s-gray-50 border-s-2 border border-gray-300 focus:ring-transparent focus:border-transparent dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                            placeholder="Bạn muốn tìm sản phẩm nào?..." required>
                        <button type="submit"
                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-color-main-2 rounded-e-lg border-3 border-white hover:bg-color-main focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <div class="flex">
                                <h1 class="">Tìm kiếm</h1>
                                <svg class="w-7 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex gap-5 items-center">
                <div class="flex items-center gap-3 after:bg-white after:w-px after:h-8">
                    <img src="/images_icon/account_couple_white.png" alt="">
                    <p class="text-base text-white"> Tài khoản </p>
                </div>

                <div>
                    <div class="flex items-center gap-5">
                        <a href="">
                            <img src="/images_icon/save_white.png" alt="">
                        </a>

                        <a href="">
                            <img src="/images_icon/bag_white.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>
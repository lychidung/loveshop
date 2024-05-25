<template>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <div class="p-6">

                        <div class="flex items-center justify-between mb-6">
                            <h3 class="card-title">Quản lý sản phẩm</h3>

                            <div>
                                <button data-fc-target="dropdown-target3" data-fc-type="dropdown" type="button"
                                    data-fc-placement="bottom-end">
                                    <i class="mdi mdi-dots-vertical text-xl"></i>
                                </button>

                                <div id="dropdown-target3"
                                    class="hidden bg-white shadow rounded border dark:border-slate-700 fc-dropdown-open:translate-y-0 translate-y-3 origin-center transition-all duration-300 py-2 dark:bg-gray-800">
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-stone-100 dark:hover:bg-slate-700 dark:hover:text-gray-200"
                                        href="javascript:void(0)">
                                        Action
                                    </a>
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Another action
                                    </a>
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Something else
                                    </a>
                                    <a class="flex items-center py-1.5 px-5 text-sm transition-all duration-300 bg-transparent text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                                        href="javascript:void(0)">
                                        Separated link
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <div class="min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-4 py-4 text-start text-sm font-medium text-gray-500"> Product
                                                </th>
                                                <th scope="col"
                                                    class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                    Price</th>
                                                <th scope="col"
                                                    class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                    In-stock</th>
                                                <th scope="col"
                                                    class="px-4 py-4 text-start text-sm font-medium text-gray-500">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <tr class="bg-gray-50 dark:bg-gray-700/50">
                                                <th scope="row"
                                                    class="flex items-center gap-2 px-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-40 h-40 "
                                                        src="" alt="Jese image">
                                                    <div
                                                        class="whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-200">
                                                        Áo thun cổ hình One!</div>
                                                </th>
                                                <td
                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                    245000</td>
                                                <td
                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">
                                                    40</td>
                                                <td class="px-4 py-4">
                                                    <div class="flex items-center justify-start space-x-3">
                                                       <a> Details </a>
                                                    </div>
                                                </td>
                                            </tr>

                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
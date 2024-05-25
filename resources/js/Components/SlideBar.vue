<template>
    <div class="app-menu">
        <!--- Menu -->
        <div data-simplebar class="bg-white">
            <!-- User Box -->
            <ul class="menu" data-fc-type="accordion">
                <li class="menu-title">Navigation</li>

                <li class="menu-item">
                    <a :href="route('products.index')" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-view-dashboard-outline"></i></span>
                        <span class="menu-text"> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Catalog</li>

                <li class="menu-item">
                    <a :href="route('products.index')" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-calendar-blank-outline"></i></span>
                        <span class="menu-text"> Products </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a :href="route('categories.index')" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-forum-outline"></i></span>
                        <span class="menu-text"> Categories </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="javascript:void(0)" data-fc-type="collapse" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-email-outline"></i></span>
                        <span class="menu-text"> Attributes </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>

                    <ul class="sub-menu hidden">
                        <li class="menu-item">
                            <a href="email-inbox.html" class="menu-link">
                                <span class="menu-text">Inbox</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a :href="route('vouchers.index')" class="menu-link">
                                <span class="menu-text">Vouchers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a :href="route('vouchers.index')" data-fc-type="collapse" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-clipboard-outline"></i></span>
                        <span class="menu-text"> Vouchers </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                </li>

                <li class="menu-title">Account</li>

                <li class="menu-item">
                    <a :href="route('users.index')" data-fc-type="collapse" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-account-multiple-plus-outline"></i></span>
                        <span class="menu-text"> Users </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                </li>

                <li class="menu-item">
                    <a :href="route('customers.index')" data-fc-type="collapse" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-file-multiple-outline"></i></span>
                        <span class="menu-text"> Customsers </span>
                    </a>
                </li>


                <li class="menu-title">Orders</li>
                <li class="menu-item">
                    <a :href="route('orders.index')" data-fc-type="collapse" class="menu-link">
                        <span class="menu-icon"><i class="mdi mdi-file-multiple-outline"></i></span>
                        <span class="menu-text"> Orders </span>
                        <!-- <span class="menu-arrow"></span> -->
                    </a>
                </li>

                
               </ul>
        </div>
    </div>
</template>
<template>
    <aside class="border-r bg-gray-100 fixed left-0 h-full w-56 px-2 pt-3">
        <div class="flex flex-col font-medium text-sm text-gray-800 tracking-wider mb-4">
            <Link  :href="route('dashboard')" class="flex items-center gap-3   rounded mb-1 py-3 px-6" :class="{ 'bg-gray-200 border border-gray-400/30': $page.url === '/admin/dashboard' }">
                <span>
                    <svg fill="#000" width="18px" height="18px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" id="dashboard" class="icon glyph">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"><rect x="2" y="2" width="9" height="11" rx="2"></rect><rect x="13" y="2" width="9" height="7" rx="2"></rect><rect x="2" y="15" width="9" height="7" rx="2"></rect><rect x="13" y="11" width="9" height="11" rx="2"></rect></g>
                    </svg>
                </span>
                <span>Dashboard</span>
            </Link>
            <Link :href="route('myproducts')" class="flex gap-3 items-center mb-1 py-3 px-6 rounded" :class="{ 'bg-gray-200 border border-gray-400/30': $page.url === '/admin/products' }">
                <span>
                    <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M6 6C5.17157 6 4.5 6.67157 4.5 7.5C4.5 8.32843 5.17157 9 6 9L6 6ZM6 10.5C4.34315 10.5 3 9.15685 3 7.5C3 5.84315 4.34315 4.5 6 4.5H18C19.6569 4.5 21 5.84315 21 7.5C21 9.15685 19.6569 10.5 18 10.5V11.3308C18 13.9668 15.7097 16.142 12.75 16.46V18.75H15V20.25H9V18.75H11.25V16.46C8.29027 16.142 6 13.9668 6 11.3308L6 10.5ZM12 15C14.7029 15 16.5 13.1552 16.5 11.3308V6H7.5V11.3308C7.5 13.1552 9.29713 15 12 15ZM19.5 7.5C19.5 8.32843 18.8284 9 18 9V6C18.8284 6 19.5 6.67157 19.5 7.5Z" fill="#080341"></path></g>
                    </svg>
                </span>
                <span>Products</span>
            </Link>
            <Link :href="route('categories')" class="flex gap-3 items-center mb-1 py-3 px-6 rounded"
            :class="{ 'bg-gray-200 border border-gray-400/30': $page.url === '/admin/categories' }">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                </span>
                <span>Categories</span>
            </Link>
            <Link :href="route('sales.admin')" class="flex gap-3 items-center mb-1 py-3 px-6 hover:bg-gray-200  rounded" :class="{ 'bg-gray-200 border border-gray-400/30': $page.url === '/admin/sales' }" >
                <span>
                    <svg fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path id="XMLID_1157_" d="M6,82c-0.9,0-1.8-0.2-2.6-0.7c-2.4-1.4-3.1-4.5-1.7-6.9L13.9,54c0.9-1.4,2.4-2.4,4.1-2.4 c1.7-0.1,3.3,0.7,4.3,2.1l5.2,7.2l11-18.8c0.8-1.4,2.4-2.4,4-2.5c1.7-0.1,3.3,0.7,4.3,2l9.6,12.9l25.3-42c1.4-2.4,4.5-3.1,6.9-1.7 c2.4,1.4,3.1,4.5,1.7,6.9L61.2,66c-0.9,1.4-2.4,2.3-4,2.4c-1.7,0.1-3.3-0.7-4.3-2l-9.6-12.8L32.2,72.4c-0.9,1.5-2.4,2.4-4.1,2.5 c-1.7,0.1-3.3-0.7-4.3-2.1l-5.2-7.2l-8.3,13.9C9.4,81.1,7.7,82,6,82z"></path></g></svg>
                </span>
                <span>Sales</span>
            </Link>
            <Link :href="route('orders.admin')" class="flex gap-3 items-center mb-1 py-3 px-6 rounded" :class="{ 'bg-gray-200 border border-gray-400/30': $page.url === '/admin/orders' }">
                <span>
                    <svg width="18px" height="18px" viewBox="-3.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"><title>flag</title><desc>Created with Sketch Beta.</desc><defs></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">                         
                                <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-208.000000, -723.000000)" fill="#000000">                                    
                                    <path d="M231,744 C231,744.552 230.552,745 230,745 L225,745 L225,732 L230,732 C230.552,732 231,732.448 231,733 L231,744 L231,744 Z M223,741 C223,741.553 222.552,742 222,742 L214,742 L214,728 L222,728 C222.552,728 223,728.448 223,729 L223,741 L223,741 Z M212,752 C212,752.553 211.552,753 211,753 C210.448,753 210,752.553 210,752 L210,726 C210,725.448 210.448,725 211,725 C211.552,725 212,725.448 212,726 L212,752 L212,752 Z M231,730 L225,730 L225,728 C225,726.896 224.104,726 223,726 L214,726 L214,725 C214,723.896 213.104,723 212,723 L210,723 C208.896,723 208,723.896 208,725 L208,753 C208,754.104 208.896,755 210,755 L212,755 C213.104,755 214,754.104 214,753 L214,744 L223,744 L223,745 C223,746.104 223.94,747 225,747 L231,747 C232.104,747 233,746.104 233,745 L233,732 C233,730.896 232.104,730 231,730 L231,730 Z" id="flag" sketch:type="MSShapeGroup"></path>                                    
                                </g>                             
                            </g>                            
                        </g>
                    </svg>
                </span>
                <span>Orders</span>
            </Link>
            
            
            <Link :href="route('profile.edit')" class="flex gap-3 items-center mb-1 py-3 px-6 rounded"
            :class="{ 'bg-gray-200 border border-gray-400/30': $page.url === '/profile' }"
            
            >
                <span>
                    <svg
                        width="18px"
                        height="18px"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g
                            id="SVGRepo_tracerCarrier"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></g>
                        <g id="SVGRepo_iconCarrier">
                            
                            <path
                                d="M11 3H13C13.5523 3 14 3.44772 14 4V4.56879C14 4.99659 14.2871 5.36825 14.6822 5.53228C15.0775 5.69638 15.5377 5.63384 15.8403 5.33123L16.2426 4.92891C16.6331 4.53838 17.2663 4.53838 17.6568 4.92891L19.071 6.34312C19.4616 6.73365 19.4615 7.36681 19.071 7.75734L18.6688 8.1596C18.3661 8.46223 18.3036 8.92247 18.4677 9.31774C18.6317 9.71287 19.0034 10 19.4313 10L20 10C20.5523 10 21 10.4477 21 11V13C21 13.5523 20.5523 14 20 14H19.4312C19.0034 14 18.6318 14.2871 18.4677 14.6822C18.3036 15.0775 18.3661 15.5377 18.6688 15.8403L19.071 16.2426C19.4616 16.6331 19.4616 17.2663 19.071 17.6568L17.6568 19.071C17.2663 19.4616 16.6331 19.4616 16.2426 19.071L15.8403 18.6688C15.5377 18.3661 15.0775 18.3036 14.6822 18.4677C14.2871 18.6318 14 19.0034 14 19.4312V20C14 20.5523 13.5523 21 13 21H11C10.4477 21 10 20.5523 10 20V19.4313C10 19.0034 9.71287 18.6317 9.31774 18.4677C8.92247 18.3036 8.46223 18.3661 8.1596 18.6688L7.75732 19.071C7.36679 19.4616 6.73363 19.4616 6.34311 19.071L4.92889 17.6568C4.53837 17.2663 4.53837 16.6331 4.92889 16.2426L5.33123 15.8403C5.63384 15.5377 5.69638 15.0775 5.53228 14.6822C5.36825 14.2871 4.99659 14 4.56879 14H4C3.44772 14 3 13.5523 3 13V11C3 10.4477 3.44772 10 4 10L4.56877 10C4.99658 10 5.36825 9.71288 5.53229 9.31776C5.6964 8.9225 5.63386 8.46229 5.33123 8.15966L4.92891 7.75734C4.53838 7.36681 4.53838 6.73365 4.92891 6.34313L6.34312 4.92891C6.73365 4.53839 7.36681 4.53839 7.75734 4.92891L8.15966 5.33123C8.46228 5.63386 8.9225 5.6964 9.31776 5.53229C9.71288 5.36825 10 4.99658 10 4.56876V4C10 3.44772 10.4477 3 11 3Z"
                                stroke="#000000"
                                stroke-width="1.5"
                            ></path>
                            
                            <path
                                d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                stroke="#000000"
                                stroke-width="1.5"
                            ></path>
                            
                        </g>
                    </svg>
                </span>
                <span>Settings</span>
            </Link>
        </div>
    </aside>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

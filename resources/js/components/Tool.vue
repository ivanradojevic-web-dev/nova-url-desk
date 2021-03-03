<template>
    <div class="flex flex-col space-y-4 overflow-x-auto">

        <!-- <button @click="deleteSelect">Delete</button> -->

        <div class="flex justify-between items-center">

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>        
                <input 
                    v-model="query.search"
                    id="search"
                    autocomplete="off" 
                    class="block w-full pl-10 pr-3 py-2 border-2 border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-400 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Search" type="search">        
            </div>

             <div>
                <add-links @createLinksEvent="getRedirects"></add-links>         
             </div>                       

        </div>

        <table class="min-w-full divide-y divide-gray-300 border-1 border-gray-400 rounded shadow">

            <thead class="text-xs bg-gray-200 text-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left  font-bold   tracking-wider">
                        <span>REDIRECT FROM</span>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left  font-bold   tracking-wider">
                        <span>REDIRECT TO</span>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left  font-bold   tracking-wider">
                        <span>CODE</span>
                    </th>
                    <th scope="col" class="relative px-6 py-4">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
      
            <tbody class="bg-white bg-opacity-90">
                <template v-if="redirects.length">
                <tr v-for="redirect in redirects" :key="redirect.id" class="font-normal text-gray-600"> 
                    <td class="w-6/12 px-6 py-3 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex items-center space-x-4 select-all">
                            <span class="cursor-pointer">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </span>
                            <div class="text-sm">
                                {{ redirect.redirect_from | truncate(64, '...') }}
                            </div>
                        </div>                        
                    </td>
                    <td class="w-3/12 px-6 py-3 whitespace-nowrap text-sm text-blue-500">
                        <div class="text-sm ">
                            <a :href="redirect.redirect_to"  target="_blank" class="hover:underline italic">
                                <div>
                                    {{ redirect.redirect_to | truncate(64, '...') }}
                                </div>
                            </a>
                        </div>
                    </td>
                    <td class="w-212 px-6 py-3 whitespace-nowrap">
                        <div class="pl-1 text-sm text-indigo-500 font-semibold">
                            {{redirect.status_code}}
                        </div>
                    </td>
                    <td class="w-1/12 px-6 py-3 whitespace-nowrap text-sm">
                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                            <div>
                                <edit-redirect @editRedirectEvent="getEditedRedirects" :id="redirect.id"></edit-redirect> 
                            </div>
                            <div>
                                <delete-redirect @deleteRedirectEvent="getEditedRedirects" :id="redirect.id"></delete-redirect> 
                            </div>
                        </div>
                    </td>
                </tr>
                </template>
                
                <tr v-else class="font-normal text-gray-600">
                    <td class="w-12/12 px-6 py-3 whitespace-nowrap text-sm" colspan="4">
                        <div class="flex justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </div>
                    </td>
                </tr> 
                
                
            </tbody>
        </table>

        <div v-if="meta.total > 10">
            <pagination-component :meta="meta" v-on:pagination:switched="getRedirects"></pagination-component>
        </div>

    </div>
</template>

<script>

    import PaginationComponent from "../components/pagination/PaginationComponent";
    import AddLinks from "../components/AddLinks";
    import EditRedirect from "../components/EditRedirect";
    import DeleteRedirect from "../components/DeleteRedirect";

    export default {

        components: {
                PaginationComponent,
                AddLinks,
                EditRedirect,
                DeleteRedirect
        },

        data() {
            return {
                redirects: [],
                meta: {},
                currentPage: null, 
                currentSearch: null,
                query: { 
                    search: null,
                },
            }
        },

        methods: {

            getRedirects(page) {                
                axios
                .get('/nova-vendor/urldesk/redirects', {
                    params: {
                        page: page,
                        search: this.query.search,
                    }
                })
                .then( (response) => {
                    this.redirects = response.data.data  
                    this.meta = response.data.meta  

                    this.currentPage = page
                    this.currentSearch = this.query.search
                });
            },

            getEditedRedirects() {                
                axios
                .get('/nova-vendor/urldesk/redirects', {
                    params: {
                        page: this.currentPage,
                        search: this.currentSearch
                    }
                })
                .then( (response) => {
                    this.redirects = response.data.data  
                    this.meta = response.data.meta  
                });
            },

        },

        mounted() {
            this.getRedirects();
        },

        watch: {
            query: {               
                handler: _.debounce(function(v) {
                    this.getRedirects();
                }, 240),
                deep: true,
            }
        }

    };                           

</script>


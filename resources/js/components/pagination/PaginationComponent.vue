<template>
    <div>
        <nav class="px-8 flex items-center justify-center sm:px-0">
            <div class="-mt-px w-0 flex-1 flex">
                <a @click.prevent="switched(meta.current_page - 1)" href="#" :class="{ 'text-gray-300' : meta.current_page === 1}" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                    <svg class="mr-3 h-5 w-5 text-gray-400" x-description="Heroicon name: solid/arrow-narrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Previous
                </a>
            </div>

        <ul class="hidden md:-mt-px md:flex">      
            <template v-if="section > 1">
                <li>
                    <a href="#" @click.prevent="switched(1)" :class="{'text-indigo-600' : meta.current_page === page}" class="border-transparent text-gray-500  pt-4  px-4 inline-flex items-center text-sm font-medium" >1
                    </a>
                </li>
            </template>
           
            <div v-for="page in pages">
                <a @click.prevent="switched(page)" href="#" :class="{'text-indigo-600' : meta.current_page === page}" class="no-underline border-transparent text-gray-500  pt-4  px-4 inline-flex items-center text-sm font-medium">
                    {{page}}
                </a>
            </div>
            
            <template v-if="section < sections"> 
                 <li>
                    <a href="#" @click.prevent="switched(meta.last_page)" :class="{'text-indigo-600' : meta.current_page === page}" class="border-transparent text-gray-500  pt-4  px-4 inline-flex items-center text-sm font-medium"> {{meta.last_page}}
                    </a>
                </li>
            </template>
        </ul>

            <div class="-mt-px w-0 flex-1 flex justify-end">
                <a @click.prevent="switched(meta.current_page + 1)" href="#" :class="{ 'text-gray-400' : meta.current_page === meta.current_page}" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                Next
                    <svg class="ml-3 h-5 w-5 text-gray-400" x-description="Heroicon name: solid/arrow-narrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>

          </nav>


    </div>
</template>

<script>
    export default {

        props: ['meta'],

        data () {
            return {
                numbersPerSection: 12,
            }
        },

        computed: {
            section () {
                return Math.ceil(this.meta.current_page / this.numbersPerSection)
            },
    
            sections () {
                return Math.ceil(this.meta.last_page / this.numbersPerSection)
            },

            lastPage () {
                let lastPage = ( (this.section - 1) * this.numbersPerSection ) + this.numbersPerSection

                if (this.section === this.sections) {
                    lastPage = this.meta.last_page
                }

                return lastPage
            },

            pages () {
                return _.range((this.section - 1) * this.numbersPerSection + 1, 
                    this.lastPage + 1
                )
            },

        },

        methods: {
  	
            switched(page) {
                if (page <= 0 || page > this.meta.last_page) {
                    return
                }
                this.$emit('pagination:switched', page);
            },

        },

        mounted() {
  	
        }

    };                           
</script>
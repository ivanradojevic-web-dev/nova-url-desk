<template>
    <div>
        <button @click="isOpen = true">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </button>

        <!-- Modal -->
        <div v-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
                Background overlay, show/hide based on modal state.
                Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
                Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
                <div @click="isOpen = false" class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-indigo-200 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <!--
                    Modal panel, show/hide based on modal state.
                    Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                    Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                    <form>
                        <!-- card -->
                        <div class=" px-6 pt-8 pb-4 ">

                            <!-- flex-->
                            <div class="w-full ">

                                
                                <!-- right form -->                        
                                <div class="w-full">
                                    <div class="flex flex-wrap">
                                        
                                        <p>Are you sure?</p>
                                        
                                    </div>
                                </div>
                           
                            </div>
                           
                        </div> <!-- end of the card -->
                    </form>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click="deleteRedirect" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-400 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200 sm:ml-3 sm:w-auto sm:text-sm">
                          Yes
                      </button>
                      <button @click="isOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                          No
                      </button>
                    </div>

                </div>

            </div>

        </div>
        <!-- end of the Modal-->

    </div>
</template>

<script>

    export default {

        props: {
            id: {
                type: Number,
                required: true
            }
        },

        data() {
            return {
                isOpen: false,
            }
        },

        methods: {
            deleteRedirect () {
                axios
                .delete('/nova-vendor/urldesk/redirects/' + this.id)
                .then((response) => {
                    this.$emit("deleteRedirectEvent")
                    this.isOpen = false  
                })           
                .catch(error => {
                    //
                });   
            },
        },

    };                           

</script>
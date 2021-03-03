<template>
    <div>
        <button @click="isOpen = true" class="w-32 h-8 bg-blue-400 hover:bg-blue-500 tracking-wide rounded shadow py-1 px-3 text-white font-bold">
           Add Links
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
                            <div v-if="errorMessage" class="text-red-500 text-center text-sm mb-4">{{errorMessage}}</div>
                            <!-- flex-->
                            <div class="w-full ">

                                
                                <!-- right form -->                        
                                <div class="w-full">
                                    <div class="flex flex-wrap">
                                        
                                        <div class="w-full mb-6">
                                            <label class="block text-sm mb-2 text-gray-800 ">
                                              <span>Redirect From</span>
                                              <textarea v-model="redirect_from" class="rounded border-2 border-blue-300  form-textarea mt-1 block w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500" rows="3"></textarea>
                                            </label>
                                        </div>

                                        <div class="w-full mb-6">
                                            <label class="block text-sm mb-2 text-gray-800 ">
                                              <span>Redirect To</span>
                                              <textarea v-model="redirect_to" class="rounded text-gray-800 border-2 border-blue-300  form-textarea mt-1 block w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500" rows="5"></textarea>
                                            </label>
                                        </div>

                                        <div class="w-full mb-6">
                                            <label class="block text-sm mb-2 text-gray-800 ">Status Code</label>
                                            <select v-model="status_code" class="form-select w-full text-base border-2 border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 ">                                                    
                                                    <option value="301">301</option>
                                                    <option value="302">302</option>
                                                    <option value="307">307</option>
                                            </select>              
                                        </div>
                                        
                                    </div>
                                </div>
                           
                            </div>
                           
                        </div> <!-- end of the card -->
                    </form>

                    <div class="space-y-3 sm:space-y-0 items-center bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                          <button @click="createLinks"  type="submit" class="w-full sm:w-24 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-400 text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-200 sm:ml-3 sm:w-auto sm:text-sm">
                            Create
                        </button>
                      <button @click="isOpen = false" type="button" class="mr-4 sm:w-24 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                          Cancel
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

        
        data() {
            return {
                isOpen: false,
                redirect_from: "",
                redirect_to: "",
                status_code: "307",
                errorMessage: "", 
            }
        },

        methods: {
      	    createLinks() {
                axios
                .post('/nova-vendor/urldesk/redirects', {
                    redirect_from: this.redirect_from,
                    redirect_to: this.redirect_to,
                    status_code: this.status_code,
                })
                .then((response) => {
                    this.$emit("createLinksEvent")
                    this.isOpen = false      

                    this.redirect_from = ""
                    this.redirect_to = ""
                    this.status_code = "307"
                    this.errorMessage = ""         
                })           
                .catch(error => {
                    const key = Object.keys(error.response.data.errors)[0]
                    this.errorMessage = error.response.data.errors[key][0]
                });                
            }, 
        },

    };                           

</script>
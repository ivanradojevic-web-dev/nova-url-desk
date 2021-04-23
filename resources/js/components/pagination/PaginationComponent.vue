<template>
    <div class="flex justify-center">

        <ul class="flex space-x-2 no-bullets">
            <li :class="{ 'text-gray-400' : meta.current_page === 1}">
                <a href="#" @click.prevent="switched(meta.current_page - 1)" >&lt;</a>
            </li>
            <template v-if="section > 1">
                <li>
                    <a href="#" @click.prevent="switched(1)">1</a>
                </li>
            </template>
            <li v-for="page in pages" :class="{ 'text-blue-500' : meta.current_page === page}">
                <a href="#" @click.prevent="switched(page)" >{{page}}</a>
            </li>
            <template v-if="section < sections">
                <li>
                    <a href="#" @click.prevent="switched(meta.last_page)">{{meta.last_page}}</a>
                </li>
            </template>
            <li :class="{ 'text-gray-400' : meta.current_page === meta.current_page}">
                <a href="#" @click.prevent="switched(meta.current_page + 1)" >&gt;</a>
            </li>   
        </ul>


    </div>
</template>

<script>
    export default {

        props: ['meta'],

        data () {
            return {
                numbersPerSection: 10,
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

<style>
ul.no-bullets {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
</style>

<template>
    <div>
        <transition name="fadeOpacity">
            <div v-if="focus" @click="focus = false" class="search-modal-bg">
            </div>
        </transition>
        <div class="z-20 relative">
            <div class="absolute" >
                <svg class="w-5 h-5 mt-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12zM7 7V5h2v2h2v2H9v2H7V9H5V7h2z"/></svg>
            </div>
            <input class="search-input" @input="search" @focus="focus= true" type="text" placeholder="Search..." id="searchTerm" v-model="searchTerm">
        </div>
        <transition name="fade" >
            <div v-if="focus" class="search-modal" >
                <div v-if="results.length ==0" >No results found for '<b>{{searchTerm}}</b>' </div>
                <div v-for="result in results" @click="focus = false" :key="result.data.id"  >
                    <router-link :to="result.links.self" class="block py-2" >
                        <div class="flex items-center">
                            <UserCircle :name="result.data.name"></UserCircle>
                            <div class="pl-3">
                                <p>{{result.data.name}}</p>
                                <p class="text-xs text-gray-400" >{{result.data.company}}</p>
                            </div>
                        </div>
                    </router-link>

                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import _ from 'lodash';
import UserCircle from './UserCircle';


export default {
    name: 'SearchBar',
    components: {
        UserCircle
    },
    data: function(){
        return {
            'searchTerm': '',
            'focus': false,
            'results': []
        }
    },
    methods: {
        search: _.debounce(function(e) {
            let q = this.searchTerm.trim();
            if (q.length<2){
               this.results = [];
               return;
            }
            axios.post('/api/search', {q}).then(response=>{
                 this.results = response.data.data;
            }).catch(err=>{
                console.log(err.response);
            });
        }, 350)
    }

}
</script>

<style lang="scss" >
.search-input{
    transition: all .3s ;
    @apply w-64 mr-6 bg-gray-200 border border-gray-400 pl-8 pr-3 py-1 rounded-full text-sm;

    &:focus{
        @apply outline-none;
    }

    &:focus{
        @apply border-blue-500 bg-white shadow ;
    }
}
.search-modal{
    @apply absolute bg-blue-900 text-white rounded-lg p-4 w-96 right-0 mr-6 mt-2 shadow z-30
}
.search-modal-bg{
    opacity: 0.15;
    @apply bg-black absolute right-0 left-0 top-0 bottom-0 z-10;
}
</style>

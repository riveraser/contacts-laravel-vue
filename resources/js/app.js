import Vue from 'vue';
import router from './router';
import App from './components/App.vue';

require('./bootstrap');


//Vue wil be loaded withing the project
//window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: { 
        App
    },
    router
});

/***
 * All the routing for Vue will be declared here instead of app.js
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent.vue'
import ContactsCreate from './views/ContactsCreate'

Vue.use(VueRouter);

export default new VueRouter({
    routes:[
        {path: '/', component: ExampleComponent},
        {path: '/contacts/create', component: ContactsCreate}
    ],
    mode: 'history'
});
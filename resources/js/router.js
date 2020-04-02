/***
 * All the routing for Vue will be declared here instead of app.js
 */

 import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent.vue';
import ContactsCreate from './views/ContactsCreate';
import ContactsShow from './views/ContactsShow';
import ContactsEdit from './views/ContactsEdit';
import ContactsIndex from './views/ContactsIndex';

Vue.use(VueRouter);

export default new VueRouter({
    routes:[
        {path: '/', component: ExampleComponent},
        {path: '/contacts', name:'contacts', component: ContactsIndex},
        {path: '/birthdays', name:'birthdays', component: ContactsIndex},
        {path: '/contacts/create', component: ContactsCreate},
        {path: '/contacts/:id', component: ContactsShow},
        {path: '/contacts/:id/edit', component: ContactsEdit},
    ],
    mode: 'history'
});

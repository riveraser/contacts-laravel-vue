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
import Logout from './actions/Logout';

Vue.use(VueRouter);

export default new VueRouter({
    routes:[
        {
            path: '/', name:'contacts', component: ContactsIndex,
            meta: { title: 'Welcome'  }
        },
        {
            path: '/contacts', name:'contacts', component: ContactsIndex,
            meta: { title: 'Contacts'}
        },
        {
            path: '/birthdays', name:'birthdays', component: ContactsIndex,
            meta: { title: 'Current month birthdays'  }
        },
        {
            path: '/contacts/create', name:'newContact', component: ContactsCreate,
            meta: { title: 'Add new Contact' }
        },
        {
            path: '/contacts/:id', name:'contactDetail', component: ContactsShow,
            meta: { title: 'Details for Contact'  }
        },
        {
            path: '/contacts/:id/edit', name:'editContact', component: ContactsEdit,
            meta: { title: 'Edit Contact information'  }
        },
        {
            path: '/logout', component: Logout
        },
    ],
    mode: 'history'
});

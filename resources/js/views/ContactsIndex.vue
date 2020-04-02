<template>
    <div>
        <div v-if="contacts.length == 0" >
            <p class="py-4" >No contacts yet <router-link to="/contacts/create" >Get Started</router-link> </p>
        </div>
        <div v-for="contact in contacts" :key="contact.data.contact_id">
            <router-link :to="`/contacts/${contact.data.contact_id}`"
                class="flex items-center border-b border-gray-400 p-4 hover:bg-gray-100"
            >
                <UserCircle :name="contact.data.name"></UserCircle>
                <div class="ml-6" >
                    <p class="text-blue-400 font-bold" >{{contact.data.name}}</p>
                    <p class="text-gray-600"  >{{contact.data.company}}</p>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
import UserCircle from "../components/UserCircle";

export default {
    name: 'ContactsIndex',
    components: {UserCircle},
    data: function(){
        return {
            contacts: {},
            route:'/api/contacts'
        }
    },
    mounted(){

    },
    methods:{
        fetchContacts(){
            axios.get( this.route).then(response=>{
                this.contacts = response.data.data;
            }).catch(err=>{
                alert('Error while loading the Contacts');
            });
        }
    },
    beforeRouteEnter (to, from, next) {
        //Will fetch Birthdays or Contacts depending on the route name
        //we are reusing the same view for this example since the layout and
        //information are the same for both
        next(vm => {
            // access to component instance via `vm`
            vm.route = to.name == 'birthdays'? '/api/birthdays' : '/api/contacts';
            vm.fetchContacts();
        })
     }

}
</script>

<style>

</style>

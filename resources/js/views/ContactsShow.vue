<template>
    <div class="">
        <div class="flex justify-between">
            <a href="#" class="text-blue-400" @click.prevent="$router.back()" > <b>&lsaquo;</b> back</a>
            <div>
                <router-link class="btn btn-edit mr-2" :to="'/contacts/' + contact.contact_id + '/edit'" >Edit</router-link>
                <a @click.prevent="showModal = true" class="btn btn-delete"  href="#">Delete</a>
            </div>
        </div>
        <div class="flex items-center pt-6" >
            <UserCircle :name="contact.name" ></UserCircle>
            <p class="pl-5 text-xl" >{{contact.name}}</p>
        </div>
        <p class="pt-6 text-gray-600 font-bold uppercase text-xs">Contact</p>
        <p class="pt-2 text-blue-400" >{{contact.email}}</p>

        <p class="pt-6 text-gray-600 font-bold uppercase text-xs">Company</p>
        <p class="pt-2 text-blue-400">{{contact.company}}</p>

        <p class="pt-6 text-gray-600 font-bold uppercase text-xs">Birthday</p>
        <p class="pt-2 text-blue-400">{{contact.birthday}}</p>
        <Modal :show.sync="showModal" >
            <template v-slot:header>Confirm Delete</template>
            <p>Are you sure you want to delete this record?</p>
            <template v-slot:actions>
                <button class="btn btn-secondary mr-2" @click.prevent="showModal=false" > Cancel</button>
                <button class="btn btn-primary" @click.prevent="destroy">Delete</button>
            </template>
        </Modal>
    </div>
</template>

<script>
import UserCircle from '../components/UserCircle';
import Modal from '../components/Modal';

export default {
    name: 'ContactsShow',
    components: {
        UserCircle,
        Modal
    },
    data: function() {
        return {
            contact: {},
            showModal: false
        }
    },
    mounted(){
        this.fetchData();
    },
    methods:{
        fetchData(){
            axios.get( `/api/contacts/${this.$route.params.id}`).then(response=>{
                this.contact = response.data.data;
            }).catch(err=>{

                if (err.response.status === 404){
                    this.$router.push('/contacts');
                }
            });
        },
        destroy() {
            axios.delete( `/api/contacts/${this.$route.params.id}`).then(response=>{
                this.$router.push('/contacts');
            }).catch(err=>{
                alert("Internal Error. Unable to delete contact.");
            });
        }
    },
    watch: {
        $route(to, from){
            //We need to get the new Contact detail
            //this is due to the Search option that changes the route
            if (to.name == "contactDetail"){
                this.fetchData();
            }
        },
    }

}
</script>

<style>

</style>

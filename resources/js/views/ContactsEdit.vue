<template>
    <div>
        <div class="flex justify-between">
            <a href="#" class="text-blue-400" @click.prevent="$router.back()" > <b>&lsaquo;</b> back</a>
            <!-- <router-link :to="`/contacts/${this.$route.params.id}`">&lt; back</router-link> -->
        </div>
        <form @submit.prevent="submiForm">
            <InputField name="name" label="Contact name" placeholder="Contact name"
                :data.sync="form.name" :errors="errors"></InputField>
            <InputField name="email" label="Contact Email" placeholder="Contact email"
                :data.sync="form.email" :errors="errors"></InputField>
            <InputField name="company" label="Company" placeholder="Company"
                :data.sync="form.company" :errors="errors"></InputField>
            <InputField name="birthday" label="Birthday" placeholder="MM/DD/YYYY"
                :data.sync="form.birthday" :errors="errors"></InputField>

            <div class="flex justify-end" >
                <button @click.prevent="$router.push(`/contacts/${$route.params.id}`)"  class="btn btn-secondary mr-2" >Cancel</button>
                <button class="btn btn-primary" :disabled="sending" >Save</button>
            </div>
        </form>
    </div>
</template>

<script>

import InputField from '../components/InputField';

export default {
    name: 'ContactsEdit',
    components: { InputField },
    data: function(){
        return {
            form: {
                name: '',
                email: '',
                company: '',
                birthday: ''
            },
            errors: null,
            sending: false
        }
    },
    mounted(){

        axios.get( `/api/contacts/${this.$route.params.id}`).then(response=>{
            this.form = response.data.data;
        }).catch(err=>{
            if (err.response.status === 404){
                this.$router.back();
            }
        });

    },
    methods: {
        submiForm(){
            
            if (!this.sending){
                this.sending = true;
                axios.put(`/api/contacts/${this.$route.params.id}`, this.form).then(response=>{
                    this.$router.push(response.data.links.self);
                }).catch(err=>{
                    this.errors = err.response.data.errors;
                }).finally(err=>{
                   this.sending = false;
                });
            }
        }
    }
}
</script>

<style>

</style>

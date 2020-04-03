<template>
    <div>
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
                <button @click.prevent="$router.push('/')" class="btn btn-secondary mr-2" >Cancel</button>
                <button class="btn btn-primary" :disabled="sending" >Add new contact</button>
            </div>
        </form>
    </div>
</template>

<script>

import InputField from '../components/InputField';

export default {
    name: 'ContactsCreate',
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
    methods: {
        submiForm(){
             if (!this.sending){
                this.sending = true;
                axios.post('/api/contacts', this.form).then(response=>{
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

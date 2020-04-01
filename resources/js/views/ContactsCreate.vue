<template>
    <div>
        <form @submit.prevent="submiForm">
            <InputField name="name" label="Contact name" placeholder="Contact name"
                @update:field="form.name = $event" :errors="errors"></InputField>
            <InputField name="email" label="Contact Email" placeholder="Contact email"
                @update:field="form.email = $event" :errors="errors"></InputField>
            <InputField name="company" label="Company" placeholder="Company"
                @update:field="form.company = $event" :errors="errors"></InputField>
            <InputField name="birthday" label="Birthday" placeholder="MM/DD/YYYY"
                @update:field="form.birthday = $event" :errors="errors"></InputField>

            <div class="flex justify-end" >
                <button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700 shadow-sm " >Cancel</button>
                <button class="bg-blue-500 py-2 px-4 rounded text-white hover:bg-blue-400 shadow-md" >Add new contact</button>
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
            errors: null
        }
    },
    methods: {
        submiForm(){
            axios.post('/api/contacts', this.form).then(response=>{

            }).catch(err=>{
                this.errors = err.response.data.errors;
            });
        }
    }
}
</script>

<style>

</style>

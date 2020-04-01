<template>
  <div class="relative pb-4">
    <label :for="name" class="absolute text-blue-500 uppercase text-xs font-bold pt-2">{{label}}</label>
    <input
      class="pt-8 text-gray-800 w-full border-b pb-2 focus:outline-none focus:border-blue-400 input-field"
      :class="{ 'error-field': errorMessage }"
      :id="name"
      type="text"
      :placeholder="placeholder"
      @input="updateField()"
      v-model="value"
    />
    <transition name="fade" >
        <p v-if="errorMessage" class="text-red-500 text-sm" v-text="errorMessage" >Error here</p>
    </transition>
  </div>
</template>

<script>
export default {
  name: "InputField",
  props: ["name", "label", "placeholder", "errors"],
  data: function () {
      return {
          value: ''
      }
  },
  computed: {
      errorMessage(){
        return (this.errors && this.errors[this.name] &&  this.errors[this.name].length > 0) ? this.errors[this.name][0] : '';
      }
  },
  methods: {
      updateField(){
          if (this.errors && this.errors[this.name] &&  this.errors[this.name].length > 0){
              this.errors[this.name] = null;
          }
          this.$emit('update:field',this.value)
      }
  }
};
</script>

<style>
.input-field{
    transition: all .3s ease-out;
}
.error-field {
    @apply .border-red-500 .border-b-2
}
.error-field:active, .error-field:focus {
    @apply .border-red-300 .border-b-2 !important
}
</style>

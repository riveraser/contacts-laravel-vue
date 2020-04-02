<template>
    <div class="rounded-full uppercase font-bold text-blue-500 bg-blue-200 w-10 h-10 flex justify-center items-center border border-blue-300 shadow " >
        {{userNameInitials}}
    </div>
</template>

<script>
export default {
    name: 'UserCircle',
    props:[
        'name'
    ],
    computed: {
        userNameInitials: function(){
            if (!this.name) return '';
            let myArray = this.name.split(" ");
            if (myArray.length > 1){
                return String(myArray[0].slice(0,1) + myArray[1].slice(0,1)).toUpperCase()
            } else {
                return String(myArray[0].slice(0,2)).toUpperCase()
            }
        }
    }
}
</script>
<style>
</style>
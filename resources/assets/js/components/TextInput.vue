<template>
    <input 
        v-bind:id="name"
        v-bind:name="name"
        v-bind:placeholder="placeholder"

        v-on:keyup="onInput"

        class="form-control" />
</template>

<script>
    export default {
        props: ['name', 'placeholder', 'type'],
        
        data(){
            return {
            }
        },

        methods: {
            onInput(e) {
                const value = e.target.value;
                this.$emit('input', value);
            }
        }
    }
</script>
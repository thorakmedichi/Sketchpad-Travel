<script>
    export default {
        name: 'rs-input',

        props: ['label', 'name'],

        data(){
            return {

            }
        }
    }
</script>

<template>
    <md-input-container>
        <label>{{ label }}</label>
        <md-input :name="name"></md-input>
    </md-input-container>
</template>
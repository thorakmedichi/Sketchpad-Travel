<script>
    export default {
        name: 'rs-textarea',

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
        <md-textarea :name="name"></md-textarea>
    </md-input-container>
</template>
<script>
    export default {
        name: 'rs-select',

        props: ['label', 'name', 'options'],

        data(){
            return {

            }
        }
    }
</script>

<template>
    <md-input-container>
        <label>{{ label }}</label>
        <md-select :name="name">
            <md-option v-for="option in options" :value="option.value">{{ option.text }}</md-option>
        </md-select>
    </md-input-container>
</template>
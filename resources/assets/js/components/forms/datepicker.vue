<script>
    // Components
    // https://github.com/charliekassel/vuejs-datepicker
    import Datepicker from 'vuejs-datepicker'

    // Libraries
    import moment from 'moment'

    export default {
        name: 'rs-datepicker',

        props: ['label', 'name'],

        data(){
            return {

            }
        }, 
        methods: {
            dateFormat(date){
                return moment(date).format('YYYY-MM-DD');
            }
        },
        components: {
            Datepicker
        }
    }
</script>

<template>
    <md-input-container>
        <label>{{ label }}</label>
        <datepicker :inline="true" :format="dateFormat" :name="name"></datepicker>
    </md-input-container>
</template>

<style>
    
</style>
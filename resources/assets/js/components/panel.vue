<script>
    export default {
        name: 'panel',

        props: ['title'],

        data(){
            return {

            }
        }
    }
</script>

<template>
    <md-card>
        <md-card-header>
            <h2 class="md-title">{{ title }}</h2>
        </md-card-header>

        <md-card-content>

            <slot></slot>
            
        </md-card-content>
    </md-card>
</template>
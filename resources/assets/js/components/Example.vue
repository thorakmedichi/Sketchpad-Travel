<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Example Component</div>

                <div class="panel-body">

                    <span v-bind:title="message">
                        Hover your mouse over me for a few seconds
                        to see my dynamically bound title!
                    </span>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        }, 

        data(){
            return {
                message: 'You loaded this page on ' + new Date()
            }
        }
    }
</script>

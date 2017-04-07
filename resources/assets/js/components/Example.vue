<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">New Post</h3>
                </div>
                <div class="panel-body">

                
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

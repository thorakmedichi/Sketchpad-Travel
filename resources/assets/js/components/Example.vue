<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">New Post</h3>
                </div>
                <div class="panel-body">

                    <inputWrapper label="My Label" icon="fa-user">
                        <textInput v-validate="'required|email'" @input="textInputChange" name="test" placeholder="Edit me"></textInput>
                    </inputWrapper>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
            }
        }, 

        methods: {
            textInputChange: function (value){
                console.log (value);
                console.log (this.$validator.errorBag.errors);
            }
        }
    }
</script>

<template>
    <div class="form-group" v-bind:class="{ 'has-error': errors.has('email') }">
        <div class="col-md-12">
            <label>{{ label }}</label>
            <div class="input-group">
                <span class="input-group-addon" v-if="icon"><i class="fa fa-lg " v-bind:class="icon"></i></span>
                <slot></slot> <!-- Input element passed from parent -->
            </div>
            <small class="help-block" v-show="errors.has('email')">
                <strong>{{ errors.first('email') }}</strong>
            </small>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['label', 'icon'],

        data(){
            return {
            }
        }
    }
</script>
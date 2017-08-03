<script>
    export default {
        props: ['title']
    }
</script>

<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ title }}</h3>
                </div>
                <div class="panel-body">

                    <slot></slot>
                
                </div>
            </div>
        </div>
    </div>
</template>


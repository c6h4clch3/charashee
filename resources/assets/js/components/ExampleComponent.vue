<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Example Component</div>

                <div class="panel-body">
                    {{ character.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue, { Component } from 'vue';
import { mapState } from 'vuex';
export default {
    mounted(): void {
        this.$store.dispatch('get', 1);
    },
    computed: {
        ...mapState([
            'character',
        ]),
    }
} as Component;
</script>

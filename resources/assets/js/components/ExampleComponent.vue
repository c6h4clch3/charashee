<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Example Component</div>

                <div class="panel-body">
                    {{ character.name }}
                </div>
                <input v-model="character.age">
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import { mapState } from 'vuex';
export default Vue.extend({
    mounted(): void {
        this.$store.dispatch('character/get', 1);
    },
    computed: {
        character: {
            get(): character {
                return this.$store.state.character;
            },
            set(value: character): void {
                this.$store.dispatch('character/input', value);
            }
        }
    },
});
</script>

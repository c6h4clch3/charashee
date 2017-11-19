<template>
<div class="row">
  <div class="col-md-8 col-md-push-2">
    <div class="panel panel-default">
      <router-view v-model="character"></router-view>
    </div>
  </div>
</div>
</template>

<script lang="ts">
import { Component } from 'vue';
import 'vue-router';
import axios from 'axios';

export default {
  computed: {
    character: {
      get(): character {
        return this.$store.state.character as character;
      },
      set(character: character): void {
        this.$store.dispatch('character/input', character);
      }
    },
  },
  props: [
    'id',
  ],
  mounted() {
    if (this.$props.id !== undefined) {
      this.$store.dispatch('character_id', this.$props.id);
      this.$store.dispatch('character/get', this.$props.id);
    }
  },
} as Component;
</script>

<style>

</style>

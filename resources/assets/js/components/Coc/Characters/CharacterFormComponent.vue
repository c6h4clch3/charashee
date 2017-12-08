<template>
<panel>
  <div slot="title">
    キャラクター作成/編集
  </div>

  <div slot="body">
    <panel class="form-horizontal">
      <div slot="title">キャラクター基本情報</div>
      <div slot="body">
        <div class="form-group">
          <label class="col-md-2 control-label" for="name">名前:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="name" name="name">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="age">年齢:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="age" name="age">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="sex">性別:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="sex" name="sex">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="job">職業:</label>
          <div class="col-md-5">
            <input class="form-control" v-model="job" name="job">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="job">タグ:</label>
          <div class="col-md-5">
            <input class="form-control" v-model.lazy="character_tags" name="tag">
          </div>
        </div>
      </div>
    </panel>

    <panel>
      <div slot="title">
        能力値
      </div>

      <div slot="body">
        <character-parameters />
      </div>
    </panel>

    <panel>
      <div slot="title">
        技能値
      </div>

      <div slot="body">
        <character-skills />
      </div>
    </panel>

    <panel>
      <div slot="title">
        その他/備考
      </div>

      <div slot="body">
        <div class="form-group">
          <textarea class="form-control" v-model="comment"></textarea>
        </div>
      </div>
    </panel>
  </div>
</panel>
</template>

<script lang="ts">
import Vue from 'vue';
import CharacterParameters from './CharacterParameters.vue';
import CharacterSkills from './CharacterSkillsComponent.vue';
import Panel from '../../Molecules/Panel.vue';
import * as _ from 'lodash';

export default Vue.extend({
  data(): character {
    return this.$store.state.character as character;
  },
  computed: {
    character(): character {
      return this.$store.state.character as character;
    },
    character_tags: {
      get(): string {
        return this.tags.join(' ');
      },
      set(value: string) {
        value = value.trim();
        const tags = _.filter(value.split(' '), function(tag) {
          return tag !== '';
        });
        this.tags = tags;
      }
    }
  },
  updated() {
    this.$store.dispatch('character/input', this.$data);
  },
  props: [
    'isCreate'
  ],
  components: {
    CharacterParameters,
    CharacterSkills,
    Panel
  }
});
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0
}
</style>

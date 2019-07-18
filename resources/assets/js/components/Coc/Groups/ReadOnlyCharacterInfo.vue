<template>
  <accordion :key="character.id" v-model="isOpen">
    <div class="form-inline" :class="$style['character-container']">
      <h5 :class="$style.header">能力値</h5>
      <div class="form-group" v-for="(param, key) in parameters" :key="key">
        <label class="control-label">{{ key.toUpperCase() }} :</label>
        <p class="form-control-static">
          {{ param }}
        </p>
      </div>
    </div>
    <hr :class="$style.hr" />
    <div :class="$style['second-parameters']"></div>
    <hr :class="$style.hr" />
    <div :class="$style.skills">
      <h5 :class="$style.header">技能値</h5>
    </div>
  </accordion>
</template>

<script lang="ts">
import Vue from "vue";
import * as _ from "lodash";
import Accordion from "../../Molecules/Accordion.vue";
export default Vue.extend({
  props: {
    value: Object
  },
  data() {
    return {
      character: this.value,
      isOpen: false
    };
  },
  computed: {
    parameters(): { [key: string]: number } {
      const targets = ["str", "con", "dex", "pow", "app", "siz", "int", "edu"];
      const character = this.character;

      return _.mapValues(_.keyBy(targets), function(target) {
        return _.get(character, target) as number;
      });
    },
    secondParameters(): {
      [key: string]: { display_name: string; value: number };
    } {
      return {
        hp: {
          display_name: "HP",
          value: this.character.hp + this.character.hp_additional
        },
        mp: {
          display_name: "MP",
          value: this.character.mp + this.character.mp_additional
        },
        luck: {
          display_name: "幸運",
          value: this.character.pow * 5
        },
        idea: {
          display_name: "アイデア",
          value: this.character.int * 5
        },
        knowledge: {
          display_name: "知識",
          value: this.character.edu * 5
        },
        mythos_skill: {
          display_name: "クトゥルフ神話技能",
          value: this.character.mythos_skill
        }
      };
    }
  },
  components: {
    Accordion
  }
});
</script>

<style lang="scss" module>
.character-container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-gap: 5px;
  position: relative;
}

.header {
  grid-column: 1 / 4;
}

.hr {
  border-color: #ccc;
  margin: 10px 0;
}

.second-parameters {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-gap: 5px;
  position: relative;
  grid-template-columns: 1fr 1fr 1fr 1fr;
}
</style>

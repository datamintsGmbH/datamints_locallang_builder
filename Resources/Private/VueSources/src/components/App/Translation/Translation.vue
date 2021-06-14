<template>
  <div class="mb-2">
    <!-- Button to expand/collapse the translation entity -->
    <b-button
        :class="buttonClass"
        block
        variant="primary"
        @click="toggle">
      <span class="position-relative">
        <key-icon class="text-white" height="16px" width="16px"></key-icon>

        <strong>Key: </strong>
        <!-- Rename Function -->
        <TranslationRename :translation="translation"/>
      </span>
      <!-- Badge with default translation value -->
      <span
          v-b-tooltip.hover
          class="badge badge-light badge-pill limit-width"
          title="Default Translation"
      >{{ getDefaultValue.value }}</span>
    </b-button>
    <b-collapse v-model="translation.expanded" role="tabpanel" visible>
      <div v-for="value in translation.translationValues" :key="value.ident">
        <TranslationValue
            :defaultValue="getDefaultValue"
            :rerender="render"
            :translationValue="value"
        />
      </div>

      <!-- Action to add another translation-value           -->
      <TranslationValueAdd
          :defaultValue="getDefaultValue"
          :extension="extension"
          :identList="currentIdentList()"
          :rerender="render"
          :translation="translation"
      />
    </b-collapse>
  </div>
</template>

<script>
import TranslationValue from "./TranslationValue";
import TranslationValueAdd from "./TranslationValueAdd";
import TranslationRename from "./TranslationRename";

export default {
  name: "Translation",
  props: ["translation"],
  computed: {
    getDefaultValue: function () {
      for (let translationValueKey in this.translation.translationValues) {
        if (
            this.translation.translationValues[translationValueKey].ident == "en"
        ) {
          return this.translation.translationValues[translationValueKey];
        }
      }
      return null;
    },

    buttonClass: function () {
      return (
          "badge bg-gradient-primary badge-textmove d-block text-left p-2 d-flex justify-content-between align-items-center" +
          (this.translation.expanded === true ? " badge-force-textmove" : "")
      );
    },
  },
  data() {
    return {};
  },
  methods: {
    toggle() {
      this.translation.expanded = !this.translation.expanded;
    },
    currentIdentList() {
      // TODO not updating after insert. Check why...
      const list = [];
      for (let translationValueKey in this.translation.translationValues) {
        list.push(
            this.translation.translationValues[translationValueKey].ident
        );
      }
      return list;
    },
    render() {
      // method to re-render this component. Its required in the translationAdd-Component. For some reason its not updating otherwise
      this.$forceUpdate();
    },
  },

  components: {
    TranslationValue,
    TranslationValueAdd,
    TranslationRename,
  },
};
</script>
<style lang="scss">
.arrow-up {
  display: none;
}

.cursor-selection {
  cursor: text;
  color: #eee !important;

  &:hover {
    color: #fff !important;
    text-decoration: underline;
  }
}

.badge-textmove {
  > span {
    transition: padding-left 0.3s;
  }

  &:hover {
    > span {
      padding-left: 1rem;

      .hide-hover-expand {
        opacity: 0;
      }
    }
  }
}

.limit-width {
  max-width: 450px;
  overflow: hidden;
  text-overflow: ellipsis;
}

.badge-force-textmove {
  & > span {
    /*  So the padding stays when expanded */
    padding-left: 1rem;
  }
}
</style>
<style scoped>
</style>

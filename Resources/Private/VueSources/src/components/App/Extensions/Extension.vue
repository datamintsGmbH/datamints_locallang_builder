<template>
  <div>
    <div id="accordion-1"></div>
    <b-card-header header-tag="header" class="p-0" role="tab">
      <b-button
        block
        @click="toggle" 
        :variant="collapsedButtonColor"
        class="text-left rounded-0"
      >
        <b-icon
          icon="arrow-down-circle-fill"
          :variant="dark"
          :rotate="iconRotate"
        ></b-icon>
        <strong class="pl-2">Extension:</strong> {{ extension.name }}
      </b-button>
    </b-card-header>
    <b-collapse role="tabpanel" v-model="collapsed">
      <Locallangs :locallangs="getLocallangs" />
    </b-collapse>
  </div>
</template>

<script>
import Locallangs from "./locallang/Locallangs";
export default {
  name: "Extension",
  props: ["extension"],
  data() {
    return {
      locallangTableFields: ["filename"],
      collapsed: false,
    };
  },
  computed: {
    getLocallangs() {
      return this.extension.locallangs;
    },
    iconRotate() {
      return this.collapsed ? 180 : 0;
    },
    collapsedButtonColor() {
      return this.collapsed ? "primary" : "light";
    },
  },
  methods: {
    rowClass(item, type) {
      if (!item || type !== "row") return;
      if (item.isTranslatable) return "table-success";
    },
    toggle() {
      this.collapsed = !this.collapsed;
    },
  },
  components: {
    Locallangs,
  },
};
</script>

<template>
  <b-nav-item
    :is="baseComponent"
    :to="link.path ? link.path : '/'"
    class="nav-item"
    :class="{ active: isActive }"
  >
    <a
      v-if="isMenu"
      class="sidebar-menu-item nav-link"
      :class="{ active: isActive }"
      :aria-expanded="!collapsed"
      data-toggle="collapse"
      @click.prevent="collapseMenu"
    >
      <template v-if="addLink">
        <span class="nav-link-text overflow-prevent">
          {{ link.name }} <b class="caret"></b>
        </span>
      </template> 
      <template v-else>
        <i v-if="collapsed">
          <folder-dev-icon width="20px" height="20px" ></folder-dev-icon>  
        </i>
        <i v-else>
          <file-folder-icon width="20px" height="20px"></file-folder-icon>
        </i>

        <span v-if="titleHasMoreThan22Chars" class="nav-link-text overflow-prevent" :title="link.name" v-b-tooltip.hover>{{ link.name }} <b class="caret"></b></span>
        <span v-else class="nav-link-text overflow-prevent">{{ link.name }} <b class="caret"></b></span>
      </template>
    </a>

    <collapse-transition>
      <div
        v-if="$slots.default || this.isMenu"
        v-show="!collapsed"
        class="collapse show"
      >
        <ul class="nav nav-sm flex-column">
          <slot></slot>
        </ul>
        
      </div>
    </collapse-transition>

    <slot
      name="title"
      v-if="children.length === 0 && !$slots.default && link.path"
    >
      <a
        @click.native="linkClick"
        class="nav-link text-break"
        :class="{ active: link.active }"
        :target="link.target"
        href="#"
        @click="linkClick"
      >
        <template v-if="addLink">
          <span class="nav-link-text" >{{ link.name }}</span>
        </template>
        <template v-else>
          <i :class="link.icon"></i>
          <span class="nav-link-text">{{ link.name }}</span>
        </template>
      </a>
    </slot>
  </b-nav-item>
</template>
<script>
import { CollapseTransition } from "vue2-transitions";

export default {
  name: "sidebar-item",
  components: {
    CollapseTransition,
  },
  props: {
    locallang: {
      type: Object,
    },
    menu: {
      type: Boolean,
      default: false,
      description:
        "Whether the item is a menu. Most of the item it's not used and should be used only if you want to override the default behavior.",
    },
    link: {
      type: Object,
      default: () => {
        return {
          name: "",
          path: "",
          children: [],
        };
      },
      description:
        "Sidebar link. Can contain name, path, icon and other attributes. See examples for more info",
    },
  },
  provide() {
    return {
      addLink: this.addChild,
      removeLink: this.removeChild,
    };
  },
  inject: {
    addLink: { default: null },
    removeLink: { default: null },
    autoClose: {
      default: true,
    },
  },
  data() {
    return {
      children: [],
      collapsed: true,
    };
  },
  computed: {
    titleHasMoreThan22Chars() {
      return this.link.name.length > 22;
    },
    baseComponent() {
      return this.isMenu || this.link.isRoute ? "li" : "a";
    },
    linkPrefix() {
      if (this.link.name) {
        let words = this.link.name.split(" ");
        return words.map((word) => word.substring(0, 1)).join("");
      }
      return null;
    },
    isMenu() {
      return this.children.length > 0 || this.menu === true;
    },
    isActive() {
      if (this.$route && this.$route.path) {
        let matchingRoute = this.children.find((c) =>
          this.$route.path.startsWith(c.link.path)
        );
        if (matchingRoute !== undefined) {
          return true;
        }
      }
      return false;
    },
  },
  methods: {
    addChild(item) {
      const index = this.$slots.default.indexOf(item.$vnode);
      this.children.splice(index, 0, item);
    },
    removeChild(item) {
      const tabs = this.children;
      const index = tabs.indexOf(item);
      tabs.splice(index, 1);
    },
    elementType(link, isParent = true) {
      if (link.isRoute === false) {
        return isParent ? "li" : "a";
      } else {
        return "a";
      }
    },
    linkAbbreviation(name) {
      const matches = name.match(/\b(\w)/g);
      return matches.join("");
    },
    linkClick() {
      if (
        this.autoClose &&
        this.$sidebar &&
        this.$sidebar.showSidebar === true
      ) {
        this.$sidebar.displaySidebar(false);
      }
      this.$emit("locallang", this.locallang.uid);
    },
    collapseMenu() {
      this.collapsed = !this.collapsed;
    },
    collapseSubMenu(link) {
      link.collapsed = !link.collapsed;
    },
  },
  mounted() {
    if (this.addLink) {
      this.addLink(this);
    }
    if (this.link.collapsed !== undefined) {
      this.collapsed = this.link.collapsed;
    }
    if (this.isActive && this.isMenu) {
      this.collapsed = false;
    }
  },
  destroyed() {
    if (this.$el && this.$el.parentNode) {
      this.$el.parentNode.removeChild(this.$el);
    }
    if (this.removeLink) {
      this.removeLink(this);
    }
  },
};
</script>
<style lang="scss" scoped>
.overflow-prevent {
  overflow-x: hidden;
  text-overflow: ellipsis;
}
.sidebar-menu-item {
  cursor: pointer;
}
</style>

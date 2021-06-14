<template>
  <!-- Left div because b-navbar does not trigger on mouseenter / mouseleave events -->
  <div class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-primary bg-white"
       @mouseenter="$sidebar.onMouseEnter()"
       @mouseleave="$sidebar.onMouseLeave()"
       :data="backgroundColor">
    <div class="scrollbar-inner" ref="sidebarScrollArea">
      <div class="sidenav-header d-flex align-items-center">
        <b-navbar-brand href="#">
          <svg version="1.1" width="129px" height="56px" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
              viewBox="0 0 283.5 118.2" enable-background="new 0 0 283.5 118.2" xml:space="preserve">
            <path fill="#1A1A1A" d="M23.8,72.7l5.6,0l0,44.9l-4.1,0l-1.1-3l-2.2,1.2c-3.1,1.7-5.5,2.3-8.3,2.4c-8.2,0-13.8-6.5-13.8-15.8
              c0-10.3,7-16.1,14-16.1c2.9,0,5.5,0.9,8.2,2.3l1.6,0.8L23.8,72.7z M23.8,94.8c0-0.8-0.1-1-0.8-1.3c-2.5-1.3-5.5-2.1-8.1-2.1
              c-5.8,0-9.2,3.5-9.2,10.9c0,7.7,3.4,10.8,8.9,10.8c2.8,0,6.3-1,8.4-2.2c0.6-0.3,0.7-0.6,0.7-1.3L23.8,94.8z"/>
            <path fill="#1A1A1A" d="M55.9,97.8c0-2.4-0.4-3.7-1.3-4.7c-1.2-1.3-3.2-1.9-5.8-1.9c-2.3,0-4.8,0.6-7.3,1.5l-3.2,1.1l-1.8-3
              c4.2-3,8.6-4.6,12.7-4.6c3.7,0,7.1,1.1,9.4,3.5c1.8,1.9,2.8,4.3,2.8,8.2l0,15.1l4.5,0.8l0,2.9c-1.3,0.6-3.1,1-4.7,1
              c-2.2,0-3.9-1.1-4.8-2.8l-2.1,1.1c-2.3,1.2-5.3,2.2-8,2.2c-3.5,0-6.3-1.1-8.4-3.1c-1.9-1.8-3.1-4.4-3.1-7.2c0-5.4,3.9-8.4,10.6-8.4
              h0.5c2.5,0,7,0.4,10,0.8L55.9,97.8z M55.9,104.5c0-0.4-0.1-0.6-0.8-0.6l-10.8,0c-1.5,0-2.4,0.3-3,0.9c-0.6,0.6-0.9,1.6-0.9,2.9
              c0,3.2,2.4,5.7,6.7,5.7c2.7,0,6-0.9,8.2-2.1c0.4-0.3,0.6-0.4,0.6-1L55.9,104.5z"/>
            <path fill="#1A1A1A" d="M90.7,114.7c-2.7,1.9-6.7,3.4-9.8,3.4c-2.8,0-5-0.9-6.5-2.3c-1.6-1.6-2.5-3.8-2.5-7l0-17.7L66,91l0-3.2
              l5.8-1.1l0-9l5.6,0l0,8.9l11,0l0,4.3l-11,0l0,17.6c0,1.7,0.4,2.9,1.1,3.6c0.8,0.8,1.8,1.1,3.3,1.1c1.3,0,3-0.4,5.3-1l2.2-0.6
              L90.7,114.7z"/>
            <path fill="#1A1A1A" d="M114,97.8c0-2.4-0.4-3.7-1.3-4.7c-1.2-1.3-3.2-1.9-5.8-1.9c-2.3,0-4.8,0.6-7.3,1.5l-3.2,1.1l-1.8-3
              c4.2-3,8.6-4.6,12.7-4.6c3.7,0,7.1,1.1,9.4,3.5c1.8,1.9,2.8,4.3,2.8,8.2l0,15.1l4.5,0.8l0,2.9c-1.3,0.6-3.1,1-4.7,1
              c-2.2,0-3.9-1.1-4.8-2.8l-2.1,1.1c-2.3,1.2-5.3,2.2-8,2.2c-3.5,0-6.3-1.1-8.4-3.1c-1.9-1.8-3.1-4.4-3.1-7.2c0-5.4,3.9-8.4,10.6-8.4
              h0.5c2.5,0,7,0.4,10,0.8L114,97.8z M114,104.5c0-0.4-0.1-0.6-0.8-0.6l-10.8,0c-1.5,0-2.4,0.3-3,0.9c-0.6,0.6-0.9,1.6-0.9,2.9
              c0,3.2,2.4,5.7,6.7,5.7c2.7,0,6-0.9,8.2-2.1c0.4-0.3,0.6-0.4,0.6-1L114,104.5z"/>
            <path fill="#1E8B9E" d="M134.2,86.7l1,2.7l2-1c2.5-1.3,5.4-2.2,7.9-2.2c3.4,0,6.7,1.1,9.1,3.7l2.2-1.1c3.5-1.8,6.2-2.6,9.3-2.6
              c3.5,0,6.6,1.2,8.7,3.2c2,1.9,3,4.5,3.1,8.7l0,19.5l-5.6,0l0-19.3c0-2.8-0.5-4.2-1.6-5.3c-1.2-1.1-3.2-1.6-5.6-1.6
              c-2.7,0-5.6,0.6-7.7,1.7c-0.7,0.4-0.8,0.4-0.6,1c0.2,1.1,0.4,2.5,0.4,4l0,19.6l-5.6,0l0-19.3c0-2.9-0.5-4.2-1.6-5.3
              c-1.2-1.1-3.2-1.6-5.6-1.6c-2.7,0-5.5,0.7-7.6,1.7c-0.5,0.3-0.6,0.5-0.6,1l0,23.4l-5.6,0l0-30.9L134.2,86.7z"/>
            <path fill="#1E8B9E" d="M185.6,74.8l4.7,0c0.9,0,1.1,0.3,1.1,1v4.9h-5.8L185.6,74.8z M185.7,86.6l5.6,0l0,30.9l-5.6,0L185.7,86.6z"
              />
            <path fill="#1E8B9E" d="M204.7,86.6l1,2.7l2-1c2.4-1.2,5.4-2.2,8.1-2.2c3.7,0,6.9,1.2,9,3.2c2,1.9,3,4.5,3.1,8.7l0,19.5l-5.6,0
              l0-19.3c0-2.9-0.5-4.2-1.6-5.3c-1.2-1.2-3.4-1.6-5.8-1.6h-0.1c-2.7,0-6,0.8-7.9,1.7c-0.5,0.3-0.6,0.5-0.6,1l0,23.4l-5.6,0l0-30.9
              L204.7,86.6z"/>
            <path fill="#1E8B9E" d="M256,114.6c-2.7,1.9-6.7,3.4-9.8,3.4c-2.8,0-5-0.9-6.5-2.3c-1.6-1.6-2.5-3.8-2.5-7l0-17.7l-5.8,0v-3.2
              l5.8-1.1l0-9l5.6,0l0,8.9l11,0l0,4.3l-11,0l0,17.6c0,1.7,0.4,2.9,1.1,3.6c0.8,0.8,1.8,1.1,3.3,1.1c1.3,0,3-0.4,5.3-1l2.2-0.6
              L256,114.6z"/>
            <path fill="#1E8B9E" d="M281.1,91.6l-2.9-0.4c-2-0.2-4.8-0.5-6.7-0.5c-4.4,0-7.2,0.9-7.2,3.5c0,2.2,2.1,2.9,5.4,3.9l4.4,1.3
              c3.3,1,5.5,2,7,3.2c1.6,1.4,2.3,3.3,2.3,5.8c0,6-4.9,9.5-11.7,9.5c-4.2,0-9.3-1.4-13.1-3.5l1.4-3.2l2.7,0.7c4.3,1.1,6.9,1.4,9,1.4
              c4.3,0,6.5-1.7,6.5-4.8c0-2.2-1.3-3-5.2-4.2l-4.6-1.4c-6.4-2-9.3-4.1-9.3-8.5c0-2.7,1.3-4.8,3.4-6.1c2.3-1.5,5.6-2.2,8.9-2.2
              c3.5,0,7.3,0.8,10.6,2.1L281.1,91.6z"/>
            <path fill="#1E8B9E" d="M141.3,11.2c-16.4,10.7-16.9,29.9-20.5,38.6c-0.4,1-1.7,1.9-2.6,2.1c-4.1,0.8-6.2,2.7-7.3,4.2l1.5,1
              c1-1.5,3.4-3.4,8.8-4c4.3-0.5,23.4-2.1,33.3-14.4C165.9,24.5,165.9,6.2,172.6,0C172.6,0,154.2,2.7,141.3,11.2z M151.6,15
              c-3.6,3.2-6.7,6.8-9.4,10.7c-2.8,3.9-5.1,8.1-7.6,12.4c-1.2,2.1-2.5,4.3-4,6.3c-1.5,2-3.4,4-5.8,4.8c2-1.5,3.2-3.6,4.3-5.8
              c1.1-2.2,2-4.4,3-6.7c1.9-4.5,4.2-9.1,7.1-13.2c0.7-1,1.5-2,2.3-3c0.8-0.9,1.6-1.9,2.5-2.9c1.8-1.8,3.7-3.5,5.8-5
              c4.1-2.9,8.7-5.2,13.6-6.4C159.1,8.9,155.2,11.8,151.6,15z"/>
            </svg>
        </b-navbar-brand>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler"
               :class="{'active': !$sidebar.isMinimized }"
               @click="minimizeSidebar">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <slot></slot>
      <div class="navbar-inner">
        <b-navbar-nav>
          <slot name="links">
            <sidebar-item
              v-for="(link, index) in sidebarLinks"
              :key="link.name + index"
              :link="link"
            >
              <sidebar-item
                v-for="(subLink, index) in link.children"
                :key="subLink.name + index"
                :link="subLink"
              >
              </sidebar-item>
            </sidebar-item>
          </slot>
        </b-navbar-nav>
        <slot name="links-after"></slot>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "sidebar",
  props: {
    title: {
      type: String,
      default: "Creative Tim",
      description: "Sidebar title",
    },
    shortTitle: {
      type: String,
      default: "CT",
      description: "Sidebar short title",
    },
    backgroundColor: {
      type: String,
      default: "vue",
      validator: (value) => {
        let acceptedValues = [
          "",
          "vue",
          "blue",
          "green",
          "orange",
          "red",
          "primary",
        ];
        return acceptedValues.indexOf(value) !== -1;
      },
      description:
        "Sidebar background color (vue|blue|green|orange|red|primary)",
    },
    sidebarLinks: {
      type: Array,
      default: () => [],
      description:
        "List of sidebar links as an array if you don't want to use components for these.",
    },
    autoClose: {
      type: Boolean,
      default: true,
      description:
        "Whether sidebar should autoclose on mobile when clicking an item",
    },
  },
  provide() {
    return {
      autoClose: this.autoClose,
    };
  },
  methods: {
    minimizeSidebar() {
      if (this.$sidebar) {
        this.$sidebar.toggleMinimize();
      }
    },
  },
  mounted() {
    this.$sidebar.isMinimized = this.$sidebar.breakpoint < window.innerWidth;
    this.minimizeSidebar();
  },
  beforeDestroy() {
    if (this.$sidebar.showSidebar) {
      this.$sidebar.showSidebar = false;
    }
  },
};
</script>

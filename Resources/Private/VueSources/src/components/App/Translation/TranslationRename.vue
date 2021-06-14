<template>
  <span>
    <!-- Rename-Function -->
    <a
        :id="renameId"
        v-b-tooltip.hover
        class="cursor-selection"
        href="#"
        title="Rename"
        @click="toggleRename"
    >
      {{ translation.translationKey }}
    </a> <edit-icon class="hover-show" height="14px" width="14px"></edit-icon>
    <span v-if="translation.new" class="badge badge-success badge-pill"
    >new</span
    >
    <b-popover :target="renameId" triggers="focus">
      <template #title>
        <b-icon icon="pencil-square" variant="primary"></b-icon> Rename
      </template>
      <b-overlay :show="showOverlay" rounded="sm">
        <b-form-group label="Enter new key name">
          <b-form-input
              v-model="newRenameKey"
              :state="state"
              autofocus
              spellcheck="false"
              type="search"
          ></b-form-input>
        </b-form-group>

        <b-alert class="small" show>
          <strong>Renaming</strong><br/>
          From <strong>{{ translation.translationKey }}</strong
        ><br/>
          To <strong>{{ newRenameKey }}</strong>
        </b-alert>
        <hr/>
        <span class="float-right mb-2">
          <b-button
              :disabled="!state"
              size="sm"
              variant="success"
              @click="onRename"
          >
            Ok
            <b-icon class="ml-2" icon="check-circle" variant="white"></b-icon>
          </b-button>
        </span>
      </b-overlay>
    </b-popover>
  </span>
</template>

<script>
export default {
    name: "TranslationRename",
    props: ["translation"],
    computed: {
        renameId() {
            return "rename-" + this.translation.uid;
        },
        state() {
            // Only allow a-Z & 0-9 & Underscore, Dot and Dash
            return this.newRenameKey.match(/[^A-Za-z0-9_.-]+/) === null;
        },
    },
    data() {
        return {
            isRenaming: false,
            newRenameKey: "",
            showOverlay: false,
        };
    },
    methods: {
        onRename() {
            this.showOverlay = true;
            this.$store
                .dispatch("updateTranslation", {
                    uid: this.translation.uid,
                    data: JSON.stringify({
                        translationKey: this.newRenameKey,
                    }),
                })
                .then(() => {
                    this.showOverlay = false;
                });
        },
        toggleRename(e) {
            this.newRenameKey = this.translation.translationKey;
            e.preventDefault();
            e.stopPropagation();
            return false;
        },
    },
};
</script>
<style lang="scss" scoped>
// Display icon on mouse over
a:hover + .hover-show {
    opacity: 1;
}

.hover-show {
    opacity: 0;
    transition: 0.4s opacity;
}
</style>

<template>
  <div>
    <small class="font-weight-light text-success-dark">Comment <b-icon class="icon-toggle-display" icon="pencil-square"></b-icon></small>
    <b-input-group size="sm" class="mb-2">
      <b-input-group-prepend is-text class="append-bg-success-dark" v-b-tooltip.hover title="Enter a comment to make it easier for you to find your way around later.">
        <f-comment-icon class="text-success" width="20px" height="20px"></f-comment-icon>
      </b-input-group-prepend>
      <b-form-textarea
        class="invisible-textarea"
        :value="comment"
        placeholder="<!-- Enter comment -->"
        spellcheck="false"
        rows="3"
        v-on:update="onChange"
      >
      </b-form-textarea>
    </b-input-group>
  </div>
</template>

<script>
export default {
  name: "TranslationComment",
  props: ["translationValueUid", "comment", "startSaving"],
  data() {
    return {
      tempComment: this.comment, // morphing to tempComment because its not recommended to modify a prop
    };
  },
  computed: {},

  methods: {
    onChange: function (val) {
      this.$emit("comment", val);
      this.startSaving();
    },
  },
};
</script>
<style lang="scss" scoped>
.invisible-textarea {
  border: 2px dotted #82b98f;
  border-left: 0;
  border-radius: 5px;
  color: #82b98f;
  overflow: hidden;
  &::placeholder {
    color: #82b98f;
  }
  &:focus {
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075),
      0 0 0 0.2rem rgba(31, 162, 42, 0.25);
  }
  &:hover {
    color: black;
    border-color: #3f724b;
  }
}
// Dirty little hack because idk how to add class to sub-element
.append-bg-success-dark {
  & > .input-group-text {
    background: #3f724b;
  }
}
</style>
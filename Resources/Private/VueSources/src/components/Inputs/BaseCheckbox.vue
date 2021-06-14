<template>
    <div :class="[
       {disabled: disabled},
       {[`custom-checkbox-${type}`]: type},inlineClass]"
         class="custom-control custom-checkbox">
        <input :id="cbId"
               v-model="model"
               :class="inputClasses"
               :disabled="disabled"
               class="custom-control-input"
               type="checkbox"/>
        <label :for="cbId" class="custom-control-label">
            <slot>
                <span v-if="inline">&nbsp;</span>
            </slot>
        </label>
    </div>
</template>
<script>
export default {
    name: "base-checkbox",
    model: {
        prop: "checked"
    },
    props: {
        checked: {
            type: [Array, Boolean],
            description: "Whether checkbox is checked"
        },
        disabled: {
            type: Boolean,
            description: "Whether checkbox is disabled"
        },
        inline: {
            type: Boolean,
            description: "Whether checkbox is inline"
        },
        inputClasses: {
            type: [String, Object, Array],
            description: "Checkbox input classes"
        },
        type: {
            type: String,
            description: 'Checkbox type (e.g info, danger etc)'
        }
    },
    data() {
        return {
            cbId: "",
            touched: false
        };
    },
    computed: {
        model: {
            get() {
                return this.checked;
            },
            set(check) {
                if (!this.touched) {
                    this.touched = true;
                }
                this.$emit("input", check);
            }
        },
        inlineClass() {
            if (this.inline) {
                return `form-check-inline`;
            }
            return '';
        }
    },
    created() {
        this.cbId = Math.random()
            .toString(16)
            .slice(2);
    }
};
</script>

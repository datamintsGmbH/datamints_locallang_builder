<template>
    <div>
        <b-list-group>
            <b-list-group-item class="list-group-hover position-relative">
                <div v-show="savingTime" class="position-absolute save-overlay text-center w-100 bg-success">
                    <!-- Remaining Time -->
                    Auto-Saving in
                    <strong>{{ remainingSaveTime }} seconds</strong>
                </div>
                <b-row>
                    <b-col md>
                        <b-row>
                            <b-col>
                                <!-- Country Flag -->
                                <span
                                    v-b-tooltip.hover
                                    class="hover-scale-svg py-3"
                                    title="Language Code"
                                >
                                  <img
                                      :src="languageCodeInlineStyle"
                                      class="flag-svg"
                                  />
                                  <span class="text-uppercase p-2 font-weight-bold">{{
                                          translationValue.ident
                                      }}</span>
                                    <!-- Will save asterix -->
                                  <b-badge
                                      v-if="changed"
                                      v-b-tooltip.hover
                                      class="p-2 ml-2"
                                      pill
                                      title="Changes will be saved"
                                      variant="primary"
                                  >
                                        <b-icon icon="asterisk"></b-icon>
                                    </b-badge>
                                </span>
                                <!-- Last saved on -->
                                <small>
                                    <small class="text-muted"
                                    >Last save:
                                        <span :class="tstampColor">{{
                                                translationValue.tstamp
                                            }}</span>
                                    </small>
                                </small>
                            </b-col>
                        </b-row>
                        <b-row class="pb-2">
                            <b-col>

                            </b-col>
                        </b-row>
                        <b-row>
                            <b-col lg="6" sm="12">
                                <!-- XML-Space -->
                                <b-form-group content-cols-lg="12" content-cols-sm label-class="py-0" label-cols="12"
                                >
                                    <template #label>
                                        <small>
                                            XML-Space
                                        </small>

                                    </template>
                                    <p>
                                        <b-form-select v-model="translationValue.xmlSpace" :options="xmlSpaceOptions" size="sm" @input="startSaving"></b-form-select>
                                    </p>
                                </b-form-group>


                            </b-col>
                            <!-- Is approved -->
                            <b-col lg="6" sm="12">
                                <b-form-group content-cols-lg="12" content-cols-sm label-class="py-0" label-cols="12">
                                    <template #label>
                                        <small>
                                            Is approved
                                        </small>

                                    </template>
                                    <p>
                                        <base-switch v-model="translationValue.approved" size="sm" @input="startSaving"/>
                                    </p>
                                </b-form-group>
                            </b-col>

                        </b-row>
                    </b-col>
                    <!-- Source -->
                    <b-col v-if="!isDefault" md>
                        <small class="font-weight-light">Source</small>
                        <b-input-group class="mb-2" size="sm">
                            <b-input-group-prepend v-b-tooltip.hover is-text title="To edit, please use the default value (en)">
                                <b-icon icon="clipboard"></b-icon>
                            </b-input-group-prepend>
                            <b-form-textarea
                                id="textarea-default"
                                :value="defaultValue.value"
                                disabled
                                max-rows="10"
                                placeholder="Enter something..."
                                rows="3"
                                spellcheck="false"
                            >
                            </b-form-textarea>
                        </b-input-group>
                    </b-col>
                    <!-- Display comment-section for default-translation-value -->
                    <b-col v-else class="show-icon-hover" md>
                        <TranslationComment :comment="translationValue.comment" :startSaving="startSaving" :translationValueUid="translationValue.uid" @comment="updateComment"/>
                    </b-col>

                    <!-- Translation-Actions -->
                    <b-col v-if="!isDefault && isAllowedProvider" align-self="center" class="d-none d-md-block" md="1">
                        <b-button
                            v-if="!isAutoTranslating"
                            v-b-tooltip.hover
                            :title="getProviderLabel"
                            class="text-nowrap"
                            size="sm"
                            variant="primary"
                            @click="apiAutoTranslate"
                        >
                            <b-icon icon="cloud-fill"></b-icon>
                            <b-icon class="ml-2" icon="chevron-double-right"></b-icon>
                        </b-button>
                        <b-spinner
                            v-if="isAutoTranslating"
                            label="Getting data..."
                            variant="primary"
                        ></b-spinner>
                    </b-col>
                    <b-col v-else md="1">

                    </b-col>
                    <b-col class="show-icon-hover" md="4">
                        <small class="font-weight-light">Translation
                            <b-icon class="icon-toggle-display" icon="pencil-square"/>
                        </small>
                        <b-input-group class="mb-2" size="sm">
                            <b-input-group-prepend is-text>
                                <translation-symbols-icon height="20px" width="20px"></translation-symbols-icon>
                            </b-input-group-prepend>
                            <b-form-textarea
                                id="textarea"
                                :disabled="isAutoTranslating"
                                :value="ownValue"
                                max-rows="10"
                                placeholder="Enter something..."
                                rows="3"
                                spellcheck="false"
                                v-on:update="onChange"
                            >
                            </b-form-textarea>
                        </b-input-group>
                    </b-col>
                </b-row>
                <b-dropdown
                    v-if="!isDefault"
                    v-b-tooltip.hover
                    class="m-2 position-absolute"
                    dropleft
                    no-caret
                    size="sm"
                    style="top: -0.5rem; right: -0.5rem"
                    title="Further options"
                    variant="link"
                >
                    <template #button-content>
                        <b-icon icon="three-dots-vertical"></b-icon>
                    </template>


                    <b-dropdown-item href="#" @click="apiAutoTranslate">{{ getProviderLabel }}</b-dropdown-item>
                    <b-dropdown-divider></b-dropdown-divider>
                    <TranslationValueDelete :rerender="rerender" :translationValue="translationValue"/>
                </b-dropdown>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
import TranslationComment from "./TranslationComment";
import TranslationValueDelete from "./TranslationValueDelete";
import * as utility from "../../../scripts/Utility";

export default {
    name: "TranslationValue",
    props: ["translationValue", "defaultValue", "rerender"],
    data() {
        return {
            changed: false,
            atLeastOnceSaved: false,
            isAutoTranslating: false,
            savingInSec: 5,
            savingTime: 0,
            languageCodeInlineStyle: utility.getLanguageSvg(
                this.translationValue.ident
            ),
            xmlSpaceOptions: [
                {value: "", text: "None"},
                {value: "preserve", text: "Preserve"},
            ],
        };
    },
    computed: {
        remainingSaveTime: function () {
            return this.savingInSec - this.savingTime;
        },
        ownValue: function () {
            return this.translationValue.value;
        },
        isDefault: function () {
            return this.translationValue.ident == "en";
        },
        isAllowedProvider: function () {
            return this.$store.getters.config.provider.length > 0;
        },
        getProviderLabel: function () {
            return "Autotranslate with " + this.$store.getters.config.provider;
        },
        tstampColor: function () {
            return this.atLeastOnceSaved ? "text-success" : "";
        },
        listGroupItemVariant() {
            return this.translationValue.new === true ? "success" : "";
        }
    },
    watch: {
        changed(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.clearLoadingTimeInterval();
                this.savingTime = 0;

                if (newValue) {
                    this.$_loadingTimeInterval = setInterval(() => {
                        this.savingTime++;
                    }, 1000);
                } else {
                    this.apiSave();
                }
            }
        },
        savingTime(newValue, oldValue) {
            if (newValue !== oldValue) {
                if (newValue === this.savingInSec) {
                    this.changed = false;
                }
            }
        },
    },
    methods: {
        updateComment: function (val) {
            this.translationValue.comment = val;
        },
        onChange: function (val) {
            this.translationValue.value = val; // todo fix this. Dont modify props!
            this.startSaving();
        },
        startSaving() {
            this.changed = true;
            this.savingTime = 0;
        },
        clearLoadingTimeInterval() {
            clearInterval(this.$_loadingTimeInterval);
            this.$_loadingTimeInterval = null;
        },
        apiAutoTranslate() {
            this.isAutoTranslating = true;
            this.$store
                .dispatch("autoTranslate", {
                    uid: this.translationValue.uid,
                    textToTranslate: this.defaultValue.value,
                })
                .then(() => {
                    this.isAutoTranslating = false;
                    this.$nextTick().then(() => {
                        this.$forceUpdate();
                        this.rerender();
                    });
                    this.rerender();
                });
        },
        apiSave: function () {
            this.isAutoTranslating = true;
            this.$store
                .dispatch("updateTranslationValue", {
                    uid: this.translationValue.uid,
                    data: JSON.stringify({
                        value: this.translationValue.value,
                        ident: this.translationValue.ident,
                        approved: this.translationValue.approved,
                        xmlSpace: this.translationValue.xmlSpace,
                        comment: this.translationValue.comment,
                    }),
                })
                .then(() => {
                    this.atLeastOnceSaved = true;
                    this.isAutoTranslating = false;
                    this.$nextTick().then(() => {
                        this.$forceUpdate();
                        this.rerender();
                    });
                    this.rerender();
                });
        },
    },
    created() {
        this.$_loadingTimeInterval = null;
    },
    components: {
        TranslationComment,
        TranslationValueDelete,
    },
};
</script>
<style lang="scss">
.flag-svg {
    background-size: cover;
    width: 1.5rem;
    height: 1.5rem;
}

.hover-scale-svg img {
    transition: 0.15s;
}

.hover-scale-svg:hover img {
    transform: scale(1.75) !important;
}

.list-group-hover:hover {
    background: #f8f9fa;

    .flag-svg {
        transform: scale(1.25);
    }
}

.show-icon-hover {
    &:hover {
        .icon-toggle-display {
            opacity: 1;
        }
    }

    .icon-toggle-display {
        transition: opacity 0.35s;
        opacity: 0;
    }
}

.save-overlay {
    left: 0;
    top: -8px;
}

textarea:disabled {
    cursor: not-allowed;
}
</style>
<style scoped>
.form-group {
    margin-bottom: 0;
}
</style>

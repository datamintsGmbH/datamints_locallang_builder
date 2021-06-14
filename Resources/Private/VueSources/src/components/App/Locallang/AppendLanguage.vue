<template>
    <base-button
        v-b-tooltip.hover
        size="sm"
        title="Append a new language to all existing keys"
        type="danger"
        @click="showModal"
    >
        <b-icon aria-hidden="true" icon="plus"></b-icon>
        New language
        <b-modal :id="modalId" v-model="modalActive" :hide-footer="true" cancel-variant="light" lazy size="xl" title="Append a new language to all existing keys" @ok="handleOk">
            <b-card body-class="p-0" header-class="border-0">
                <template v-slot:header>
                    <h3 class="mb-0">Configuration</h3>
                </template>
                <b-overlay :show="showOverlay" rounded="sm">
                    <b-card>
                        <b-form ref="formappend" :validated="formIsValid" novalidate @submit.stop.prevent="handleSubmit">
                            <b-input-group class="pb-4" prepend="Language-Codes">

                                <b-form-tags
                                    v-model="newObjectLanguages"
                                    :state="tagsAreValid"
                                    :tag-validator="tagValidator"
                                    input-id="tags-separators"
                                    invalidTagText="The entered language code was not found"
                                    placeholder="Separate by space, comma or semicolon"
                                    remove-on-delete
                                    separator=" ,;"
                                    tag-variant="primary"
                                    @tag-state="onTagState"
                                >
                                </b-form-tags>
                            </b-input-group>
                            <hr/>
                            <b-card>
                                <template #header>
                                    <settings-gear-icon class="pr-2" height="23px" width="23px"></settings-gear-icon>
                                    Options
                                </template>
                                <b-row>
                                    <b-col cols="6">
                                        <b-form-group label="Auto-Translate">
                                            <base-switch v-model="newObjectAutoTranslate" name="autotranslate"/>
                                        </b-form-group>
                                    </b-col>
                                    <b-col cols="6">
                                        <b-form-group label="XML-Space">
                                            <b-form-select v-model="newObjectXmlSpace" :options="xmlSpaceOptions" size="sm"></b-form-select>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                            </b-card>
                            <b-row>
                                <b-col>
                                    <div class="d-flex justify-content-end">
                                        <b-button class="pull-right" type="submit" variant="success">Submit</b-button>
                                    </div>
                                </b-col>
                            </b-row>
                        </b-form>
                    </b-card>
                </b-overlay>

                <b-alert show variant="warning">
                    As soon as the translation-process with selected auto-translation has started, the entries are updated one after the other. <br> This process can take a few seconds for large files. <br>The progress can be seen in the table below
                </b-alert>
                <b-alert show variant="danger">
                    If individual entries of a language already exist, they will be overwritten!
                </b-alert>

                <table aria-colcount="3" class="table b-table" role="table">
                    <thead class="thead-light" role="rowgroup">
                    <tr class="" role="row">
                        <th aria-colindex="1" class="" role="columnheader" scope="col">
                            <div>Key</div>
                        </th>
                        <th aria-colindex="2" class="" role="columnheader" scope="col">
                            <div>Status</div>
                        </th>
                        <th aria-colindex="3" class="" role="columnheader" scope="col">
                            <div>Progress</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody role="rowgroup">
                    <append-language-key v-for="(translation, index) in constructCache" :key="index" :ref="'name_' + index" :translationDTO="translation"></append-language-key>


                    </tbody>
                </table>
            </b-card>
        </b-modal>
    </base-button>

</template>
<script>
import AppendLanguageKey from "./AppendLanguageKey";

export default {
    name: "append-language",
    components: {
        AppendLanguageKey
    },
    props: {
        locallang: {
            type: Object,
        },
        itemLimit: {
            type: Number,
            default: 9,
        },
    },
    data() {
        return {
            modalActive: false,
            modalId: "modal-append-" + this.locallang.uid,
            currentPage: 1,
            newObjectLanguages: [],
            newObjectAutoTranslate: true,
            newObjectXmlSpace: "",
            constructCache: [],
            queueTimer: null,
            formIsValid: false,
            showOverlay: false,
            showFormValidation: false,
            xmlSpaceOptions: [
                {value: "", text: "None"},
                {value: "preserve", text: "Preserve"},
            ],
        };
    },
    computed: {
        languages() {
            return this.$store.getters.languages;
        },
        languageState() {
            return (
                this.languages.filter(
                    (language) => language.key === this.newObjectLanguage
                ).length > 0
            );
        },
        /**
         * For form-validation display
         */
        tagsAreValid() {
            if (!this.showFormValidation) return null;
            return this.newObjectLanguages.length > 0
        },
    },
    methods: {
        showModal() {
            this.constructCache = this.constructTableObject();
            this.modalActive = true;

        },
        onTagState(valid, invalid, duplicate) {
            this.validTags = valid;
            this.invalidTags = invalid;
            this.duplicateTags = duplicate;
        },
        constructTableObject() {
            var tableObject = [];

            for (let translationEntryKey in this.locallang.translationsArray) {
                let defaultValue = this.getDefaultValue(this.locallang.translationsArray[translationEntryKey].object)
                tableObject.push({
                    "key": this.locallang.translationsArray[translationEntryKey].object.translationKey,
                    "translationUid": this.locallang.translationsArray[translationEntryKey].object.uid,
                    "status": "pending",
                    "statusType": "danger",
                    "completion": 0,
                    "defaultValue": defaultValue.value,
                    "triggered": false,
                    "doneCallback": () => {
                        this.triggerNextCall();
                    }
                });

            }
            return tableObject;
        },
        getDefaultValue: function (translation) {
            for (let translationValueKey in translation.translationValues) {
                if (translation.translationValues[translationValueKey].ident == "en") {
                    return translation.translationValues[translationValueKey];
                }
            }
            return null;
        },
        tagValidator(tag) {
            return (
                this.languages.filter((language) => language.key === tag).length > 0
            );
        },
        handleOk(bvModalEvt) {
            // Prevent modal from closing
            bvModalEvt.preventDefault();
            // Trigger submit handler
            this.handleSubmit();
        },
        checkFormValidity() {
            const valid = (this.$refs.formappend.checkValidity() && this.newObjectLanguages.length > 0);
            this.showFormValidation = true;
            this.formIsValid = valid;
            return valid;
        },
        /**
         * Gets called from child to trigger continious call-progression directly after response
         */
        triggerNextCall() {
            for (let queueKey in this.constructCache) {
                if (this.constructCache[queueKey].status == 'pending') {
                    this.$refs['name_' + queueKey][0].onCall(this.newObjectLanguages, this.newObjectXmlSpace, this.newObjectAutoTranslate);
                    return;
                }
            }
            // Closing window on complete
            this.showOverlay = false;
            this.modalActive = false;
        },
        handleSubmit() {
            // Exit when the form isn't valid
            if (!this.checkFormValidity()) {
                return;
            }
            this.showOverlay = true;
            this.triggerNextCall();

            this.$nextTick(() => {
                this.showOverlay = true;
            });

        },
    },
};
</script>

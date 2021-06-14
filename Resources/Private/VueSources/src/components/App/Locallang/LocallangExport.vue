<template>
    <base-button v-b-tooltip.hover size="sm" title="Export (opens modal view)" type="success" @click="showModal">
        <floppy-disk-icon height="15px" width="15px"></floppy-disk-icon>
        Export
        <!-- Modal -->
        <b-modal :id="modalId" v-model="modalActive" :hide-footer="showOverlay" cancel-variant="light" lazy size="lg" title="Export" @ok="handleOk">
            <b-overlay :show="showOverlay" rounded="sm">
                <b-row>
                    <b-col>
                        <p>Hover over the key to get further option information</p>
                        <hr/>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col>
                        <b-card header="Configuration">
                            <form ref="form">
                                <!-- Filetype -->
                                <b-form-group content-cols-lg="7" content-cols-sm label-class="pt-0" label-cols-lg="4" label-cols-sm="4">
                                    <template #label>
                                        <b-link v-b-tooltip.hover class="text-dark" href="#disabled" title="Choose your preferred output format">Filetype</b-link>
                                    </template>
                                    <b-form-radio-group
                                        id="filetype"
                                        v-model="selectedFiletype"
                                        :options="filetypeOptions"
                                        name="export-radio-filetype">
                                    </b-form-radio-group>
                                </b-form-group>
                                <!-- Target -->
                                <b-form-group content-cols-lg="7" content-cols-sm label-class="pt-0" label-cols-lg="4" label-cols-sm="4">
                                    <template #label>
                                        <b-link v-b-tooltip.hover class="text-dark" href="#disabled"
                                                title="Select the output target. Its the easiest way to overwrite the current locallang-file, but it's also possible to export to fileadmin/locallang-builder/">
                                            Target
                                        </b-link>
                                    </template>
                                    <b-form-radio-group
                                        id="target"
                                        v-model="selectedTarget"
                                        :options="targetOptions"
                                        name="export-radio-target">
                                    </b-form-radio-group>
                                </b-form-group>
                                <!-- Create Backup -->
                                <b-form-group v-if="overwriteChosen" content-cols-lg="7" content-cols-sm label-class="pt-0"
                                              label-cols-lg="4" label-cols-sm="4">
                                    <template #label>
                                        <b-link v-b-tooltip.hover class="text-dark" href="#disabled"
                                                title="Creates backup of the old file, when selected. The file gets copied to /fileadmin/locallang-builder/">
                                            Create backup
                                        </b-link>
                                    </template>
                                    <p>
                                        <base-switch v-model="triggerBackup"/>
                                    </p>
                                </b-form-group>

                            </form>
                        </b-card>
                    </b-col>
                    <b-col>
                        <b-alert :show="overwriteChosen" variant="warning">
                            The file-content will be overwritten with the values from
                            "locallang-builder". Its not recommended to edit the file manually
                            after this process. If you have to edit something manually, please
                            reimport the file from the actions-menu to reset everything and fetch the latest
                            file-content.
                        </b-alert>
                        <b-alert :show="backupChosen" variant="success">
                            Your previous locallang-files will be copied to the backup-folder,
                            so you can restore the backup if something bad happens.
                        </b-alert>
                    </b-col>
                </b-row>
            </b-overlay>
        </b-modal>
    </base-button>
</template>
<script>
export default {
    name: "LocallangExport",
    props: ["locallang"],
    data() {
        return {
            modalId: "modal-" + this.locallang.uid,
            modalActive: false,
            showOverlay: false,
            filetypeOptions: [
                {
                    text: "XML (.xlf)",
                    value: "xml-xlf",
                },
            ],
            selectedFiletype: "xml-xlf",
            targetOptions: [
                {
                    text: "Overwrite",
                    value: "overwrite",
                },
                {
                    text: "Fileadmin",
                    value: "fileadmin",
                },
            ],
            selectedTarget: "overwrite",
            triggerBackup: true,
            triggerCache: true,
        };
    },
    computed: {
        overwriteChosen() {
            return this.selectedTarget == "overwrite";
        },
        backupChosen() {
            return this.triggerBackup === true && this.selectedTarget == "overwrite";
        },
    },
    methods: {
        showModal() {
            this.modalActive = true;
        },
        handleOk(bvModalEvt) {
            // Prevent modal from closing
            bvModalEvt.preventDefault();
            // Trigger submit handler
            this.handleSubmit();
        },
        handleSubmit() {
            this.$nextTick(() => {
                this.showOverlay = true;
            });
            this.$store
                .dispatch("exportLocallang", {
                    uid: this.locallang.uid,
                    data: JSON.stringify({
                        triggerBackup: this.triggerBackup,
                        selectedFiletype: this.selectedFiletype,
                        triggerCache: this.triggerCache,
                        selectedTarget: this.selectedTarget,
                    }),
                })
                .then(() => {
                    this.showOverlay = false;
                    this.modalActive = false;
                });
        },
    },
    components: {},
};
</script>
<style lang="scss" scoped>
</style>

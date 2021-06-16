<template>
    <b-card class="" footer-tag="footer" header-tag="header" no-body>
        <b-card-body v-if="locallang.translationsArray">
            <!-- Search-Function -->
            <b-row class="mb-2">
                <b-col>
                    <b-input-group class="mb-2" size="sm">
                        <b-input-group-prepend is-text>
                            <b-icon icon="search"></b-icon>
                        </b-input-group-prepend>
                        <b-form-input
                            v-model="searchValue"
                            placeholder="Search by key, value or comment"
                            type="search"
                        >
                        </b-form-input>
                    </b-input-group>
                </b-col>
                <b-col>
                    <b-form-group
                        class="mb-0"
                        label="Sort"
                        label-align-sm="right"
                        label-cols-sm="3"
                        label-for="sort-by-select"
                        label-size="sm"
                    >
                        <b-input-group size="sm">
                            <b-form-select
                                id="sort-by-select"
                                v-model="sortBy"
                                :options="sortOptions"
                                class="w-75"
                            >
                                <template #first>
                                    <option value="">-- none --</option>
                                </template>
                            </b-form-select>

                            <b-form-select
                                v-model="sortDesc"
                                :disabled="!sortBy"
                                class="w-25"
                                size="sm"
                            >
                                <option :value="false">ASC</option>
                                <option :value="true">DESC</option>
                            </b-form-select>
                        </b-input-group>
                    </b-form-group>
                </b-col>
            </b-row>
            <!-- Translation-Components with Table and Pagination -->
            <b-row>
                <b-col md>
                    <b-pagination
                        v-model="currentPage"
                        :limit="paginationLimit"
                        :per-page="perPage"
                        :total-rows="rows"
                        aria-controls="my-table"
                    ></b-pagination>
                </b-col>
                <b-col md>
                    <b-form-group
                        class="mb-0"
                        label="Per page"
                        label-align-sm="right"
                        label-cols-lg="3"
                        label-cols-md="4"
                        label-cols-sm="6"
                        label-for="per-page-select"
                        label-size="sm"
                    >
                        <b-form-select
                            id="per-page-select"
                            v-model="perPage"
                            :options="pageOptions"
                            size="sm"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-table
                v-if="!locallang.invalidFormat"
                :id="tableId"
                :current-page="currentPage"
                :fields="fieldNames"
                :filter="searchValue"
                :items="locallang.translationsArray"
                :per-page="perPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                head-variant="unset"
                primary-key="uid"
                small
            >
                <template #row-details="row">
                    <Translation :translation="row.item.object"/>
                </template>
                <template #cell(key)="data">
                    <span class="d-none">{{ data.item.key }}</span>
                </template>
            </b-table>
            <b-alert v-else show variant="danger">
                This file contains invalid content and is not supported. Please fix the issues and trigger an reimport-process.
            </b-alert>
            <b-row>
                <b-col>
                    <b-pagination
                        v-model="currentPage"
                        :limit="paginationLimit"
                        :per-page="perPage"
                        :total-rows="rows"
                        aria-controls="fake-table"
                    ></b-pagination>
                </b-col>
            </b-row>
        </b-card-body>
        <!-- Header -->
        <template #header>
            <div class="d-flex justify-content-between align-items-center">
        <span>
          <file-xml-icon height="18px" width="18px"/>
          <strong class="text-muted ml-2">File: </strong>
          <u>{{ locallang.filename }}</u>
        </span>
                <!-- Actions-Menu -->
                <LocallangActions
                    :isLoaded="loaded"
                    :languagesInUse="getLanguagesInUse"
                    :locallang="locallang"
                    :rerender="render"
                />
            </div>
        </template>
        <!-- Footer -->
        <template #footer>
            <b-skeleton-wrapper :loading="loading">
                <template #loading>
                    <b-card>
                        <b-skeleton-table
                            :columns="1"
                            :rows="20"
                            :table-props="{ striped: true }"
                        ></b-skeleton-table>
                    </b-card>
                </template>
            </b-skeleton-wrapper>


        </template>
    </b-card>
</template>

<script>
import Translation from "../Translation/Translation";
import LocallangActions from "./LocallangActions";

export default {
    name: "Locallang",
    props: ["locallang"],
    data() {
        return {
            paginationLimit: 10,
            showOverlay: false,
            loaded: false,
            loading: false,
            searchValue: "",
            perPage: 10,
            currentPage: 1,
            fieldNames: ["key", "tstamp", "crdate"],
            pageOptions: [5, 10, 20, 30],
            sortOptions: [{text: "Name", value: "key"}],
            sortBy: "",
            sortDesc: false,
            sortDirection: "asc",
        };
    },
    computed: {
        tableId() {
            return "table-locallang-" + this.locallang.uid;
        },
        rows() {
            return this.locallang.translationsArray.length;
        },
        translationsFiltered() {
            return this.locallang.translationsArray.filter((translation) => {
                return translation.key
                    .toLowerCase()
                    .includes(this.searchValue.toLowerCase());
            });
        },
    },
    methods: {
        render() {
            // method to re-render this component. Its required in the translationAdd-Component. For some reason its not updating otherwise
            this.$forceUpdate();
            this.$root.$emit("bv::refresh::table", this.tableId);
        },

        addLanguage() {
        },
        loadData() {
            this.showOverlay = true;
            this.loading = true;
            this.$store
                .dispatch("getLocallangByUid", {
                    uid: this.locallang.uid,
                })
                .then(() => {
                    this.showOverlay = false;
                    this.loaded = true;
                    this.loading = false;
                });

            return true;
        },
        getLanguagesInUse() {
            const list = [];
            for (let translationKey in this.locallang.translationsArray) {
                for (let translationValueKey in this.locallang.translationsArray[
                    translationKey
                    ].object.translationValues) {
                    const languageCode = this.locallang.translationsArray[translationKey]
                        .object.translationValues[translationValueKey].ident;
                    if (list.indexOf(languageCode) === -1 && languageCode != "en") {
                        list.push(languageCode);
                    }
                }
            }
            return list;
        },
    },
    mounted() {
        // When we didn't fetch the data yet, we'll load it from backend
        if (!this.loaded && !this.loading) {
            this.loadData();
        }
    },
    components: {
        Translation,
        LocallangActions,
    },
};
</script>
<style>
.thead-unset {
    display: none;
}
</style>

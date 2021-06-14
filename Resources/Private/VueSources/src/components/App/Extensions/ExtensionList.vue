<template>
    <side-bar>
        <template slot="links">
            <b-skeleton-wrapper :loading="loading">
                <template #loading>
                    <b-card>
                        <b-skeleton-table
                            :columns="1"
                            :rows="10"
                            :table-props="{ striped: true }"
                        ></b-skeleton-table>


                        <b-alert show variant="warning">
                            <h4 class="alert-heading">Please wait!</h4>
                            <p>
                                This process can take up to one minute depending on the amount of
                                extensions.
                            </p>
                            <hr/>
                            <p class="mb-0">
                                First time calculating can take some extra time to load everything
                                into the cache.
                            </p>
                        </b-alert>
                    </b-card>
                </template>
            </b-skeleton-wrapper>
            <!-- 1st Level -->
            <sidebar-item
                v-for="extension in extensions" v-bind:key="extension.uid"
                :link="{
            name: extension.name,
          }"
            >
                <!-- 2nd Level -->
                <sidebar-item
                    v-for="locallang in extension.locallangs"
                    v-bind:key="locallang.uid"
                    :link="{ name: locallang.filename, path: '#' }"
                    :locallang="locallang"
                    @locallang="onLocallangSelect"
                ></sidebar-item>

            </sidebar-item>

        </template>
        <template slot="links-after">
            <div v-if="!loading">
                <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted">Actions</h6>
                <b-nav class="navbar-nav mb-md-3">
                    <b-nav-item
                        href="#"
                        @click.prevent="onReloadClick"
                    >
                        <reload-icon class="mr-3" height="16px" width="16px"></reload-icon>
                        <b-nav-text class="p-0">Reimport</b-nav-text>
                    </b-nav-item>
                </b-nav>

                <hr class="my-3">
                <h6 class="navbar-heading p-0 text-muted">Documentation</h6>

                <b-nav class="navbar-nav mb-md-3">
                    <b-nav-item
                        :href="getDocumentationUrl" target="_blank"
                    >
                        <i class="ni ni-spaceship"></i>
                        <b-nav-text class="p-0">Getting started</b-nav-text>
                    </b-nav-item>
                </b-nav>

            </div>
        </template>
    </side-bar>
</template>

<script>
/* eslint-disable no-new */
import PerfectScrollbar from "perfect-scrollbar";
import "perfect-scrollbar/css/perfect-scrollbar.css";
import swal from 'sweetalert2'

function hasElement(className) {
    return document.getElementsByClassName(className).length > 0;
}

function initScrollbar(className) {
    if (hasElement(className)) {
        new PerfectScrollbar(`.${className}`);
    } else {
        // try to init it later in case this component is loaded async
        setTimeout(() => {
            initScrollbar(className);
        }, 100);
    }
}

export default {
    computed: {
        extensions() {
            return this.$store.getters.extensions;
        },
        getDocumentationUrl() {
            return this.$store.getters.config.documentationUrl;
        },
    },
    data() {
        return {
            loading: false,
        };
    },
    methods: {
        onLocallangSelect(locallang) {
            this.$emit("locallang", locallang);
        },
        onReloadClick() {
            this.showSwal('basic');

        },
        showSwal(type) {
            if (type === 'basic') {
                swal.fire({
                    title: `Reimport!`,
                    text: `Please make sure that all changes have been exported because you will lose them when you re-import them from the file system. This process can take up to a minute.`,
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-secondary',
                    showCancelButton: true
                }).then((result) => {
                    if (result.value) {
                        this.loading = true;
                        this.$emit("locallang", null); // reset current selected locallang-file
                        this.$store.dispatch("clearExtensions").then(() => { // clear the extensions storage to hide list while loading new ones
                            this.$store.dispatch("getExtensions").then(() => {
                                this.loading = false;
                                swal.fire(
                                    'Action completed!',
                                    'The files have been reimported and the list has been updated.',
                                    'success'
                                )
                            });

                        });

                    }

                });
            }
        },
        initScrollbar() {
            let isWindows = navigator.platform.startsWith("Win");
            if (isWindows) {
                initScrollbar("sidenav");
            }
        },
        loadExtensions() {
            this.$store.dispatch("getExtensions").then(() => {
                this.loading = false;
            });
        },
        clearLoadingTimeInterval() {
            clearInterval(this.$_loadingTimeInterval);
        }
        ,
        startLoading() {
            this.loading = true;
        }
        ,
    },
    created() {
        this.loadExtensions();
    },
    mounted() {
        this.initScrollbar();
        this.startLoading();
    },
};
</script>

<style>
</style>

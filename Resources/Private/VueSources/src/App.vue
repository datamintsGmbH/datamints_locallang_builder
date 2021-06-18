<template>
    <div id="app">
        <notifications></notifications>
        <!-- todo - rename this -->
        <extension-list @locallang="onLocallangSelect"></extension-list>

        <div class="main-content">
            <splash-screen/>

            <dashboard-content :locallang="selectedLocallang"></dashboard-content>

            <b-alert v-if="error" show variant="danger">
                <h4 class="alert-heading">Critical error</h4>
                <p>An critical error occured. Please reload this browser tab.</p>
            </b-alert>
        </div>
        <footer class="footer bg-gradient-primary p-2">
            <b-row>
                <b-col>
                    <small class="text-white float-right d-flex align-items-center">
                        <a v-b-tooltip.hover :href="getGitUrl" class="text-white" target="_blank" title="Open Github">
                            <logo-github-icon class="mr-4" height="16px" width="16px"></logo-github-icon>
                        </a>
                        © Mark Weisgerber - version {{ getExtensionVersion }}</small>
                </b-col>
            </b-row>
        </footer>

    </div>
</template>

<script>
import Vue from "vue";
import {BVToastPlugin} from "bootstrap-vue";

//import "./scss/App.scss";
import SplashScreen from "./components/App/SplashScreen.vue";
import ExtensionList from "./components/App/Extensions/ExtensionList.vue";
import DashboardContent from "./components/App/DashboardContent.vue";

//Vue.config.devtools = true;
Vue.use(BVToastPlugin);

export default {
    name: "App",
    components: {
        SplashScreen,
        DashboardContent,
        ExtensionList,
    },
    data() {
        return {
            error: false,
            selectedLocallangUid: null,
        };
    },
    methods: {
        onLocallangSelect(locallangUid) {
            this.selectedLocallangUid = locallangUid;
        },
    },
    computed: {
        selectedLocallang() {
            return this.$store.getters.locallang(this.selectedLocallangUid);
        },
        getGitUrl() {
            return this.$store.getters.config.gitUrl;
        },
        getExtensionVersion() {
            return this.$store.getters.config.version;
        },
    },
    mounted() {
        this.$store.watch(
            (state) => state.extension.toastMessages,
            (toastMessages) => {
                const toast = toastMessages.slice(-1)[0];
                console.log("%cNOTIFY " + toast.text, "color:orange");
                this.$notify({
                    verticalAlign: "top",
                    horizontalAlign: "right",
                    type: toast.variant,
                    message: toast.text,
                    timeout: 5000,
                });
            }
        );
        window.addEventListener("CRITICAL_ERROR", (e) => {
            console.error("CRITICAL ERROR");
            console.log(e);
            this.error = true;
        });
    },
};
</script>

<style lang="scss">
/* Otherwise theres no scrolling allowed in the iframe, because we're not using the be:container-viewhelper */
html,
body {
    height: 100%;
    overflow-y: scroll;
}

.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 999;
}

// Disable annoying text-selection on mouse move
.tooltip {
    pointer-events: none;
}
</style>

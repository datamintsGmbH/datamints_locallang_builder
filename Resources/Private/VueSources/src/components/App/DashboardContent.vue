<template>
    <div>
        <locallang v-if="locallang" :key="locallang.uid" :locallang="locallang"/>
        <div v-else>
            <b-container class="pb-6">
                <div class="d-flex justify-content-lg-center px-3 my-5 align-items-center">
                    <div>
                        <div class="icon icon-shape bg-gradient-white shadow rounded-circle text-primary">
                            <i class="ni ni-settings text-primary"></i>
                        </div>
                    </div>
                    <b-row>
                        <b-col>
                            <span>Please first select a locallang file in the sidebar in order to be able to edit the translations.</span>
                        </b-col>
                    </b-row>

                </div>
                <b-row>
                    <b-col>
                        <b-alert v-if="getProviderName" show variant="default">
                            <i class="ni ni-check-bold"></i> Selected Auto-Translate-Provider: {{ getProviderName }}
                        </b-alert>
                        <b-alert v-else show variant="danger">
                            No active configuration for the translation feature was found. Please define one in Typoscript so that this feature can be used.
                        </b-alert>
                    </b-col>
                </b-row>
                <!-- Card stats -->
                <b-row>
                    <b-col md="6" xl="3">
                        <stats-card icon="ni ni-active-40"
                                    sub-title="N/A"
                                    title="Total translations"
                                    type="gradient-red">
                        </stats-card>
                    </b-col>
                    <b-col md="6" xl="3">
                        <stats-card icon="ni ni-chart-pie-35"
                                    sub-title="N/A"
                                    title="Updates"
                                    type="gradient-orange">

                        </stats-card>
                    </b-col>
                    <b-col md="6" xl="3">
                        <stats-card icon="ni ni-money-coins"
                                    sub-title="N/A"
                                    title="Export-Count"
                                    type="gradient-green">
                        </stats-card>

                    </b-col>
                    <b-col md="6" xl="3">
                        <stats-card icon="ni ni-chart-bar-32"
                                    sub-title="N/A"
                                    title="Auto-Translations"
                                    type="gradient-info">
                        </stats-card>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </div>
</template>

<script>
import Locallang from "./Locallang/Locallang";

export default {
    props: ["locallang"],
    components: {
        Locallang,
    },
    computed: {
        getProviderName: function () {
            return this.$store.getters.config.provider;
        },
    }
};
</script>

<style>
</style>

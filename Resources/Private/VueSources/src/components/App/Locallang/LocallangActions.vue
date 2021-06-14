<template>
    <div>
        <!-- Add new Entity -->
        <translation-add
            :languagesInUse="languagesInUse"
            :locallang="locallang"
            :rerender="rerender"
        />
        <!-- Add new language -->
        <append-language :locallang="locallang"/>
        <!-- Expand all button -->
        <base-button size="sm"
                     type="primary"
                     @click="onExpandAll"
        >
            <b-icon aria-hidden="true" icon="arrows-expand"></b-icon>
            Expand all
        </base-button>
        <!-- Collapse all button -->
        <base-button v-b-tooltip.hover
                     size="sm"
                     title="Collapse all"
                     type="primary"
                     @click="onCollapseAll"
        >
            <b-icon aria-hidden="true" icon="arrows-collapse"></b-icon>
            Collapse all
        </base-button>

        <!-- Export -->
        <locallang-export :locallang="locallang"/>

    </div>
</template>
<script>
import LocallangExport from "./LocallangExport";
import TranslationAdd from "../Translation/TranslationAdd";
import AppendLanguage from "./AppendLanguage.vue";

export default {
    name: "LocallangActions",
    props: ["locallang", "isLoaded", "languagesInUse", "rerender"],
    data() {
        return {};
    },
    computed: {},
    methods: {
        onExpandAll() {
            this.locallang.translationsArray.filter(
                (translation) => (translation.object.expanded = true)
            );
        },
        onCollapseAll() {
            this.locallang.translationsArray.filter(
                (translation) => (translation.object.expanded = false)
            );
        },
    },
    components: {
        LocallangExport,
        TranslationAdd,
        AppendLanguage,
    },
};
</script>

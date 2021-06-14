<template>
    <tr class="" role="row">
        <td aria-colindex="1" class="" role="cell">
            <key-icon class="text-primary" height="16px" width="16px"></key-icon>
            <span class="font-weight-600 name ml-2 mb-0 text-sm">{{ translationDTO.key }}</span>
        </td>
        <td aria-colindex="2" class="" role="cell">
            <badge :type="translationDTO.statusType" class="mr-4">
                <span class="status">{{ translationDTO.status }}</span>

            </badge>
        </td>
        <td aria-colindex="3" class="" role="cell">
            <div class="d-flex align-items-center">
                <span class="completion mr-2">{{ completedPercentage }}%</span>
                <div>
                    <base-progress :type="translationDTO.statusType" :value="completedPercentage"/>
                </div>
            </div>
        </td>
    </tr>
</template>
<script>

export default {
    name: "append-language-key",
    components: {},
    props: ["translationDTO"],
    data() {
        return {
            completedLanguages: 0,
            languagesToAdd: 1,

        };
    },
    computed: {
        completedPercentage() {
            return Math.round(this.completedLanguages * 100 / this.languagesToAdd);
        }
    },
    methods: {
        callApi: function (newObjectLanguages, newObjectXmlSpace, newObjectAutoTranslate) {
            this.languagesToAdd = newObjectLanguages.length;
            for (let newObjectLanguage in newObjectLanguages) {
                this.$store
                    .dispatch("addTranslationValue", {
                        uid: this.translationDTO.translationUid,
                        data: JSON.stringify({
                            value: newObjectLanguages[newObjectLanguage],
                            autoTranslate: newObjectAutoTranslate,
                            textToTranslate: this.translationDTO.defaultValue,
                        }),
                    })
                    .then(() => {
                        // TODO - Check if response was successful
                        this.completedLanguages++;
                        this.translationDTO.statusType = "success";
                        this.translationDTO.status = "done";
                        // Telling parent to continue with the next entry. Were skipping this, if there are multiple languages remaining. When the last response was extracted, then we'll continue
                        if (this.completedLanguages == this.languagesToAdd) {
                            this.translationDTO.doneCallback();
                        }
                    });
            }

        },
        onCall: function (newObjectLanguages, newObjectXmlSpace, newObjectAutoTranslate) {
            this.translationDTO.statusType = "warning";
            this.translationDTO.status = "running";
            this.callApi(newObjectLanguages, newObjectXmlSpace, newObjectAutoTranslate);

        }
    },
    created: function () {
        this.$parent.$on('call', this.onCall);
    }
};
</script>

<template>
  <div>
    <b-alert v-if="locallangs.length == 0" show variant="danger"
      >There are no locallang-files for this extension or the files are broken
      and could not be fetched</b-alert
    >
    <b-card-group
      class="pb-3"
      deck
      v-for="locallang in locallangs"
      :key="locallang.uid"
    >
      <Locallang :locallang="locallang" />
      <hr />
    </b-card-group>
  </div>
</template>

<script>
import Locallang from "./Locallang";
export default {
  name: "Locallangs",
  props: ["locallangs"],
  components: {
    Locallang,
  },
};
</script>
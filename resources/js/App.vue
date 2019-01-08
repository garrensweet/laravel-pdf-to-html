<template>
  <v-app>
    <v-content>
      <v-layout align-center justify-center row fill-height>
        <uploader></uploader>
      </v-layout>
    </v-content>
  </v-app>
</template>
<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import Uploader from "@/components/Uploader.vue";

@Component({
  components: {
    Uploader
  }
})
export default class App extends Vue {}
</script>

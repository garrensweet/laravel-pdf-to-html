<template>
  <v-card>
    <v-card-text>
      <v-layout class="uploader" align-center justify-center row fill-height>
        <input
          type="file"
          id="file"
          ref="file"
          multiple
          accept="application/pdf"
          @change="handleFiles"
        >
        <cube :active="getActiveFace">
          <template slot="front">
            <div class="d-flex align-center justify-center row fill-height">
              <div>
                <p class="text-xs-center mb-4">Drag & Drop</p>
                <v-divider></v-divider>
                <p class="mt-4">
                  <v-btn @click="chooseAFile">Choose a File</v-btn>
                </p>
              </div>
            </div>
          </template>
          <template slot="right">
            <div class="d-flex align-center justify-center row fill-height">
              <div>
                <p class="mb-4">
                  <span v-html="file.name"></span>
                </p>
                <v-divider></v-divider>
                <p class="mt-4">
                  <v-btn @click="convertFile" :loading="loading">Convert Your File</v-btn>
                </p>
              </div>
            </div>
          </template>
        </cube>
      </v-layout>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import { Component, Vue } from "vue-property-decorator";
import axios from "axios";

import Cube from "@/components/Cube.vue";

interface FileInfo {
  name: string | undefined;
  size: number | undefined;
  original: Blob | undefined;
}

@Component({
  components: {
    Cube
  }
})
export default class Uploader extends Vue {
  file: FileInfo = {
    name: undefined,
    size: undefined,
    original: undefined
  };
  loading: boolean = false;

  mounted() {
    const token: HTMLMetaElement | null = document.head.querySelector(
      'meta[name="csrf-token"]'
    );
    if (token) {
      (window as any).Echo.private(`user.${token.content}`).listen(
        ".download.ready",
        (e: any) => {
          this.loading = false;
        }
      );
    }
  }

  chooseAFile() {
    (this.$refs.file as HTMLInputElement).click();
  }

  handleFiles(e: any) {
    const file: File = (e.target.files as FileList) ? e.target.files[0] : false;

    if (file) {
      this.file = {
        name: file.name,
        size: file.size,
        original: file
      };
    }
  }

  async convertFile(e: any) {
    e.preventDefault();

    try {
      this.loading = true;
      const fd = new FormData();
      fd.append("file", this.file.original as Blob);
      const response = axios.post("/api/v1/convert", fd, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      });
    } catch (err) {
      this.loading = false;
    }
  }

  get getActiveFace() {
    if (this.file.size) {
      return "right";
    }

    return "front";
  }
}
</script>

<style type="text/scss" lang="scss">
.layout {
  .uploader {
    min-width: 320px;
    border: 2px dashed #c3c3c3;
    min-height: 320px;
    margin: 1rem;
    height: 100%;

    @media screen and (min-width: 768px) {
      .uploader {
        min-width: 540px;
      }
    }
  }
}

#file {
  display: none;
}
</style>

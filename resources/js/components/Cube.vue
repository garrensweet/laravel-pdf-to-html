<template>
  <div class="scene">
    <div class="cube" :class="showActiveCube">
      <div class="cube__face cube__face--front" v-if="front">
        <slot name="front">Front</slot>
      </div>
      <div class="cube__face cube__face--right" v-if="right">
        <slot name="right">Right</slot>
      </div>
      <div class="cube__face cube__face--back" v-if="back">
        <slot name="back">Back</slot>
      </div>
      <div class="cube__face cube__face--left" v-if="left">
        <slot name="left">Left</slot>
      </div>
      <div class="cube__face cube__face--top" v-if="top">
        <slot name="top">Top</slot>
      </div>
      <div class="cube__face cube__face--bottom" v-if="bottom">
        <slot name="bottom">Bottom</slot>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class Cube extends Vue {
  @Prop({
    default: true
  })
  front: boolean;

  @Prop({
    default: true
  })
  right: boolean;

  @Prop({
    default: true
  })
  back: boolean;

  @Prop({
    default: true
  })
  left: boolean;

  @Prop({
    default: true
  })
  top: boolean;

  @Prop({
    default: true
  })
  bottom: boolean;

  @Prop({
    default: "front"
  })
  active: string;

  get showActiveCube() {
    return {
      [`show-${this.active}`]: true
    };
  }
}
</script>

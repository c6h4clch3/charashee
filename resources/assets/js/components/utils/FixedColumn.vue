<template functional>
  <div class="fixed-column container">
    <div class="row">
      <slot></slot>
    </div>
  </div>
</template>

<style lang="scss">
.fixed-column {
  position: fixed;
  top: 73px;
  pointer-events: none;

  & > .row > * {
    pointer-events: all;
  }
}
</style>


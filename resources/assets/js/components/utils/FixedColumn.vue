<template functional>
  <div class="fixed-column">
    <slot></slot>
  </div>
</template>

<style lang="scss">
.fixed-column {
  position: sticky;
  top: 73px;
}
</style>


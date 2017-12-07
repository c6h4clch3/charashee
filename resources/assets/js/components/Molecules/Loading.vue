<template functional>
  <div class="background">
    <span class="glyphicon glyphicon-refresh loading"></span>
  </div>
</template>

<style>
.background {
  display: flex;
  position: fixed;
  width: 100%;
  height: 100vh;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, .5);
  color: #fff;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 10000;
  pointer-events: all;
}

.loading {
  animation: rolling 1s linear 0s infinite;
  font-size: 40px;
}

@keyframes rolling {
  0% {
    transform: rotate(0deg);
  }
  50% {
    transform: rotate(180deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>

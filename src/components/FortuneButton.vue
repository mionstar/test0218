<template>
  <div class="fortune-container">
    <div class="shrine-header">
      <div class="lantern lantern-left">
        <div class="lantern-body">
          <span>福</span>
        </div>
        <div class="lantern-tail"></div>
      </div>
      <div class="title-block">
        <h1 class="site-title">おみくじ</h1>
        <p class="site-subtitle">あなたの運勢を占います</p>
      </div>
      <div class="lantern lantern-right">
        <div class="lantern-body">
          <span>運</span>
        </div>
        <div class="lantern-tail"></div>
      </div>
    </div>

    <div class="fortune-box">
      <div class="omikuji-scroll">
        <div class="scroll-decoration top"></div>
        <div class="scroll-content">
          <p class="scroll-text">神様のお告げを聞きましょう</p>
          <p class="scroll-text small">ボタンを押して運勢を引いてください</p>
        </div>
        <div class="scroll-decoration bottom"></div>
      </div>

      <form method="POST" action="result.php" @submit="onSubmit">
        <button
          type="submit"
          class="draw-button"
          :class="{ shaking: isShaking }"
          @mouseenter="startShake"
          @mouseleave="stopShake"
        >
          <span class="btn-icon">🎋</span>
          <span class="btn-text">おみくじを引く</span>
          <span class="btn-icon">🎋</span>
        </button>
      </form>
    </div>

    <div class="sakura-container">
      <div v-for="i in 8" :key="i" class="sakura" :style="getSakuraStyle(i)">🌸</div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const isShaking = ref(false)

function startShake() {
  isShaking.value = true
}

function stopShake() {
  isShaking.value = false
}

function onSubmit() {
  isShaking.value = true
}

function getSakuraStyle(index) {
  const left = (index * 12) + Math.random() * 5
  const animationDelay = (index * 0.8) + 's'
  const animationDuration = (3 + Math.random() * 2) + 's'
  return {
    left: left + '%',
    animationDelay,
    animationDuration,
  }
}
</script>

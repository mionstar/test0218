<template>
  <div class="result-container">
    <div class="result-header">
      <h1 class="result-title">おみくじ結果</h1>
    </div>

    <div class="result-scroll" :class="{ revealed: isRevealed }">
      <div class="scroll-top"></div>
      <div class="scroll-body">
        <div class="fortune-rank" :style="{ color: fortune.color }">
          {{ fortune.rank }}
        </div>
        <div class="fortune-divider"></div>
        <div class="fortune-details">
          <div v-for="item in fortune.details" :key="item.category" class="detail-item">
            <span class="detail-category">{{ item.category }}</span>
            <span class="detail-value">{{ item.value }}</span>
          </div>
        </div>
        <div class="fortune-divider"></div>
        <div class="fortune-message">
          <p>{{ fortune.message }}</p>
        </div>
      </div>
      <div class="scroll-bottom"></div>
    </div>

    <div class="action-buttons">
      <a href="index.php" class="retry-button">
        <span>🎋</span>
        <span>もう一度引く</span>
      </a>
    </div>

    <div class="sakura-container">
      <div v-for="i in 10" :key="i" class="sakura" :style="getSakuraStyle(i)">🌸</div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
  fortune: {
    type: Object,
    required: true,
  },
})

const isRevealed = ref(false)

onMounted(() => {
  setTimeout(() => {
    isRevealed.value = true
  }, 300)
})

function getSakuraStyle(index) {
  const left = (index * 10) + '%'
  const animationDelay = (index * 0.5) + 's'
  const animationDuration = (4 + (index % 3)) + 's'
  return {
    left,
    animationDelay,
    animationDuration,
  }
}
</script>

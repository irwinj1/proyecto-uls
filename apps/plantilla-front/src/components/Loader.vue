<template>
  <div
    v-if="loader"
    class="loader-overlay"
    role="status"
    aria-live="polite"
    aria-busy="true"
  >
    <div class="loader-content">
      <div
        class="spinner"
        :style="{
          width: size,
          height: size,
          borderColor: `${color}33`,
          borderTopColor: color,
        }"
      ></div>
      <p v-if="loaderText" class="loader-text">{{ loaderText }}</p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  size: {
    type: String,
    default: '52px',
  },
  color: {
    type: String,
    default: '#2563eb',
  },
  loaderText: {
    type: String,
    default: 'Cargando...',
  },
  loader: {
    type: Boolean,
    default: false,
  },
});
</script>

<style scoped>
.loader-overlay {
  position: fixed;
  inset: 0;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(15, 23, 42, 0.45);
  backdrop-filter: blur(2px);
}

.loader-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  padding: 1.5rem 2rem;
  border-radius: 1rem;
  background: rgba(255, 255, 255, 0.92);
  box-shadow: 0 12px 40px rgba(15, 23, 42, 0.18);
}

.spinner {
  border-radius: 50%;
  border-style: solid;
  border-width: 4px;
  animation: spin 0.8s linear infinite;
}

.loader-text {
  margin: 0;
  color: #0f172a;
  font-size: 0.95rem;
  font-weight: 600;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
</style>
 
import { defineStore } from 'pinia';

export const useLoaderStore = defineStore('loader', {
  state: () => ({
    loadingCount: 0,
  }),
  getters: {
    isLoading: (state) => state.loadingCount > 0,
  },
  actions: {
    showLoader() {
      this.loadingCount += 1;
    },
    hideLoader() {
      this.loadingCount = Math.max(0, this.loadingCount - 1);
    },
    clearLoader() {
      this.loadingCount = 0;
    },
  },
});
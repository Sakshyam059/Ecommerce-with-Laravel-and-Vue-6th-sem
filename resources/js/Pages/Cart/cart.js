import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({ cart: [], }),
  actions: {
    removeProductFromCart (prodId) {
        this.cart.forEach((product, index) => {
            if (product.product_id === prodId) this.cart.splice(index, 1)
        })
    },
    priceLimit(){
      let total = 0;
      this.cart.forEach((product) => {
        total += product.total_price;
      })
      return total   
    }
  },
  persist: true
})
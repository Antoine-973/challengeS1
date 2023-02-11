<script>
import { StripeCheckout } from '@vue-stripe/vue-stripe';

export default {
  components: {
    StripeCheckout,
  },
  data () {
    this.publishableKey = import.meta.env.VITE_STRIPE_PUBLISHABLE_KEY;
    return {
      cardDonation: [
        {
          id: 1,
          amount: 60,
          modalId: 'modalSixty',
          dogPicture: "http://www.petelevage.com/blog/wp-content/uploads/2016/04/chien-heureux.jpg",
        },
        {
          id: 2,
          amount: 120,
          modalId: 'modalHundredTwenty',
          dogPicture: "https://www.doginthecity.fr/wp-content/uploads/2015/08/f2562418.jpg",
        },
        {
          id: 3,
          amount: 200,
          modalId: 'modalTwoHundred',
          dogPicture: "https://animalaxy.fr/wp-content/uploads/2017/09/Capture-20.jpg",
        }
      ],
      loading: false,
      lineItemsSixty: [
        {
          price: import.meta.env.VITE_STRIPE_PRICE_PRODUCT_SIXTY,
          quantity: 1,
        },
      ],
      lineItemsHundredTwenty: [
        {
          price: import.meta.env.VITE_STRIP_PRICE_PRODUCT_HUNDREDTWENTY,
          quantity: 1,
        },
      ],
      lineItemsTwoHundred: [
        {
          price: import.meta.env.VITE_STRIPE_PRICE_PRODUCT_TWOHUNDRED,
          quantity: 1,
        },
      ],
      successURL: 'http://localhost:3000/success',
      cancelURL: 'http://localhost:3000/error',
    };
  },
  methods: {
    submitSixty() {
      this.$refs.paidsixty.redirectToCheckout();
    },
    submitHundredTwenty() {
      this.$refs.paidthundredtwenty.redirectToCheckout();
    },
    submitTwoHundred() {
      this.$refs.paidtwohundred.redirectToCheckout();
    }
  },
};



</script>

<template>
  <main>
    <h1 class="text-center mb-11 text-lg" style="margin-top: 2%;">Les animaux sont nos amis ! Nous sommes les seuls à pouvoir les aider. Pour y contribuer, verser la somme de votre choix, ça fera des heureux :)</h1>
    <stripe-checkout
      ref="paidsixty"
      mode="payment"
      :pk="publishableKey"
      :line-items="lineItemsSixty"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />

    <stripe-checkout
      ref="paidthundredtwenty"
      mode="payment"
      :pk="publishableKey"
      :line-items="lineItemsHundredTwenty"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />

    <stripe-checkout
      ref="paidtwohundred"
      mode="payment"
      :pk="publishableKey"
      :line-items="lineItemsTwoHundred"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />
    <div class="container-card-donation">
      <template  v-for="itemDonation in cardDonation" :key="itemDonation.id" >
        <div class="card w-96 bg-base-100 shadow-xl">
          <figure class="px-10 pt-10">
            <img v-bind:src="`${itemDonation.dogPicture}`" alt="happyDog" class="rounded-xl" />
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">{{itemDonation.amount}}€</h2>
            <p>Don de {{itemDonation.amount}}€</p>
            <div class="card-actions">
              <label :for="`${itemDonation.modalId}`" class="btn btn-primary">Faire un don</label>
            </div>
          </div>
        </div>

        <input type="checkbox" :id="`${itemDonation.modalId}`" class="modal-toggle" />
        <div class="modal">
          <div class="modal-box">
            <h3 class="font-bold text-lg">Êtes-vous sûr de vouloir faire un don de {{itemDonation.amount}}€ pour la SPA ?</h3>
            <p>Vous serez redirigé vers la page de paiement.</p>
            <div class="modal-action">
              <button v-if="itemDonation.id === 1" @click="submitSixty()" class="btn">Accepter</button>
              <button v-else-if="itemDonation.id === 2" @click="submitHundredTwenty()" class="btn">Accepter</button>
              <button v-else @click="submitTwoHundred()" class="btn">Accepter</button>
              <label :for="`${itemDonation.modalId}`" class="btn">Annuler</label>
            </div>
          </div>
        </div>
      </template>
    </div>
  </main>
</template>

<style scoped>

.card-title {
  font-size: 2rem;
}
.container-card-donation {
  display: flex;
  flex-direction: columns;
  justify-content: space-around;
}
</style>
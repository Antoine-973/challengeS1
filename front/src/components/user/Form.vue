<template>
  <form @submit.prevent="handleSubmit(item)">
    <div class="form-group">
      <label
        for="user_email"
        class="form-control-label">email</label>
        <input
          id="user_email"
          v-model="item.email"
          :class="['form-control', !isValid('email') ? 'is-invalid' : 'is-valid']"
          type="text"
          required="required"
          placeholder="">
      <div
        v-if="!isValid('email')"
        class="invalid-feedback">{{ violations.email }}</div>
    </div>
    <div class="form-group">
      <label
        for="user_username"
        class="form-control-label">username</label>
        <input
          id="user_username"
          v-model="item.username"
          :class="['form-control', !isValid('username') ? 'is-invalid' : 'is-valid']"
          type="text"
          required="required"
          placeholder="">
      <div
        v-if="!isValid('username')"
        class="invalid-feedback">{{ violations.username }}</div>
    </div>
    <div class="form-group">
      <label
        for="user_plainPassword"
        class="form-control-label">plainPassword</label>
        <input
          id="user_plainPassword"
          v-model="item.plainPassword"
          :class="['form-control', !isValid('plainPassword') ? 'is-invalid' : 'is-valid']"
          type="text"
          placeholder="">
      <div
        v-if="!isValid('plainPassword')"
        class="invalid-feedback">{{ violations.plainPassword }}</div>
    </div>

    <button
      type="submit"
      class="btn btn-success">Submit</button>
  </form>
</template>

<script>
  import { find, get, isUndefined } from 'lodash';
  import { mapActions } from 'vuex';

  export default {
  props: {
    handleSubmit: {
      type: Function,
      required: true,
    },

    values: {
      type: Object,
      required: true,
    },

    errors: {
      type: Object,
      default: () => {},
    },

    initialValues: {
      type: Object,
      default: () => {},
    }
  },

  mounted() {
  },

  computed: {

    // eslint-disable-next-line
    item() {
      return this.initialValues || this.values;
    },

    violations() {
      return this.errors || {};
    },
  },

  methods: {
    ...mapActions({
    }),

    isSelected(collection, id) {
      return find(this.item[collection], ['@id', id]) !== undefined;
    },

    isValid(key) {
      return isUndefined(get(this.violations, key));
    },
  },
};
</script>

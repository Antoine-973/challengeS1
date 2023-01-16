<template>
  <div>
    <h1>Create User</h1>

    <div
      v-if="isLoading"
      class="alert alert-info"
      role="status">Loading...</div>
    <div
      v-if="error"
      class="alert alert-danger"
      role="alert">
      <span
        class="fa fa-exclamation-triangle"
        aria-hidden="true">{{ error }}</span>
    </div>

    <UserForm
      :handle-submit="onSendForm"
      :values="item"
      :errors="violations" />

    <router-link
      :to="{ name: 'UserList' }"
      class="btn btn-default">Back to list</router-link>
  </div>
</template>

<script>
import { createHelpers } from 'vuex-map-fields';
import { mapActions } from 'vuex';
import UserForm from './Form.vue';

const { mapFields } = createHelpers({
    getterType: 'user/create/getField',
    mutationType: 'user/create/updateField',
});

export default {
  components: {
    UserForm,
  },

  data () {
    return {
      item: {},
    };
  },

  computed: {
    ...mapFields([
      'error',
      'isLoading',
      'created',
      'violations',
    ]),
  },

  watch: {
    // eslint-disable-next-line object-shorthand,func-names
    created: function(created) {
      if (!created) {
        return;
      }

      this.$router.push({ name: 'UserUpdate', params: { id: created['@id'] } });
    }
  },

  methods: {
    ...mapActions('user/create', [
      'create',
    ]),

    onSendForm () {
      this.create(this.item);
    },
  },
};
</script>

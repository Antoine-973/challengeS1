<template>
  <div>
    <h1>Show Book {{ item && item['@id'] }}</h1>

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
    <div
      v-if="deleteError"
      class="alert alert-danger"
      role="alert">
      <span
        class="fa fa-exclamation-triangle"
        aria-hidden="true">{{ deleteError }}</span>
    </div>
    <div
      v-if="item"
      class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">email</th>
            <td>{{ item['email'] }}</td>
          </tr>
          <tr>
            <th scope="row">username</th>
            <td>{{ item['username'] }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <router-link
      :to="{ name: 'UserList' }"
      class="btn btn-primary">
      Back to list
    </router-link>
    <router-link
      v-if="item"
      :to="{ name: 'UserUpdate', params: { id: item['@id'] } }"
      class="btn btn-warning">
      Edit
    </router-link>
    <button
      class="btn btn-danger"
      @click="del">Delete</button>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import { mapFields } from 'vuex-map-fields';
import ItemWatcher from '../../mixins/ItemWatcher';
import * as types from '../../store/modules/user/show/mutation_types';
import * as delTypes from '../../store/modules/user/delete/mutation_types';

export default {
  mixins: [ItemWatcher],
  computed: {
    ...mapFields('user/del', {
      deleteError: 'error',
      deleted: 'deleted',
      mercureDeleted: 'mercureDeleted',
    }),
    ...mapFields('user/show', {
      error: 'error',
      isLoading: 'isLoading',
      item: 'retrieved',
      hubUrl: 'hubUrl',
    }),
    itemUpdateMutation: () =>`user/show/${types.USER_SHOW_SET_RETRIEVED}`,
    itemMercureDeletedMutation: () => `user/del/${delTypes.USER_DELETE_MERCURE_SET_DELETED}`,
  },

  watch: {
    // eslint-disable-next-line object-shorthand,func-names
    deleted: function(deleted) {
      if (!deleted) {
        return;
      }

      this.$router.push({ name: 'UserList' });
    },
    // eslint-disable-next-line object-shorthand,func-names
    mercureDeleted: function(deleted) {
      if (!deleted) {
        return;
      }

      this.$router.push({ name: 'UserList' });
    },
  },

  beforeDestroy () {
    this.reset();
  },

  created () {
    this.retrieve(decodeURIComponent(this.$route.params.id));
  },

  methods: {
    ...mapActions({
      deleteItem: 'user/del/del',
      reset: 'user/show/reset',
      retrieve: 'user/show/retrieve',
    }),

    del() {
      if (window.confirm('Are you sure you want to delete this user?')) {
        this.deleteItem(this.item);
      }
    },
  },
};
</script>

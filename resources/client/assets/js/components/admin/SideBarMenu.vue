<template>
  <ul class="sidebar-menu">
    <li v-bind:class="$route.name == 'dashboard' ? 'active' : ''">
      <router-link :to="{ name: 'dashboard' }">
        <i class="fas fa-tachometer-alt"></i>
        <span class="title">Dashboard</span>
      </router-link>
    </li>

    <li
      class="treeview"
      v-bind:class="$route.name == 'permissions.index' || $route.name == 'roles.index' || $route.name == 'users.index' ? 'active' : ''"
    >
      <a href="#">
        <i class="fas fa-users-cog"></i>
        <span>User Management</span>
        <span class="pull-right-container">
          <i class="fas fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li v-bind:class="$route.name == 'permissions.index' ? 'active' : ''">
          <router-link :to="{ name: 'permissions.index' }">
            <i class="fas fa-briefcase"></i>
            <span>Permissions</span>
          </router-link>
        </li>
        <li v-bind:class="$route.name == 'roles.index' ? 'active' : ''">
          <router-link :to="{ name: 'roles.index' }">
            <i class="fas fa-briefcase"></i>
            <span>Roles</span>
          </router-link>
        </li>
        <li v-bind:class="$route.name == 'users.index' ? 'active' : ''">
          <router-link :to="{ name: 'users.index' }">
            <i class="fas fa-user"></i>
            <span>Users</span>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-bind:class="$route.name == 'campaigns.index' ? 'active' : ''">
      <router-link :to="{ name: 'campaigns.index' }">
        <i class="fas fa-comment-dots"></i>
        <span class="title">SMS Campaingn</span>
        <span class="pull-right-container" v-if="unReadMsgCount > 0">
          <span class="badge label-danger pull-right">{{unReadMsgCount}}</span>
        </span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'invoices.index' ? 'active' : ''">
      <router-link :to="{ name: 'invoices.index' }">
        <i class="fas fa-coins"></i>
        <span class="title">Invoices</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'countries.index' ? 'active' : ''">
      <router-link :to="{ name: 'countries.index' }">
        <i class="fas fa-globe-europe"></i>
        <span class="title">Country Setting</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'languages.index' ? 'active' : ''">
      <router-link :to="{ name: 'languages.index' }">
        <i class="fas fa-language"></i>
        <span class="title">Languages</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'currencies.index' ? 'active' : ''">
      <router-link :to="{ name: 'currencies.index' }">
        <i class="fas fa-money-bill-alt"></i>
        <span class="title">Currency Setting</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'filter.keys.index' ? 'active' : ''">
      <router-link :to="{ name: 'filter.keys.index' }">
        <i class="fas fa-filter"></i>
        <span class="title">Filter Keys</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'auth.change_password' ? 'active' : ''">
      <router-link :to="{ name: 'auth.change_password' }">
        <i class="fas fa-key"></i>
        <span class="title">Change Password</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'auth.change_profile' ? 'active' : ''">
      <router-link :to="{ name: 'auth.change_profile' }">
        <i class="fas fa-user-cog"></i>
        <span class="title">Change Profile</span>
      </router-link>
    </li>

    <li>
      <a href="#logout" onclick="$('#logout').submit();">
        <i class="fas fa-arrow-left"></i>
        <span class="title">Logout</span>
      </a>
    </li>
  </ul>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: ["unreadCnt"],
  data() {
    return {};
  },

  mounted() {
    //console.log(this.$router.currentRoute());
  },
  created() {
    this.updateData(this.unreadCnt);
  },
  computed: {
    ...mapGetters("SideBar", ["unReadMsgCount"]),

    getClass: function(param) {}
  },
  methods: {
    ...mapActions("SideBar", ["resetState", "updateData"])
  }
};
</script>


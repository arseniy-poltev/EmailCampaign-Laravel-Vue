<template>
  <ul class="sidebar-menu">
    <li v-bind:class="$route.name == 'dashboard' ? 'active' : ''">
      <router-link :to="{ name: 'dashboard' }">
        <i class="fas fa-tachometer-alt"></i>
        <span class="title">{{ trans('backend.txt_dashboard') }}</span>
      </router-link>
    </li>
    <li v-bind:class="$route.name == 'campaigns.index' ? 'active' : ''">
      <router-link :to="{ name: 'campaigns.index' }">
        <i class="fas fa-comment-dots"></i>
        <span class="title">{{ trans('backend.txt_SMS_campaign') }}</span>
        <span class="pull-right-container" v-if="unReadMsgCount > 0">
          <span class="badge label-danger pull-right">{{unReadMsgCount}}</span>
        </span>
      </router-link>
    </li>
    <li v-bind:class="$route.name == 'invoice' ? 'active' : ''">
      <router-link :to="{ name: 'invoice' }">
        <i class="fas fa-money-bill"></i>
        <span class="title">{{ trans('backend.txt_invoice') }}</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'auth.change_password' ? 'active' : ''">
      <router-link :to="{ name: 'auth.change_password' }">
        <i class="fas fa-key"></i>
        <span class="title">{{ trans('backend.txt_change_pwd') }}</span>
      </router-link>
    </li>

    <li v-bind:class="$route.name == 'auth.change_profile' ? 'active' : ''">
      <router-link :to="{ name: 'auth.change_profile' }">
        <i class="fas fa-user-cog"></i>
        <span class="title">{{ trans('backend.txt_change_profile') }}</span>
      </router-link>
    </li>

    <li>
      <a href="#logout" onclick="$('#logout').submit();">
        <i class="fas fa-arrow-left"></i>
        <span class="title">{{ trans('backend.txt_logout') }}</span>
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


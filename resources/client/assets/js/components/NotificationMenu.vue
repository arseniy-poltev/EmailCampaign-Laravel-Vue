<template>
  <li class="dropdown notifications-menu" id="notification">
    <a
      href="#"
      class="dropdown-toggle"
      data-toggle="dropdown"
      aria-expanded="false"
      @click="clearNotification"
    >
      <i class="fas fa-bell"></i>
      <span v-if="countMsg > 0" class="label label-danger" id="badge">{{countMsg}}</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">Recent Notifications</li>
      <li>
        <!-- inner menu: contains the actual data -->
        <ul class="menu">
          <li v-for="(notification,index) in recentMsg" v-bind:key="notification.id">
            <router-link
              :to="{ name: 'campaigns.show', params: { id: notification.campaign_id } }"
              class="notification-item"
            >
              <i class="notification-icon" v-bind:class="getClass(index)"></i>
              <span class="notification-message">{{notification.message}}</span>

              <span class="notification-date">
                <i class="fas fa-clock-o"></i>
                {{notification.local_created_at.for_human}}
              </span>
            </router-link>
          </li>
        </ul>
      </li>
      <!-- <li class="footer">
        <a href="#">View all</a>
      </li>-->
    </ul>
  </li>
</template>
<script>
export default {
  props: ["unreadCnt", "recent"],
  data() {
    return {
      countMsg: this.unreadCnt,
      recentMsg: this.recent,
      FCM: null,
      eventListener: null,
      textColorClass: [
        "fas fa-smile text-black",
        "fas fa-clipboard-list text-yellow",
        "fas fa-warning text-red",
        "fas fa-award text-aqua",
        "fas fa-clipboard-check text-green"
      ],
      statusClass: ["draft", "pending", "rejected", "approved", "done"]
    };
  },
  computed: {},
  created() {
    this.eventListener = new BroadcastChannel("bgListener");
    if (this.eventListener != null) {
      this.eventListener.onmessage = this.onMessage;
    }
  },
  mounted() {
    this.FCM = window.messaging;
    if (this.FCM != null) {
      this.FCM.onMessage(this.onMessage);
    }
  },
  methods: {
    onMessage(payload) {
      payload = payload.data;
      //if (payload instanceof MessageEvent) {

      //}
      console.log("Message received. ", payload);
      var detail = payload.detail;
      var campaign = payload.campaign;
      if (detail == null || detail == undefined) {
        return;
      }
      detail = JSON.parse(detail);
      campaign = JSON.parse(campaign);
      this.countMsg++;

      if (this.recentMsg.length >= 5) {
        this.recentMsg.pop();
      }

      this.recentMsg.unshift({
        id: detail.id,
        campaign_id: campaign.id,
        message: detail.message,
        status: detail.status,
        local_created_at: detail.local_created_at
      });

      this.$eventHub.$emit("custome-event", detail.message);

      this.$store.dispatch("SideBar/updateData", this.countMsg);
      this.$store.dispatch("CampaignsIndex/updateData", campaign);
    },
    onNotificationClick(e, id) {
      this.$router.push({
        name: "campaigns.show",
        params: {
          id: id
        }
      });
    },
    getClass: function(key) {
      var index = this.statusClass.indexOf(this.recentMsg[key].status);
      if (index != -1) {
        return this.textColorClass[index];
      }
      return "text-black";
    },
    clearNotification() {
      axios
        .get("/api/common/clearNotification")
        .then(response => {
          this.countMsg = 0;
          this.$store.dispatch("SideBar/updateData", this.countMsg);
        })
        .catch(error => {})
        .finally(() => {});
    }
  }
};
</script>
<style scoped>
#badge {
  right: -3px !important;
  font-size: 12px !important;
}
li.header {
  font-size: 20px !important;
  font-weight: 500;
  padding: 20px !important;
  text-align: center;
}
.notification-date {
  font-size: 10px;
  float: right;
  color: gray;
  padding-top: 18px;
}
.notification-item {
  padding-left: 20px !important;
  padding-right: 20px !important;
}
.notification-message {
  font-size: 16px;
  font-weight: 400;
}
.notification-icon {
  font-size: 28px;
  padding-right: 3px;
}
.dropdown-menu {
  width: 380px !important;
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.16), 0 8px 24px rgba(0, 0, 0, 0.2) !important;
}
.menu {
  max-height: 300px !important;
}
</style>



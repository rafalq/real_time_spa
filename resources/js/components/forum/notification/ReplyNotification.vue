<template>
  <div>
    <v-menu
      v-if="unreadNotificationCounter > 0"
      bottom
      origin="center center"
      transition="scale-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon small class="mx-2" fab color="red" v-bind="attrs" v-on="on">
          <v-icon>mdi-bell</v-icon>
          <v-badge
            color="white red--text"
            :content="unreadNotificationCounter"
          ></v-badge>
        </v-btn>
      </template>

      <v-list>
        <v-list-item
          v-for="notification in unreadNotifications"
          :key="notification.id"
        >
          <router-link
            :to="notification.path"
            class="notificatin__link-to-question"
          >
            <v-list-item-title @click="markAsRead(notification)">{{
              notification.question
            }}</v-list-item-title>
          </router-link>
        </v-list-item>
      </v-list>
    </v-menu>
    <v-icon v-else class="white--text pa-2"> mdi-bell-outline </v-icon>
  </div>
</template>

<script>
export default {
  data() {
    return {
      readNotifications: {},
      unreadNotifications: {},
      unreadNotificationCounter: 0,
    };
  },
  methods: {
    getNotifications() {
      axios.post("/api/notifications").then((response) => {
        this.readNotifications = response.data.read_notifications;
        this.unreadNotifications = response.data.unread_notifications;
        this.unreadNotificationCounter =
          response.data.unread_notifications.length;
      });
    },
    markAsRead(notification) {
      axios
        .post("/api/markAsRead", { id: notification.id })
        .then((response) => {
          this.unreadNotifications.splice(notification, 1);
          this.readNotifications.push(notification);
          this.unreadNotificationCounter--;
        });
    },
  },
  mounted() {
    if (User.loggedIn()) {
      this.getNotifications();
    }
  },
};
</script>

<style scoped>
.notificatin__link-to-question {
  text-decoration: none;
  color: gray;
}
</style>e
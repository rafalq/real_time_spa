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
            class="notification__link-to-question"
          >
            <v-list-item-title @click="markAsRead(notification)"
              >{{ notification.question }} by
              <span class="notification__reply-by">{{
                notification.replyBy
              }}</span></v-list-item-title
            >
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
      notificationSound:
        "https://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3",
    };
  },
  methods: {
    getNotifications() {
      axios
        .post("/api/notifications")
        .then((response) => {
          this.readNotifications = response.data.read_notifications;
          this.unreadNotifications = response.data.unread_notifications;
          this.unreadNotificationCounter =
            response.data.unread_notifications.length;
        })
        // --------- token expired ---------
        .catch((error) => Exception.handle(error));
    },
    markAsRead(notification) {
      axios
        .post("/api/markAsRead", { id: notification.id })
        .then((response) => {
          this.unreadNotifications.splice(notification, 1);
          this.readNotifications.push(notification);
          this.unreadNotificationCounter--;
        })
        // --------- token expired ---------
        .catch((error) => Exception.handle(error));
    },
    playSound() {
      let newReplyAlarm = new Audio(this.notificationSound);
      newReplyAlarm.muted = true;
      newReplyAlarm.play();
    },
  },
  mounted() {
    if (User.loggedIn()) {
      // const notificationSound = new Audio( require('@/assets/foo.ogg') ).play();
      // const notificationSound = new Audio(
      //   require("file://../../../../../public/sounds/notification-sound.wav")
      // );
      this.getNotifications();
      Echo.private("notify-" + User.getId()).notification((notification) => {
        this.unreadNotifications.unshift(notification);
        this.unreadNotificationCounter++;
        this.playSound();
      });
    }
  },
};
</script>

<style scoped>
.notification__link-to-question {
  text-decoration: none;
  color: gray;
}
.notification__reply-by {
  font-weight: bold;
}
</style>
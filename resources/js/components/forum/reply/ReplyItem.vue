<template>
  <div>
    <v-divider></v-divider>
    <div class="py-4 px-2">
      <div v-if="$slots.default">
        <slot></slot>
      </div>
      <div class="d-flex flex-row-reverse">
        <div>
          <v-app-bar flat color="rgba(0, 0, 0, 0)" class="pt-4">
            <v-toolbar-title class="pr-0">
              <div class="d-flex flex-column mr-3">
                <p class="mb-0 mt-4 subtitle-1 d-flex justify-end">
                  <span>{{ replyUserName }}</span>
                </p>
                <p class="grey--text darken-4 caption d-flex justify-end">
                  <span>{{ replyDate }}</span>
                </p>
              </div>
            </v-toolbar-title>
            <v-avatar size="40">
              <img
                alt="user"
                src="https://cdn.pixabay.com/photo/2020/06/24/19/12/cabbage-5337431_1280.jpg"
              />
            </v-avatar>
          </v-app-bar>
        </div>
      </div>
      <div class="pt-5 pl-4" v-html="replyBody"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["replyId", "replyUserName", "replyDate", "replyBody"],
};
</script>
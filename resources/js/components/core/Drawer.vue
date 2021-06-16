<template>
  <v-navigation-drawer v-model="drawer" app>
    <v-list dense class="grey lighten-4">
      <template v-for="(item, index) in getMenu">
        <v-list-group :key="index" :prepend-icon="item.icon" no-action>
          <template v-slot:activator>
            <v-list-item-content style="margin-left: -15px">
              <v-list-item-title class="pl-4">
                {{ item.name.toUpperCase() }}
              </v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="(child, i) in item.subitems"
            :key="i"
            :to="child.to"
          >
            <v-list-item-content>
              <v-list-item-title class="pl-3">
                {{ child.title.toUpperCase() }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Drawer",
  methods: {
    ...mapActions("menu", ["setDrawer"]),
  },
  computed: {
    ...mapGetters("menu", ["getMenu", "getDrawer"]),
    drawer: {
      get() {
        return this.getDrawer;
      },
      set(value) {
        this.setDrawer(value);
      },
    },
  },
  data() {
    return {};
  },
};
</script>

<style>
</style>
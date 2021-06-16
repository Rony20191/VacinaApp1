<template>
  <v-app>
    <v-app-bar app color="primary" dense>
      <v-app-bar-nav-icon @click.stop="drawer=!drawer" class="hidden-md-and-up"></v-app-bar-nav-icon>
      <v-app-bar-title>
        <span class="title white--text">Vacina App</span>
      </v-app-bar-title>
      <v-spacer />
      <v-toolbar-items class="hidden-sm-and-down mt-1">
        <MenuList/>
      </v-toolbar-items>
    </v-app-bar>
    <Drawer/>
    <v-main class="application">
      <router-view />
    </v-main>
  </v-app>
</template>

<script>

import { mapActions,mapGetters } from 'vuex'
export default {
  name: "app",
  components:{
    MenuList: ()=> import('./components/core/MenuList.vue'),
    Drawer: ()=> import('./components/core/Drawer.vue')
  },
  data() {
    return {
    
    };
  },
  methods:{
    ...mapActions("menu",["setDrawer"])
  },
  computed:{
     ...mapGetters("menu",["getDrawer"]),
    drawer: {
      get() {
        return this.getDrawer;
      },
      set(value) {
        this.setDrawer(value);
      }
    }
  }
};
</script>

<style>
.application {
  background-color: #eeeeee;
}
</style>
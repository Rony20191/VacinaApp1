<template>
   <div>
       <v-menu offset-y v-for="(i, index) in getMenu" :key="index">
          <template v-slot:activator="{ on, attrs }">
            <v-btn text v-bind="attrs" v-on="on">
              <v-icon letf class="mr-2" color="white">{{ i.icon }}</v-icon>
              <span class="text-caption white--text">{{ i.name }}</span>
            </v-btn>
          </template>
          <v-list class="pb-1 pt-1">
            <v-list-item
              v-for="(item, j) in i.subitems"
              :key="j"
              class="pb-0 pt-0"
              :to="item.to"
              height="5px"
            >
              <v-list-item-icon class="pr-1 mr-1">
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title class="pa-0 ma-0">{{
                item.title
              }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
   </div>    
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "menuList",
    computed: {
    ...mapGetters("menu",["getMenu"])
  }

}
</script>

<style>

</style>
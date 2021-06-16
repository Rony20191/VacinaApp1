<template>
    <v-container fluid class="d-flex flex-row justify-center align-center fill-height">
      <v-row justify="center" align="center">
        <v-col cols="12" md="4" sm="12">
          <v-card max-width="450px">
              <v-card-title>
                  <span class="titler">Desafio</span>
              </v-card-title>
              <v-card-subtitle>
                 <span class="subtitle">Vacinação Covid-19</span>
              </v-card-subtitle>
                  <v-divider/>
              <v-card-text>
              
                  <v-row>
                      <v-col cols="4">
                            <v-img :src="vaccine"  class="ma-1"  contain/>
                      </v-col>
                      <v-col cols="8">
                          <p class="text-justify">
                            Este desafio consiste em desenvolver um protótipo de aplicação que aborde a temática de
                            vacinação contra COVID-19
                          </p>
                      </v-col>
                  </v-row>
              </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
</template>

<script>
import vaccine from "../assets/syringe.png";
export default {
    name:"home",
    data(){
        return{
            vaccine
        }
    }
}
</script>

<style>

</style>
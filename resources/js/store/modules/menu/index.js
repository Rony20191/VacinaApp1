

const state = {
    drawer: false,
    menu: [
        {
          icon: "mdi-needle",
          name: "Vacina",
          subitems: [
            {
              icon: "mdi-plus",
              title: "Adicionar",
              to: "/cadastrar/vacina",
            },
            {
              icon: "mdi-format-list-numbered",
              title: "List Vacina",
              to: "/listar/vacinas",
            },
          ],
        },
        {
          icon: "mdi-account-multiple",
          name: "Pacientes",
          subitems: [
            {
              icon: "mdi-plus",
              title: "Adicionar",
              to: "/cadastrar/paciente",
            },
            {
              icon: "mdi-format-list-numbered",
              title: "Listar Pacientes",
              to: "/listar/pacientes",
            },
            {
              icon: "mdi-clipboard-list",
              title: "Registro de Vacinação",
              to: "/registro/vacinacao",
            },
          ],
        },
      ]
}

const getters = {
    getMenu: state => {
        return state.menu
    },
    getDrawer: state => {
        return state.drawer
    }
}
const mutations = {
    SET_MENU(state,payload){
        state.menu.push(...payload)
    },
    SET_DRAWER(state,payload){
        state.drawer = payload
    }
}
const actions = {
    addMenu({commit},payload){
        commit('SET_MENU',payload)
    },
    setDrawer({commit},payload){
        commit("SET_DRAWER",payload)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}   
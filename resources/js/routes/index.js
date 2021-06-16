import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    {
        path:'/',
        name:'home',
        component: ()=> import('../pages/Home.vue')
    },
    {
        path:'/cadastrar/paciente',
        name:'cadPaciente',
        component: ()=> import('../pages/CadastroPaciente.vue')
    },
    {
        path:'/listar/pacientes',
        name:'listPaciente',
        component: ()=> import('../pages/ListarPacientePage.vue')
    },
    {
        path:'/listar/vacinas',
        name:'listVacina',
        component: ()=> import('../pages/ListaVacinas.vue')
    },
    {
        path:'/cadastrar/vacina',
        name:'cadVacina',
        component: ()=> import('../pages/CadastroVacina.vue')
    }

];
const router = new VueRouter({
    routes // short for `routes: routes`
  })

export default router

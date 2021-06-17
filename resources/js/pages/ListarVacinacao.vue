<template>
<RegistroVacinacao :id="this.$route.params.id"/>
</template>

<script>
import RegistroVacinacao from "../components/registroVacinacao/RegistroVacinacao";
export default {
    name: "ListarVacinacao",
    components: {RegistroVacinacao}
}
</script>

<style scoped>

</style>

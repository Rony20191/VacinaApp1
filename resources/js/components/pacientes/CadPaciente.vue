<template>
  <v-container fluid>
    <v-row dense justify="center" align="center" class="ma-4">
      <v-card width="600px">
        <v-card-title class="mt-n8">
          <v-toolbar color="primary">
            <span class="white--text">Cadastro de Paciente</span>
          </v-toolbar>
        </v-card-title>
        <v-card-text>
          <v-form lazy-validation v-model="valido" ref="formPaciente">
            <v-text-field
              v-model="paciente.nome"
              :rules="nomeRules"
              label="Nome do Paciente"
              name="nome"
              id="nome"
              placeholder="Nome do paciente"
            ></v-text-field>

            <v-text-field
              v-model="paciente.cpf"
              :rules="cpfRules"
              label="CPF"
              v-mask="paciente.cpf?'###.###.###-##':''"
              placeholder="CPF"
              name="cpf"
              id="cpf"
            ></v-text-field>

            <v-text-field
              v-model="paciente.dataNascimento"
              :rules="dataRules"
              label="Data de nascimento"
              type="date"
              name="data_nascimento"

            ></v-text-field>

          </v-form>
        </v-card-text>
        <v-card-actions class="justify-center">
          <v-btn color="primary" @click="cadastrarPaciente"> Cadastrar </v-btn>
          <v-btn outlined color="error" @click="reset"> Limpar </v-btn>
        </v-card-actions>
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "CadPaciente",
  data() {
    return {
      valido: true,
      paciente: {
        nome: "",
        cpf: "",
        dataNascimento: "",

      },
      nomeRules: [
        (v) => !!v || "Nome é obrigatório",
        (v) => v && v.length > 3 || "O nome tem que ser maior 3 caracteres",
      ],
      dataRules: [
        (v) => !!v || "Data de nascimento é obrigatório"
      ],
      cpfRules: [
        (cpf) => {
          let result = true;
          let soma;
          let resto;
          if(!cpf){
              return ''
          }

          cpf = cpf.replace(/\.|\-/g, "");
          soma = 0;
          if (cpf == "00000000000") result = false;

          for (var i = 1; i <= 9; i++)
            soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
          resto = (soma * 10) % 11;

          if (resto == 10 || resto == 11) resto = 0;
          if (resto != parseInt(cpf.substring(9, 10))) result = false;

          soma = 0;
          for (var i = 1; i <= 10; i++)
            soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
          resto = (soma * 10) % 11;

          if (resto == 10 || resto == 11) resto = 0;
          if (resto != parseInt(cpf.substring(10, 11))) result = false;

          return result || "Por favor, informe um CPF válido";
        },
      ],
    };
  },
  methods: {
    async cadastrarPaciente() {
      if (!this.$refs.formPaciente.validate()) {
        return;
      }
      try {
        await axios.post("api/paciente", this.paciente);
      } catch (error) {
        console.log(error);
       // this.$toastr.warning(error.data.errors.toString())
      }
    },
    reset(){
         this.$refs.formPaciente.reset()
        this.$refs.formPaciente.resetValidation()
    }
  },
};
</script>

<style>
</style>

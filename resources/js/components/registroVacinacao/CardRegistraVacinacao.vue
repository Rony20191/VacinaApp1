<template>
    <v-container fluid>
        <v-card >
            <v-card-title class="pt-0 mt-0 mr-0 pr-0 pl-0 ml-0">
                <v-toolbar color="error">
                    <span class="white--text">Registro das Vacinações</span>
                </v-toolbar>
            </v-card-title>
            <v-card-text>
                <v-form lazy-validation v-model="valido" ref="formVacinacao">
                    <v-text-field
                        v-model="registro.data_vacinacao"
                        type="date"
                        label="Data de vacinação"
                        placeholder="15/02/2021"
                        :rules="requiredRules"
                    />
                    <v-autocomplete
                        v-model="registro.paciente_id"
                        label="Paciente"
                        :items="pacientes"
                        :rules="requiredRules"
                    >
                        <template v-slot:item="data">
                            <v-list-item-content>
                                <v-list-item-title
                                    v-html="data.item.text"
                                ></v-list-item-title>
                                <v-list-item-subtitle
                                    v-html="data.item.cpf"
                                ></v-list-item-subtitle>
                            </v-list-item-content>
                        </template>
                    </v-autocomplete>
                    <v-autocomplete
                        v-model="registro.vacina_id"
                        label="Vacina"
                        :items="vacinas"
                        @change="addDoses()"
                        :rules="requiredRules"
                    >
                        <template v-slot:item="data">
                            <v-list-item-content>
                                <v-list-item-title>{{
                                    "Imunobiológico: " + data.item.text
                                }}</v-list-item-title>
                                <v-list-item-subtitle>{{
                                    "Fab: " +
                                        data.item.fab +
                                        " - Lote: " +
                                        data.item.lote
                                }}</v-list-item-subtitle>
                                <v-list-item-subtitle>{{
                                    "Data Validade: " + data.item.data
                                }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </template>
                    </v-autocomplete>
                    <v-autocomplete
                        v-model="registro.dose_id"
                        label="Doses"
                        :items="doses"
                        :rules="requiredRules"
                    />
                    <v-checkbox
                        label="Reincidência"
                        v-model="registro.reincidencia"
                    />
                </v-form>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-btn color="primary" @click="realizarVacinacao">
                    Realizar Vacinação
                </v-btn>
                <v-btn outlined color="error" @click="reset"> Limpar </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "CardRegistraVacinacao",
    data() {
        return {
            valido: true,
            pacientes: [],
            vacinas: [],
            doses: [],
            registro: {
                data_vacinacao: "",
                paciente_id: 0,
                vacina_id: 0,
                dose_id: 0,
                reincidencia: false
            },
            requiredRules: [v => !!v || "Esse campo é obrigatório"]
        };
    },
    methods: {
        async realizarVacinacao() {
            if (!this.$refs.formVacinacao.validate()) {
                return;
            }
            try {
                await axios.post("api/registro/vacinacao", this.registro);
                this.$swal.fire('Paciente vacinado com sucesso!!','<br/>','success').then(()=>{
                    this.$refs.formVacinacao.reset();
                })
            } catch (error) {
                if (error.response.status !=undefined && error.response.status == 400) {
                    this.$toastr.error(error.response.data.errors.toString());
                } else {
                    this.$toastr.warning(error.response.data.errors.toString());
                }
            }
        },
        reset() {
            this.$refs.formVacinacao.reset();
            this.$refs.formVacinacao.resetValidation();
        },
        async buscarVacinas() {
            try {
                const { data } = await axios.get("api/vacinas");
                for (const vacina of data.dados) {
                    this.vacinas.push({
                        text: vacina.imunobiologico,
                        fab: vacina.fabricante,
                        lote: vacina.lote,
                        data: this.formatarData(vacina.data_validade),
                        doses: vacina.doses,
                        value: vacina.id
                    });
                }
            } catch (error) {
                this.$toastr.warning(error.response.data.errors.toString());
            }
        },
        async buscarPacientes() {
            try {
                const { data } = await axios.get("api/pacientes");
                for (const paciente of data.dados) {
                    this.pacientes.push({
                        text: paciente.nome,
                        cpf: paciente.cpf,
                        value: paciente.id
                    });
                }
            } catch (error) {
                this.$toastr.warning(error.response.data.errors.toString());
            }
        },
        formatarData(data) {
            return data
                .split("-")
                .reverse()
                .join("/");
        },
        addDoses() {
            this.doses = [];
            let vacina = this.vacinas[this.registro.vacina_id - 1];
            for (const dose of vacina.doses) {
                this.doses.push({ text: dose.nome, value: dose.id });
            }
        }
    },
    mounted() {
        this.buscarPacientes();
        this.buscarVacinas();
    }
};
</script>

<style scoped></style>

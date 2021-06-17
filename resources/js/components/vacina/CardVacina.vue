<template>
    <v-container fluid>
        <v-card max-width="600px">
            <v-card-text>
                <v-form
                    v-model="valido"
                    lazy-validation
                    ref="formCadastroVacina"
                >
                    <v-text-field
                        label="Imunobilógico"
                        v-model="vacina.imunobiologico"
                        :rules="requiredRules"
                        placeholder="Imunobilógico"
                    />
                    <v-text-field
                        label="Fabricante"
                        v-model="vacina.fabricante"
                        :rules="requiredRules"
                        placeholder="Fabricante"
                    />
                    <v-text-field
                        label="Lote"
                        v-model="vacina.lote"
                        :rules="requiredRules"
                        placeholder="Lote"
                    />
                    <v-text-field
                        label="Data de Validade"
                        type="date"
                        v-model="vacina.data_validade"
                        :rules="requiredRules"
                        placeholder="Data de Validade"
                    />
                    <v-text-field
                        label="Número de Doses"
                        type="number"
                        min="1"
                        v-model="vacina.numero_doses"
                        :rules="numeroRules"
                        placeholder="Número de doses"
                    />
                    <v-text-field
                        label="Intervalo entre doses(Dias)"
                        type="number"
                        min="1"
                        v-model="vacina.intervalo_minimo"
                        :rules="numeroRules"
                        placeholder="Intervalo entre doses"
                    />
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="cadastrarVacina">
                    Cadastrar
                </v-btn>
                <v-btn outlined color="error" @click="reset"> Limpar </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "CardVacina",
    data() {
        return {
            valido: true,
            vacina: {
                imunobiologico: "",
                fabricante: "",
                lote: "",
                data_validade: "",
                numero_doses: "1",
                intervalo_minimo: "1"
            },
            requiredRules: [v => !!v || "Esse campo é obrigatório"],
            numeroRules: [
                v =>  (v && v.length > 0) || "O número deve ser maior que zero"
            ]
        };
    },
    methods: {
        async cadastrarVacina() {
            if (!this.$refs.formCadastroVacina.validate()) {
                return;
            }
            try {
                await axios.post("api/vacina", this.vacina);
                this.$refs.formCadastroVacina.reset();

               this.$swal.fire('Vacina Cadastra com sucesso!!','<br/>','success').then(()=>{
                   this.$router.push({name:'listVacina'})
               })
            } catch (error) {

                this.$toastr.warning(
                    error.response.data.errors
                        .toString()
                        .replaceAll(",", "</br>")
                );
            }
        },
        reset() {
            this.$refs.formCadastroVacina.reset();
            this.$refs.formCadastroVacina.resetValidation();
        }
    }
};
</script>

<style scoped></style>

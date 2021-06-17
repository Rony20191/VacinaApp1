<template>
    <v-container fluid>
        <v-card>
            <v-card-title class="pt-0 mt-0 mr-0 pr-0 pl-0 ml-0">
                <v-toolbar color="primary">
                    <span class="white--text">Lista dos Paciente</span>
                </v-toolbar>
            </v-card-title>
            <v-card-text>
                <v-data-table
                    :loading="table.loading"
                    :items="table.items"
                    :headers="table.headers"
                    :search="table.search"
                >
                    <template v-slot:item.cpf="{ item }">
                        <span>{{ formatarCPF(item.cpf) }}</span>
                    </template>
                    <template v-slot:item.data_nascimento="{ item }">
                        <span>{{ formartarData(item.data_nascimento) }}</span>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                            icon
                            @click="
                                $router.push({
                                    name: 'listarVacinacao',
                                    params: { id: item.id }
                                })
                            "
                            title="Registro de vacinação"
                        >
                            <v-icon>mdi-clipboard-list</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "ListPacientes",
    data() {
        return {
            table: {
                loading: false,
                headers: [
                    { text: "Id", value: "id" },
                    { text: "Nome Paciente", value: "nome" },
                    { text: "CPF", value: "cpf" },
                    { text: "Data Nascimento", value: "data_nascimento" },
                    { text: "Ações", value: "actions" }
                ],
                items: [],
                search: ""
            }
        };
    },
    methods: {
        async getPacientes() {
            try {
                this.table.loading = true;
                this.table.items = [];
                const { data } = await axios.get("api/pacientes");
                this.table.items.push(...data.dados);
            } catch (e) {
                console.log(e);
            } finally {
                this.table.loading = false;
            }
        },
        formartarData(data) {
            return data
                .split("-")
                .reverse()
                .join("/");
        },
        formatarCPF(cpf) {
            cpf = cpf.replace(/[^\d]/g, "");
            return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
        }
    },
    created() {
        this.getPacientes();
    }
};
</script>

<style scoped></style>

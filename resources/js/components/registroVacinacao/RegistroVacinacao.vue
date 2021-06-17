<template>
    <v-container fluid>
        <v-card>
            <v-card-title class="pt-0 mt-0 mr-0 pr-0 pl-0 ml-0">
                <v-toolbar color="success">
                    <span class="white--text">Registro das Vacinações</span>
                </v-toolbar>
            </v-card-title>
            <v-card-text>
                <v-data-table
                    :loading="table.loading"
                    :items="table.items"
                    :headers="table.headers"
                    :search="table.search"
                >
                    <template v-slot:item.data_validade="{ item }">
                        <span>{{ formatarData(item.data_validade) }}</span>
                    </template>
                    <template v-slot:item.data_vacinacao="{ item }">
                        <span>{{ formatarData(item.data_vacinacao) }}</span>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RegistroVacinacao",
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            table: {
                loading: false,
                headers: [
                    { text: "Imunobiolgico", value: "imunobiologico" },
                    { text: "Fabricante", value: "fabricante" },
                    { text: "Lote", value: "lote" },
                    { text: "Data Validade", value: "data_validade" },
                    { text: "Dose", value: "nome_dose" },
                    { text: "Data de Vacinação", value: "data_vacinacao" }
                ],
                items: [],
                search: ""
            }
        };
    },
    methods: {
        async getRegistro(id) {
            try {
                this.table.loading = true;
                this.table.items = [];
                const { data } = await axios.get(
                    `api/registro/vacinacao/paciente/${id}`
                );
                this.table.items.push(...data.dados);
            } catch (e) {
                console.log(e);
            } finally {
                this.table.loading = false;
            }
        },
        formatarData(data) {
            return data
                .split("-")
                .reverse()
                .join("/");
        }
    },
    created() {
        this.getRegistro(this.id);
    }
};
</script>

<style scoped></style>

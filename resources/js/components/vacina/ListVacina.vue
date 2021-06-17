<template>
    <v-container fluid>
        <v-card>
            <v-card-title class="pt-0 mt-0 mr-0 pr-0 pl-0 ml-0">
                <v-toolbar color="success">
                    <span class="white--text">Lista das Vacinas</span>
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
                </v-data-table>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "ListVacina",
    data() {
        return {
            table: {
                loading: false,
                headers: [
                    { text: "Fabricante", value: "fabricante" },
                    { text: "Lote", value: "lote" },
                    { text: "Data Validade", value: "data_validade" },
                    { text: "Número de Doses", value: "numero_doses" },
                    {
                        text: "Intervalo mínimo entre doses(Dias)",
                        value: "intervalo_minimo"
                    }
                ],
                items: [],
                search: ""
            }
        };
    },
    methods: {
        async getVacinas() {
            try {
                this.table.loading = true;
                this.table.items = [];
                const { data } = await axios.get("api/vacinas");
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
        this.getVacinas();
    }
};
</script>

<style scoped></style>

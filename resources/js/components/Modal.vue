<template>

    <v-row justify="center">
        <v-dialog
        v-model="dialog"
        persistent
        max-width="600px"   
        >
        
            <v-card>
                <v-card-title>
                    <span class="headline">Editar Despesa</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field
                        v-model="descricao"
                        :counter="10"
                        label="Descrição"
                        ></v-text-field>

                        <v-row>
                            <v-col cols="12" sm="6" md="12">
                                <v-menu
                                    ref="menu"
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :return-value.sync="date"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="date"
                                            label="Data"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                    v-model="date"
                                    no-title
                                    scrollable
                                    >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="menu = false"
                                    >
                                        Cancelar
                                    </v-btn>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="$refs.menu.save(date)"
                                    >
                                        Confirmar
                                    </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>
                        </v-row>
                        
                        <v-text-field
                        v-model="valor"
                        :counter="10"
                        label="Valor"
                        ></v-text-field>

                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                >
                    Fechar
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                >
                    Salvar
                </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
  </v-row>

</template>

<script>
export default {
    props:{
        dialog:{type: Boolean , required:true},
        data:{type: Array , required:true}
    },
    data(){
        return{
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            descricao:'',
            valor:'',
        }
    },
}
</script>

<style scoped>

</style>


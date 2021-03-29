<template>
    <v-container>
        <div class="Session-title text-center">
            <h2>Editar Pagina</h2>
        </div>
        <hr>

        <div class="form">
            <v-textarea
            outlined
            name="input-7-4"
            label="Descricao"
            v-model="descricao"
            :value="descricao"
            ></v-textarea>

            <v-text-field
            v-model="valor"
            :rules="nameRules"
            label="Valor"
            required
            ></v-text-field>

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

            <v-btn
            depressed
            color="success"
            @click="editDespesa()"
            >
            Enviar
            </v-btn>       
        </div>
    </v-container>
</template>

<script>

export default {
    data(){
        return{
            descricao: '',
            id:'',
            valor:'',
            date: new Date().toISOString().substr(0, 10)
        }
    },
    methods:{
        editDespesa(){
            axios.post('/dashboard/despesas/edit/',{
                id: this.id,
                descricao:this.descricao,
                valor:this.valor,
                data:this.date
            })
            .then((response) => {
                // console.log(response)
                this.$router.push({ name:"dashboard" , params:{item:response} })
            })
            .catch((error) => {
                console.log(error)
            });
        }
    },
    created(){
        this.descricao = this.$route.params.data.descricao
        this.id = this.$route.params.data.id
        this.date = this.$route.params.data.data
        this.valor = this.$route.params.data.valor
    }
}
</script>

<style scoped>
.Session-title h2{
    font-family:'Montserrat', sans-serif;
    font-size: 3rem;
    border-bottom: solid 3px #6a3093;
    position:relative;
    display:inline-block
}
.form{
    width:50%;
}
</style>


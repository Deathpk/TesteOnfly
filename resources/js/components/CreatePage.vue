<template>
    <v-container>
        <div class="Session-title text-center">
            <h2>Nova Despesa</h2>
        </div>
        <hr>

        <div class="form">
            <v-form v-model="valid">
                <v-textarea
                outlined
                name="input-7-4"
                label="Descricao"
                v-model="descricao"
                :rules="descricaoRules"
                :value="descricao"
                ></v-textarea>

                <v-text-field
                v-model="valor"
                :rules="valorRules"
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
                        prepend-icon="mdi-calendar"
                        v-model="computedDateFormatted"
                        label="Data"
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

                <v-file-input
                accept="image/*"
                label="Anexo"
                @change="selectFile($event)"
                ></v-file-input>

                <v-btn
                depressed
                color="success"
                :disabled="!this.valid"
                @click="createDespesa()"
                >
                Adicionar
                </v-btn>
            </v-form>       
        </div>
    </v-container>
</template>

<script>
export default {
    data(){
        return{
            valid:false,
            descricaoRules:[
                v => !!v || 'O campo descrição é Obrigatório',
                v => v.length >= 10 || 'A descrição deve conter no minimo 10 caracteres'
            ],
            valorRules:[
                v => !!v || 'O campo valor é Obrigatório',
            ],
            descricao: '',
            menu:false,
            valor:'',
            anexo:null,
            date: new Date().toISOString().substr(0, 10),
            menu: false,
        }
    },
    computed:{
        computedDateFormatted(){
            return this.formatDate(this.date)
        }
    },
    methods:{
        formatDate(date){
            if(!date) return null
            const [year, month , day] = date.split('-')
            return `${day}/${month}/${year}`
        },
        createDespesa(){
            const form = new FormData();
            form.append('anexo', this.anexo);
            form.append('descricao', this.descricao);
            form.append('valor', this.valor);
            form.append('data', this.date);

            axios.post('/dashboard/despesas/create/', form)
            .then((response) => {
                this.$router.push({ name:"dashboard" , params:{item:response} })
            })
            .catch((error) => {
                console.log(error)
            });
        },
        selectFile(event){
            this.anexo = event
        }
    },
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


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
            label="Valor"
            required
            >
            </v-text-field>

            <v-file-input
            accept="image/*"
            label="Anexo"
            @change="selectFile($event)"
            ></v-file-input>

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
                    v-model="computedDateFormatted"
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
            anexo:null,
            date: new Date().toISOString().substr(0, 10)
        }
    },
    computed:{
        computedDateFormatted(){
            return this.formatDate(this.date)
        },
    },
    methods:{
        formatDate(date){
            if(!date) return null
            const [year, month , day] = date.split('-')
            return `${day}/${month}/${year}`
        },

        selectFile(event){
            this.anexo = event
        },

        editDespesa(){
            const form = new FormData();
            form.append('id', this.id);
            form.append('anexo', this.anexo);
            form.append('descricao', this.descricao);
            form.append('valor', this.valor);
            form.append('data', this.date);

            axios.post('/dashboard/despesas/edit/',form)
            .then((response) => {
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


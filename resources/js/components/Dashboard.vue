<template>
    <v-container>
        <div class="Session-title text-center">
            <h2>Dashboard</h2>
        </div>
        <hr>
        <div class="Session-title text-center">
            <p>Listagem de Despesas</p>
        </div>
            <v-row>
                <v-dialog
                v-model="dialog"
                max-width="290"
                >
                    <v-card>
                        <v-card-title >
                            Deseja realmente deletar esta despesa?
                        </v-card-title>

                        <v-card-text>
                            Essa ação , uma vez performada , não poderá ser desfeita.
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn
                                color="green darken-1"
                                text
                                @click="dialog = false"
                            >
                                Cancelar
                            </v-btn>

                            <v-btn
                                color="red darken-1"
                                text
                                @click="deleteDespesa()"
                            >
                                Sim , Deletar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        <v-row>
            <v-col>
                <v-btn
                depressed
                color="primary"
                top
                class="novaDespesa"
                :style="{left: '50%', transform:'translateX(-50%)'}"
                @click="createDespesaForm()"
                >
                 Adicionar Despesa
                </v-btn>
                <DataTable
                @openDeleteModal="openDeleteModal($event)"/>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import DataTable from './DataTable'
import Swal from 'sweetalert2'
export default {
    components:{DataTable},
    data(){
        return{
            dialog:false,
            currentDespesaSelected: null,
        }
    },
    methods:{
        openDeleteModal(id){
            this.currentDespesaSelected = id
            this.dialog = true
        },
        createDespesaForm(){
            this.$router.push({ name:"createForm"})
        },
        deleteDespesa(){
            this.dialog = false
            axios.post('/dashboard/despesa/delete/',{
                id: this.currentDespesaSelected,
            })
            .then((response) => {
                this.currentDespesaSelected = null
                this.$router.go({ params:{item: response} })
            })
            .catch((error) => {
                console.log(error)
                this.currentDespesaSelected = null
            });
        },
    },
    created(){
        if( this.$route.params.item && this.$route.params.item.data.error ){
            Swal.fire({
                title: 'Oops , ocorreu um erro!',
                text: this.$route.params.item.data.message,
                icon: 'error',
                confirmButtonText: 'Confirmar'
            })
        }
        else if( this.$route.params.item && !this.$route.params.item.data.error ){
            Swal.fire({
                title: 'Sucesso!',
                text: this.$route.params.item.data.message,
                icon: 'success',
                confirmButtonText: 'Confirmar'
            })
        }
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
.Session-title p{
    font-family:'Montserrat', sans-serif;
    font-size: 2rem;
    /* border-bottom: solid 3px #6a3093; */
    position:relative;
    display:inline-block
}
.novaDespesa{
    margin-bottom: 1rem;
}
</style>


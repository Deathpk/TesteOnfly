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
            <v-col>
                <DataTable/>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import DataTable from './DataTable'
export default {
    components:{DataTable},
    data(){
        return{

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
</style>


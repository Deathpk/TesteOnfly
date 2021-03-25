<template>
    <v-simple-table dark>
        <template v-slot:default>
          
        <thead>
            <tr>

            <th class="text-left">
                # ID
            </th>
            <th class="text-left">
                Descrição
            </th>
            <th class="text-left">
                Data
            </th>
            <th class="text-left">
                Valor
            </th>
            <th class="text-left">
                Ações
            </th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="despesa in despesas"
            :key="despesa.id"
            >
            <td>{{ despesa.id }}</td>
            <td>{{ despesa.descricao }}</td>
            <td>{{ despesa.data }}</td>
            <td>$ {{ despesa.valor }}</td>
            <td>
                <form method="POST" @submit.prevent="editDespesa()">
                    <v-btn
                    depressed
                    color="primary"
                    type="submit"
                    >
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                    </svg>
                    </v-btn>
                </form>    

                <v-btn
                depressed
                color="success"
                >
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7,5H21V7H7V5M7,13V11H21V13H7M4,4.5A1.5,1.5 0 0,1 5.5,6A1.5,1.5 0 0,1 4,7.5A1.5,1.5 0 0,1 2.5,6A1.5,1.5 0 0,1 4,4.5M4,10.5A1.5,1.5 0 0,1 5.5,12A1.5,1.5 0 0,1 4,13.5A1.5,1.5 0 0,1 2.5,12A1.5,1.5 0 0,1 4,10.5M7,19V17H21V19H7M4,16.5A1.5,1.5 0 0,1 5.5,18A1.5,1.5 0 0,1 4,19.5A1.5,1.5 0 0,1 2.5,18A1.5,1.5 0 0,1 4,16.5Z" />
                </svg>
                </v-btn>

                <v-btn
                depressed
                color="error"
                >
                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M21 7H3V3H21V7M13 19C13 19.7 13.13 20.37 13.35 21H4V8H20V13.09C19.67 13.04 19.34 13 19 13C15.69 13 13 15.69 13 19M15 13V11.5C15 11.22 14.78 11 14.5 11H9.5C9.22 11 9 11.22 9 11.5V13H15M22.54 16.88L21.12 15.47L19 17.59L16.88 15.47L15.47 16.88L17.59 19L15.47 21.12L16.88 22.54L19 20.41L21.12 22.54L22.54 21.12L20.41 19L22.54 16.88Z" />
                </svg>
                </v-btn>
            </td>
            
            </tr>
        </tbody>
        </template>
  </v-simple-table>
</template>

<script>
import axios from 'axios';
export default {
  data(){
    return{
      despesas:[]
    }
  },
  methods:{
    // editDespesa(despesa){
    //   axios.post('/task/'+ task, {
    //     id: task
    //   })
    //  .then((response) => { 
    //   console.log(response)
    //   this.teste = response.data
    //   console.log(this.batata)
    //  })
    //  .catch((error) => {
    //   console.log(error);
    //  });
    // },
    getAllDespesas(){
      axios.get('/dashboard/despesas')
      .then((response) => {
        this.despesas = response.data 
        console.log(response)
      })
      .catch((error) => {
          console.log(error);
      })
    },
  },
  created(){
      this.getAllDespesas();
  }
}
</script>

<style scoped>

</style>


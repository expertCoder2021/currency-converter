<template>
  <div class="container">
      <h2>Base Currency</h2>
      <router-link to="/">Go Home</router-link>
      <div>
        <p>Base Curreny</p>
        <select @change="selected($event)">
          <option v-for="cur in list" :key="cur.id" :value="cur.attr_id" :selected="cur.char_code == 'USD'">{{cur.char_code}}</option>
        </select>
      </div>
      <div>
        <table class="table">
          <thead>
            <th>Currency ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Nominal</th>
            <th>Num Code</th>
            <th>Value</th>
            <th>Date</th>
          </thead>
          <tbody>
            <tr v-for="item in info" :key="item.id">
              <td>{{item.attr_id}}</td>
              <td>{{item.name}}</td>
              <td>{{item.char_code}}</td>
              <td>{{item.nominal}}</td>
              <td>{{item.num_code}}</td>
              <td>{{item.value}}</td>
              <td>{{item.date}}</td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>

<script>

export default {
  name: 'baseCurrency',
  data () {
    return {
      info: {},
      list:{},
      base_currency:'USD'
    }
  },
  methods : {
    selected(e){
      let cur_id = e.target.value;
      this.$http.post(window.baseUrl+'/api/auth/currencyExchangeRate',{id:cur_id})
      .then(response => {
        this.info = response.data;
      });


    },
    getCurrencyList(){
      this.$http.get(window.baseUrl+'/api/auth/getCurrencyList')
      .then(response => {
        this.list = response.data;
      });
    }
  },
  mounted () {
    this.getCurrencyList();

    // var id = this.$route.params.id;
    // this.$http.get(window.baseUrl+'/api/auth/currencySingleHistory/'+id)
    //   .then(response => {
    //     this.info = response.data;
    // });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

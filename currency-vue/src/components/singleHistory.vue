<template>
  <div>
      <h2>Currency List</h2>
      <router-link to="/listCurrency">Go Back</router-link>
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
  name: 'singleHistory',
  data () {
    return {
      info: {},
    }
  },
 
  mounted () {
    var id = this.$route.params.id;
    this.$http.get(window.baseUrl+'/api/auth/currencySingleHistory/'+id)
      .then(response => {
        this.info = response.data;
      });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

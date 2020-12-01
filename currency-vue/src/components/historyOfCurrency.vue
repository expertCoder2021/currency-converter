<template>
  <div class="container">
      <h2>History Of Currency</h2>
      <router-link to="/">Home</router-link>
      <div>
        <form @submit.prevent="getList()">
          <label>Page</label>
          <input v-model="page" name="page" type="text" placeholder="Enter page no.">
          <label>Page Size</label>
          <input v-model="page_size" name="page_size" type="text" placeholder="Enter page size">
          <label>Date from</label>
          <input v-model="from" name="from" type="date">
          <label>Date to</label>
          <input v-model="to" name="to" type="date">
          <br>
          <input type="submit" name="Submit">
        </form>
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
            <tr v-for="item in info" :key="item.id" class='clickable-row' :data-id="item.attr_id">
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
  name: 'historyOfCurrency',
  data () {
    return {
      info: {},
      page: 1,
      page_size: 3,
      from:null,
      to:null
    }
  },
  updated(){
    window.$(".clickable-row").click(function() {
      console.log(window.$(this).data("id"));
      var id = window.$(this).data("id");
        window.location = window.appUrl+"singleHistory/"+id;
    });

  },
  methods : {
    getList(){
      this.$http
      .post(window.baseUrl+'/api/auth/historyOfCurrency',{page:this.page,page_size:this.page_size,from:this.from,to:this.to})
      .then(response => {
        this.info = response.data;
      })
    }
  },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.clickable-row{
  cursor: pointer;
}
.clickable-row:hover{
  background: lightgrey;
}
</style>

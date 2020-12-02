<template>
  <div class="container">
      <h2>PHP/Laravel/Vue - Full Stack Web Developer Test</h2>
      <div class="row">
        <div class="col-lg-6">
          <h4>Currency Data</h4>
          <router-link to="/listCurrency">List Of Currency</router-link>
          <router-link to="/historyOfCurrency"> | History Of Currency</router-link>
        </div>
        <div class="col-lg-6">
          <h4>Advanced requirements</h4>
          <router-link to="/baseCurrency"> Base Currency</router-link>
          <router-link to="/line"> | Line Chart</router-link>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'index',
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

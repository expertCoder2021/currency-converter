<template>
  <div id="app">
<!--    <img alt="Vue logo" src="./assets/logo.png">-->
    <Header></Header>
    <router-view></router-view>
    <Footer></Footer>
<!--    <router-link to='/'>Home</router-link> | -->
<!--    <router-link to='/ijaz'>Ijaz</router-link>-->
  </div>
</template>

<script>
import Header from '@/components/Header/Header';
import Footer from "@/components/Footer/Footer";
export default {
  name: 'App',
  components: {
    Header,
    Footer
  }
}
</script>


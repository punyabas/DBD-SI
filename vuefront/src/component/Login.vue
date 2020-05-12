<template>
  <!-- <div class="centered">
    <vs-row vs-type="flex" vs-justify="center" vs-align="center" style="flex-direction:column;margin-bottom:20px">
      <h1>I-Check</h1>
      <span>Ijasah Check</span>
    </vs-row>
    <vs-row vs-type='flex' vs-justify='flex-end' class="login-admin" style="margin-bottom:15px;flex-flow:column wrap">
      <vs-input class="inputx" placeholder="email" v-model="value1" style="margin-bottom:5px;width:100%"/>
      <vs-button color="primary" type="filled" v-on:click="loginadmin">Login admin</vs-button>
    </vs-row>
    <vs-row vs-type='flex' vs-justify='flex-end'  class="login-mhs" style="flex-flow:column wrap">
      <vs-input class="inputx" placeholder="nim" v-model="value2" style="margin-bottom:5px;width:100%"/>
      <vs-button color="primary" type="filled" v-on:click="loginalumni">Login alumni</vs-button>
    </vs-row>
  </div> -->
  <vs-row  vs-w="12" vs-align="center" vs-justify="center" style="margin-top:100px; flex-wrap:wrap-reverse">
    <vs-col vs-offset="1" vs-type="flex" vs-justify="center" vs-lg="5" vs-sm="5" vs-xs="12" style="flex-direction:column"  id="login-head">
      <vs-col vs-type="flex" vs-justify="flex-start" vs-lg="12" vs-sm="8" vs-xs="12" style="flex-flow:column wrap">
        <h1>Login Sistem Informasi Demam Berdarah Dengue</h1>
        <span>Masuk untuk mengedit data</span>
        <!-- <vs-col vs-lg="6" vs-sm="6" vs-xs="12">
          <vs-divider></vs-divider>
          <vs-button>Masuk SSO UGM</vs-button>
        </vs-col> -->
      </vs-col>
      <vs-col vs-type='flex' vs-justify='flex-start' class="login-admin" style="margin:15px 0px;flex-flow:column wrap;">
        <vs-input style="margin:10px" class="inputx trial" placeholder="username" v-model="value1"/>
        <vs-input style="margin:10px" class="inputx trial" placeholder="password" v-model="value2"/>
        <vs-button size="small" v-on:click="login" style="margin:10px; max-width:100px">Login</vs-button>
      </vs-col>
    </vs-col>
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-lg="6" vs-sm="6" vs-xs="12">
      <img src="/DBD-SI/assets/img/hos.png" alt="" class="img-teknik-lg img-teknik-xs img-teknik-sm">
    </vs-col>
  </vs-row>
</template>

<script>
import axios from 'axios'


export default {
  data() {
    return {
      value1:'',
      value2:'',
      //siterul:'',
    }
  },

  methods: {

  login: function() {
  axios.post('/DBD-SI/index.php/login/login', {
  username: this.value1,
  password_user: this.value2
  })
  .then( (response)=> {
    console.log(response);
    if(response.data.Data1.Posisi=='0'){
    this.$router.push({name:'dirjen'})
    }
    else{
    this.$router.push({name:'rs'})  
    }
  })
  .catch(function (error) {
    console.log(error.response)

  });
  }
  },
  beforeCreate() {
   axios.get('/DBD-SI/index.php/login/checkposisi')
  .then( (response)=> {
    var posisi = response.data.Data;
    console.log(response);
  if( posisi=='0'){
      this.$router.push({ name: 'dirjen'})
   }
   if( posisi=='1'){
       this.$router.push({ name: 'rs'})
   }
  })
  .catch(function (error) {
    console.log(error);
  });

},


  
}
</script>
<template lang="html">
<div>
<vs-row vs-w="12"vs-align="center" vs-justify="center" class="ijasah" style="flex-direction:row;margin:10px;">

<h3>Data Penanganan Penyakit DBD</h3>

<vs-button  v-on:click="logout();" style="position: absolute; top: 0px; right: 30px;" color="#11C117" > Logout </vs-button>
</vs-row>
 <vs-row vs-w="12"  vs-align="center" vs-justify="center" class="ijasah" style="flex-direction:column;">
     <vs-col vs-type="flex" vs-justify="center" vs-lg="4" vs-sm="4" vs-xs="4">
  <div class="">
      
    <vs-tabs alignment="center" >
      <vs-tab label="Perbarui Data" style="max-width=600px;">
        <vs-row vs-w="6"> 
        <div class="con-tab-ejemplo" style="max-width=600px;">
         <div>
    <vs-table
        search
      v-model="selected"
      
      :data="RumahSakits">
      <template slot="header">
        <h3>
          Data Rumah Sakit
        </h3>
      </template>
      <template slot="thead">
        <vs-th>
          Nama
        </vs-th>
        <vs-th>
          Nomor Telepon
        </vs-th>
        <vs-th>
          Email
        </vs-th>
        <vs-th>
          Alamat
        </vs-th>
        <vs-th>
          Kode Kabupaten
        </vs-th>
         <vs-th>
          Latitude
        </vs-th>
         <vs-th>
          Longitude
        </vs-th>
      </template>

      <template slot-scope="{data}">
        <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
          <vs-td :data="data[indextr].name_rs">
               <vs-input v-if="update==data[indextr].id_rs" style=" max-width: 100px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].name_rs"/>
                <p v-else  > {{data[indextr].name_rs}}</p>
               
          </vs-td>

          <vs-td :data="data[indextr].handphone_rs">
               <vs-input  v-if="update==data[indextr].id_rs" style=" max-width: 100px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].handphone_rs"/>  
                <p  v-else > {{data[indextr].handphone_rs}}</p>
                
          </vs-td>

          <vs-td :data="data[indextr].email_rs">
              <vs-input v-if="update==data[indextr].id_rs" style=" max-width: 200px!important;"  class="inputrs" placeholder="Disabled" v-model="data[indextr].email_rs"/>
              <p  v-else > {{data[indextr].email_rs}}</p>
                
          </vs-td>

          <vs-td :data="data[indextr].address_rs">
                <vs-input  v-if="update==data[indextr].id_rs" style=" max-width: 200px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].address_rs"/>
              <p v-else > {{data[indextr].address_rs}}</p>
              
          </vs-td>
          <vs-td :data="data[indextr].region_rs">
                <vs-input  v-if="update==data[indextr].id_rs" style=" max-width: 50px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].region_rs"/>
              <p v-else > {{data[indextr].region_rs}}</p>
              
          </vs-td>
          <vs-td :data="data[indextr].lat_rs">
                <vs-input  v-if="update==data[indextr].id_rs" style=" max-width: 100px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].lat_rs"/>
              <p v-else > {{data[indextr].lat_rs}}</p>
              
          </vs-td>
          <vs-td :data="data[indextr].lon_rs">
                <vs-input  v-if="update==data[indextr].id_rs" style=" max-width: 100px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].lon_rs"/>
              <p v-else > {{data[indextr].lon_rs}}</p>
              
          </vs-td>
          <vs-td :data="data[indextr].id_rs">
            <vs-button  v-if="update==data[indextr].id_rs" color="#11C117" v-on:click="saved();"> save </vs-button>
            <vs-button v-else color="#11C117" v-on:click="updated(data[indextr].id_rs);"> update </vs-button>
            <!-- <vs-button color="#11C117" v-on:click="updated(data[indextr].id);"> update </vs-button> -->
          </vs-td>
        </vs-tr>
      </template>
    </vs-table>
   <!-- <pre> {{ update}}</pre>
    <pre>{{ selected }}</pre> -->
</div>
        </div>
          </vs-row>
      </vs-tab>
      <vs-tab label="Masukkan Data Baru" style="max-width=600px;">
        <div class="con-tab-ejemplo" style="max-width=600px;">
      <vs-input class="inputx" v-model="kode_rs"  placeholder="kode rumah sakit" label="kode rumah sakit" /> 
      <vs-input class="inputx" v-model="name_rs"  placeholder="nama rumah sakit" label="nama rumah sakit" /> 
      <vs-input class="inputx" v-model="email_rs" placeholder="email rumah sakit" label="email rumah sakit" />
      <vs-input class="inputx" v-model="handphone_rs" placeholder="telepon rumah sakit" label=" telepon rumah sakit"/> 
      <vs-input class="inputx" v-model="address_rs" placeholder="alamat rumah sakit" label=" alamat rumah sakit" />
      <vs-input class="inputx" v-model="region_rs" placeholder="kode kabupaten" label="kode kabupaten"  /> 
      <vs-input class="inputx" v-model="lat_rs" placeholder="latitude" label="latitude" />
      <vs-input class="inputx" v-model="lon_rs" placeholder="longitude" label="longitude" />
      <vs-button v-on:click="saveone();" color="#11C117"> simpan </vs-button>
        <vs-button @click="popupActivo=true" color="primary" type="border">Import</vs-button>
    <vs-popup class="holamundo"  title="Import RS" :active.sync="popupActivo">
       <label>File
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
      </label>
        <button v-on:click="ImportRS()">Submit</button>
     <!-- <div class="centerx">
    <vs-upload action="importrs()"  />
     </div> -->
    </vs-popup>
        </div>
      </vs-tab>
    </vs-tabs>
  </div>
  </vs-col>
 </vs-row>
</div>
</template>




<script>
import axios from 'axios'
export default {
  data(){
      return{
    selected:[],
     popupActivo:false,
    update:'',
    RumahSakits:[],
    name_rs: '',  
    email_rs :  '',
    handphone_rs:  '',
    address_rs:  '',
    region_rs: '',
    lat_rs: '',
    lon_rs: '',
    kode_rs: '',
    file: ''
  }
  },
   methods: {
    //    handleSelected(tr) {
    //   this.$vs.notify({
    //     title:`Selected ${tr.username}`,
    //     text:`Email: ${tr.email}`
    //   })
    // },
    //   doubleSelection(tr) {
    //   this.$vs.notify({
    //     title:`Double Selection ${tr.username}`,
    //     text:`Email: ${tr.email}`,
    //     color: 'success'
    //   })
    // },
    
    updated(a) {
      this.update = a;
    },
    saved(a) {
      axios.post('/DBD-SI/index.php/RumahSakit/updaters', {
      id_rs : this.selected.id_rs,
      name_rs : this.selected.name_rs,  
      email_rs  :  this.selected.email_rs,
      handphone_rs  :  this.selected.handphone_rs,
      address_rs :  this.selected.address_rs,
      region_rs : this.selected.region_rs,
      lat_rs : this.selected.lat_rs,
      lon_rs: this.selected.lon_rs 
      })
      .then( (response)=> {
        this.getRSAll();
      })
      .catch(function (error) {
        console.log(error.response.data);
      });
      this.update = '';
    },

    saveone(){
      axios.post('/DBD-SI/index.php/User/saveuser', {
      username : this.email_rs,
      password_user : this.kode_rs,  
      role_user  :  '0'
      })
      .then( (response)=> {
        this.savetwo(response.data.Data);
      })
      .catch(function (error) {
        console.log(error.response.data);
      });
    },
    savetwo($data){
      axios.post('/DBD-SI/index.php/RumahSakit/savers', {
      id_user : $data.id_user,
      name_rs : this.name_rs,  
      email_rs  :  this.email_rs,
      handphone_rs  :  this.handphone_rs,
      address_rs :  this.address_rs,
      region_rs : this.region_rs,
      lat_rs : this.lat_rs,
      lon_rs: this.lon_rs 
      })
      .then( (response)=> {
        this.getRSAll();
      })
      .catch(function (error) {
        console.log(error.response.data);
      });
      this.update = '';
    },

     handleFileUpload(){
    this.file = this.$refs.file.files[0];
  },

     ImportRS: function(){
        /*
                Initialize the form data
            */
            let formData = new FormData();

            /*
                Add the form data we need to submit
            */
            formData.append('rumah_sakit', this.file);

        /*
          Make the request to the POST /single-file URL
        */
            axios.post( '/DBD-SI/index.php/ImportRS/importRS',
                formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              },
                this.$vs.loading({color:'#7d0c3f'})
            ) 
            .then((response)=>{
               this.$vs.loading.close();
               console.log(response.data);
              //this.berhasil(response.data.Data);
              this.popupActivo=false;
              this.getRSAll();
      })
      .catch(function (error) {
         this.$vs.loading.close();
          console.log(response.data);
          this.popupActivo=false;
          this.getRSAll();
         //this.gagal(error.response.data.Error);
      });
      },

    getRSAll() { 
      axios.get('/DBD-SI/index.php/RumahSakit/getRSAll')
      .then((response) =>  {
      
        this.RumahSakits = response.data.Data;
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    
    logout: function() {
  axios.post('/DBD-SI/index.php/login/logout')
  .then( (response)=> {
    console.log(response)
    this.$router.push({name:'login'})
  })
  .catch(function (error) {
    console.log(error.response)

  });
  }
   },

   created(){
   this.getRSAll();
   //this.getToken();
  },

  beforeCreate() {

   axios.get('/DBD-SI/index.php/login/checkposisi')
  .then( (response)=> {
    var posisi = response.data.Data
     if( posisi!=='0'){
       this.$router.push({ name: 'login'})
   }
  })
  .catch(function (error) {
  });
  }

}
</script>
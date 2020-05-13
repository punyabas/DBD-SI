<template lang="html">
  <div>
    <vs-row vs-w="12"vs-align="center" vs-justify="center" class="ijasah" style="flex-direction:row;margin:10px;">
      <h3>Data Penanganan Penyakit DBD</h3>
      <vs-button  color="danger" type="flat" v-on:click="logout();" 
        style="position: absolute; top: 10px; right: 10px;"> 
        Logout 
      </vs-button>
    </vs-row>

    <vs-row vs-w="12"  vs-align="center" vs-justify="center" class="ijasah" style="flex-direction:column;">
      <vs-col vs-type="flex" vs-justify="center" vs-lg="12" vs-sm="12" vs-xs="12">
        <vs-tabs alignment="fixed" >
          <vs-tab label="Perbarui Data">
            <vs-row vs-w="12"> 
              <div class="con-tab-ejemplo" style="width:80%; margin:auto;">
                <div>
                  <vs-table search v-model="selected" :data="Cases">
                    <template slot="header">
                      <h3>
                        Data Kasus
                      </h3>
                    </template>
                    <template slot="thead">
                      <vs-th>
                        Nomor Rekam Medis
                      </vs-th>
                      <vs-th>
                        Umur
                      </vs-th>
                      <vs-th>
                        Gender
                      </vs-th>
                      <vs-th>
                        Status
                      </vs-th>
                    </template>

                    <template slot-scope="{data}">
                      <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data" >
                        <vs-td :data="data[indextr].record_case">
                            <vs-input v-if="update==data[indextr].id_case" style=" max-width: 200px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].record_case"/>
                              <p v-else  > {{data[indextr].record_case}}</p>
                            
                        </vs-td>

                        <vs-td :data="data[indextr].age_case">
                            <vs-input  v-if="update==data[indextr].id_case" style=" max-width: 75px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].age_case"/>  
                            <p  v-else > {{ data[indextr].age_case}}</p>
                              
                        </vs-td>

                        <vs-td :data="data[indextr].gender_case">
                            <vs-select style=" max-width: 100px!important;"  v-if="update==data[indextr].id_case" 
                            class="selectExample"
                            v-model="selected.gender_case"
                            >
                            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options1" />
                            </vs-select>
                            <!-- <vs-input  v-if="update==data[indextr].id_case" style=" max-width: 100px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].gender_case"/>   -->
                            <p  v-else > {{ genders[data[indextr].gender_case]}}</p>
                              
                        </vs-td>

                        <vs-td :data="data[indextr].status_case">
                            <vs-select style=" max-width: 100px!important;"  v-if="update==data[indextr].id_case" 
                            class="selectExample"
                            v-model="selected.status_case"
                            >
                            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options2" />
                            </vs-select>
                            <!-- <vs-input  v-if="update==data[indextr].id_case" style=" max-width: 200px!important;" class="inputrs" placeholder="Disabled" v-model="data[indextr].status_case"/> -->
                            <p v-else > {{statuses[data[indextr].status_case]}}</p>
                            
                        </vs-td>
                        <vs-td :data="data[indextr].id_case">
                          <vs-button  v-if="update==data[indextr].id_case" color="success" v-on:click="saved();" style="width:10vh;"> save </vs-button>
                          <vs-button v-else color="success" type="flat" v-on:click="updated(data[indextr].id_case);" style="width:10vh;"> update </vs-button>
                          <!-- <vs-button color="#11C117" v-on:click="updated(data[indextr].id);"> update </vs-button> -->
                        </vs-td>
                      </vs-tr>
                    </template>
                  </vs-table>
                </div>
                <div>
                  <vs-button style="width:100%" v-on:click="rekap();" color="success" > Rekap </vs-button>
                </div>
              </div>
            </vs-row>
          </vs-tab>

          <vs-tab label="Masukkan Data Baru" alignment="fixed">
            <div class="con-tab-ejemplo">
              <vs-input class="inputx" v-model="record_case"  placeholder="Nomor rekam medis" label="Nomor rekam medis" style="width:500px; margin:auto;" /> 
              <vs-select style="width:500px; margin:auto;"
                class="selectExample" v-model="gender_case" label="Gender Kasus" >
                <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options1" />
              </vs-select>
              <vs-input class="inputx" v-model="age_case" placeholder="Umur pasien" label="umur pasien" style="width:500px; margin:auto;" />
              <br>
              <div style="text-align:center;">
                <vs-button @click="popupActivo=true" color="primary" type="border" style="width:15vh;">Import</vs-button>
                <vs-button v-on:click="saveone();" color="success" style="width:20vh;" > simpan </vs-button>
                <vs-popup class="holamundo"  title="Import Kasus" :active.sync="popupActivo">
                  <label>File
                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                  </label>
                  <button v-on:click="ImportCase()">Submit</button>
                  <div class="centerx">
                  </div>
                </vs-popup> 
              </div>

            </div>
          </vs-tab>
        </vs-tabs>
      </vs-col>
    </vs-row>
  </div>
</template>




<script>
import axios from 'axios'
export default {
  data(){
      return{
        genders : {0: "Laki-laki", 1: "Perempuan"},
        statuses : {0: "Sakit", 1: "Sembuh", 2:"Meninggal"},
    selected:[],
    popupActivo:false,
    update:'',
    Cases:[],
    record_case : '' ,
    age_case : '',  
      gender_case   : '',
    file: '',
    options1:[
        {text: 'Laki-laki', value: '0'},
        {text: 'Perempuan', value: '1'}
    ],
     options2:[
        {text: 'Sakit', value: '0'},
        {text: 'Sembuh', value: '1'},
        {text: 'Meninggal', value: '2'}
    ]
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
      axios.post('/DBD-SI/index.php/Kasus/updateCase', {
      id_case: this.selected.id_case,
      record_case: this.selected.record_case,
      age_case: this.selected.age_case,
      gender_case :this.selected.gender_case,
      status_case : this.selected.status_case
    
      })
      .then( (response)=> {
        this.getCaseAll();
      })
      .catch(function (error) {
        console.log(error);
      });
      this.update = '';
    },

    rekap(){
      this.rekapsakit();
      this.rekapsembuh();
      this.rekapdie();
    },
    rekapsakit(){
        axios.post('/DBD-SI/index.php/Rekap/recapSakit')
      .then( (response)=> {
          console.log(response.data);
          this.getCaseAll();
      })
      .catch(function (error) {
        console.log(error.response.data);
        this.getCaseAll();
      });
    },
    rekapsembuh(){
      axios.post('/DBD-SI/index.php/Rekap/recapSembuh')
      .then( (response)=> {
          console.log(response.data);
          this.getCaseAll();
      })
      .catch(function (error) {
        console.log(error.response.data);
        this.getCaseAll();
      })
    },
    rekapdie(){
      axios.post('/DBD-SI/index.php/Rekap/recapDie')
      .then( (response)=> {
          console.log(response.data);
          this.getCaseAll();
      })
      .catch(function (error) {
        console.log(error.response.data);
        this.getCaseAll();
      })
    },  
    saveone(){
      axios.post('/DBD-SI/index.php/Kasus/saveCase', {
      record_case :  this.record_case,
      //id_rs : this.id_rs, 
      age_case : this.age_case,  
      gender_case   : this.gender_case,
      })
      .then( (response)=> {
          console.log(response.data);
          this.getCaseAll();
      })
      .catch(function (error) {
        console.log(error.response.data);
        this.getCaseAll();
      });
    },

     handleFileUpload(){
    this.file = this.$refs.file.files[0];
  },

     ImportCase: function(){
        /*
                Initialize the form data
            */
            let formData = new FormData();

            /*
                Add the form data we need to submit
            */
            formData.append('kasus', this.file);

        /*
          Make the request to the POST /single-file URL
        */
            axios.post( '/DBD-SI/index.php/Kasus/importcase',
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
              this.getCaseAll();
      })
      .catch(function (error) {
         this.$vs.loading.close();
          console.log(response.data);
          this.popupActivo=false;
          this.getCaseAll();
         //this.gagal(error.response.data.Error);
      });
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
  },

    getCaseAll() { 
      axios.get('/DBD-SI/index.php/Kasus/getCaseRS')
      .then((response) =>  {
      
        this.Cases = response.data.Data;
      })
      .catch(function (error) {
        console.log(error);
      })
    } 
   },

   created(){
   this.getCaseAll();
   //this.getToken();
  },
  beforeCreate() {

   axios.get('/DBD-SI/index.php/login/checkposisi')
  .then( (response)=> {
    var posisi = response.data.Data
     if( posisi!=='1'){
       this.$router.push({ name: 'login'})
   }
  })
  .catch(function (error) {
  });
  }

}
</script>
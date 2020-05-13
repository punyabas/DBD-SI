<template>

<div>
  <br>
<!-- header -->
  <vs-row vs-w="12" vs-justify="center" vs-align="center" tyle="flex-direction:column;"> 
    <vs-col  vs-type="flex" vs-justify="center"  vs-align="center" vs-lg="8" 
      vs-sm="12" vs-xs="12" style="flex-direction:column">
      <h2>Layanan Cek Informasi Persebaran Penyakit DBD</h2>
      <h3>di Indonesia</h3> 
      <br>

<!-- pilih kabupaten -->
      <br><vs-row  vs-justify="center" vs-align="center">
        <vs-select class="selectExample" v-model="kabs"  width="70%" style="padding-right:10px">
          <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in kabupaten" />
        </vs-select>
        <vs-button  v-on:click="Changedata" color="primary" type="border" style="width:10%;">Periksa</vs-button>
      </vs-row>
    <br>

 <!-- data -->
      <br><vs-row vs-justify="space-around">
        <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" style="padding-left:10px">
          <vs-card>
            <div slot="header">
              <h4 style="text-align: center;">Kasus Aktif</h4>
              <svg width="100%" height="5px">
                <rect width="100%" style="fill:#F6C880;" />
              </svg>
            </div>
            <div>
              <br>
              <h2 style="text-align: center;">{{ActiveCases}}</h2>
              <br>
            </div>
          </vs-card>
        </vs-col>

        <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" style="padding-left:10px">
          <vs-card>
            <div slot="header">
              <h4 style="text-align: center;"> Fatality Rate </h4>
              <svg width="100%" height="5px">
                <rect width="100%" style="fill:#F96854;" />
              </svg>
            </div>
            <div>
              <br>
              <h2 style="text-align: center;">{{FatalityRate}}</h2>
              <br>
            </div>
          </vs-card>
        </vs-col>

        <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" style="padding-left:10px">
          <vs-card>
            <div slot="header">
              <h4 style="text-align: center;"> Incidence Rate </h4>
              <svg width="100%" height="5px">
                <rect width="100%" style="fill:#5B3CC4;" />
              </svg>
            </div>
            <div>
              <br>
              <h2 style="text-align: center;">{{IncidenceRate}}</h2>
              <br>
            </div>
          </vs-card>
        </vs-col>
      </vs-row>
    </vs-col>
  </vs-row> <br>

<!-- Map -->
  <br><h3 style="text-align: center;" >Peta persebaran Kasus DBD</h3>
  <div class="map">
    <div style="height: 400px; width: 90%; margin:auto;" >
      <l-map :zoom="zoom" :center="center">
        <l-marker v-for="marker in markers" @click="onMarkerClick(marker)" :key="marker.name" :lat-lng="marker.cor">
          <!-- <l-popup :content="marker.sum"></l-popup> -->
        </l-marker>
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
      </l-map>
    </div>
  </div>
  <br>

<!-- Grafik  -->
  <br><h3 style="text-align: center;" >Grafik Kasus DBD</h3>
  <vs-row vs-w="12" style="flex-direction:column;"> 
    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="6" vs-offset="3">
      <div class="small">
        <line-chart :chart-data="datacollection" width="1000vh"  ></line-chart>
        <!-- <button @click="fillData()">Randomize</button> -->
      </div>
    </vs-col>
  </vs-row >
  <br>

<!-- langkah preventif -->
  <vs-row vs-justify="center">
    <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="8">
      <div>
        <br><h3 style="text-align:center;"> Langkah Awal Pencegahan</h3> <br>
        <h5><strong>Menurut Kementrian Kesehatan</strong>, pencegahan demam berdarah yang paling efektif dan
          efisien sampai saat ini adalah kegiatan Pemberantasan Sarang Nyamuk (PSN) dengan cara 3M Plus. 
          3M yang dimaksud dalam PSN yaitu,
        </h5>
      </div>
    </vs-col>
  </vs-row> <br>
  <div>
    <vs-row vs-justify="space-around" vs-w="9" style="margin:auto;">
      <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" style="padding-right:5px">
        <vs-card>
          <div slot="media">
            <img src="../img/cuci.png">
          </div>
            <hr><h4 style="text-align: center;">Menguras dan menyikat</h4>
            <div class="centerx" style="text-align: center;">
              <vs-button @click="popupActivo=true" color="primary" type="border" >Pehami Lebih Lanjut</vs-button>
              <vs-popup class="holamundo"  title="Menguras dan menyikat" :active.sync="popupActivo">
                <p>
                  Menguras, merupakan kegiatan membersihkan/menguras tempat yang sering menjadi penampungan
                  air seperti bak mandi, kendi, toren air, drum dan tempat penampungan air lainnya. Dinding
                  bak maupun penampungan air juga harus digosok untuk membersihkan dan membuang telur nyamuk
                  yang menempel erat pada dinding tersebut. Saat musim hujan maupun pancaroba, kegiatan ini
                  harus dilakukan setiap hari untuk memutus siklus hidup nyamuk yang dapat bertahan di tempat
                  kering selama 6 bulan.
                </p>
              </vs-popup>
            </div>
        </vs-card>
      </vs-col>

      <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" style="padding-left:10px">
        <vs-card>
          <div slot="media">
            <img src="../img/tutup.png">
          </div>
            <hr><h4 style="text-align: center;">Menutup penampungan air</h4>
            <div class="centerx" style="text-align: center;">
              <vs-button @click="popupActivo1=true" color="primary" type="border" >Pehami Lebih Lanjut</vs-button>
              <vs-popup class="holamundo"  title="Menutup penampungan air" :active.sync="popupActivo1">
                <p>
                  Menutup, merupakan kegiatan menutup rapat tempat-tempat penampungan air seperti bak mandi
                  maupun drum. Menutup juga dapat diartikan sebagai kegiatan mengubur barang bekas di dalam
                  tanah agar tidak membuat lingkungan semakin kotor dan dapat berpotensi menjadi sarang
                  nyamuk.
                </p>
              </vs-popup>
            </div>
        </vs-card>
      </vs-col>

      <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4" style="padding-left:15px">
        <vs-card>
          <div slot="media">
            <img src="../img/daur.png">
          </div>
            <hr><h4 style="text-align: center;">Mendaur ulang barang bekas</h4>
            <div class="centerx" style="text-align: center;">
              <vs-button @click="popupActivo2=true" color="primary" type="border" >Pehami Lebih Lanjut</vs-button>
              <vs-popup class="holamundo"  title="Mendaur ulang barang bekas" :active.sync="popupActivo2">
                <p>
                  Memanfaatkan kembali limbah barang bekas yang bernilai ekonomis (daur ulang), kita juga
                  disarankan untuk memanfaatkan kembali atau mendaur ulang barang-barang bekas yang berpotensi
                  menjadi tempat perkembangbiakan nyamuk demam berdarah.
                </p>
              </vs-popup>
            </div>
        </vs-card>
      </vs-col>
    </vs-row>

    <vs-row vs-justify="center">
      <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="9">
        <div id="konten" style="background-color:#AAD3DF; padding: 2vh 2vh">              
          <h6><strong>Note:</strong> Plus yang dimaksud adalah bentuk upaya pencegahan tambahan seperti, 
            <b>(1)</b> Memelihara ikan pemakan jentik nyamuk, 
            <b>(2)</b> Menggunakan obat anti nyamuk,
            <b>(3)</b> Memasang kawat kasa pada jendela dan ventilasi,
            <b>(4)</b> Gotong Royong membersihkan lingkungan,
            <b>(5)</b> Periksa tempat-tempat penampungan air,
            <b>(6)</b> Meletakkan pakaian bekas pakai dalam wadah tertutup,
            <b>(7)</b> Memberikan larvasida pada penampungan air yang susah dikuras,
            <b>(8)</b> Memperbaiki saluran dan talang air yang tidak lancar, dan
            <b>(9)</b> Menanam tanaman pengusir nyamuk.
          </h6>
        </div>
      </vs-col>
    </vs-row>
  </div>

  <div slot="footer">
    <p></p>
  </div>
</div>

</template>

<script>

  import axios from 'axios'
  import LineChart from './LineChart.js'
export default {
    components: {
      LineChart
    },
  data () {
    return {
      popupActivo:false,
      popupActivo1:false,
      popupActivo2:false,
      kabs: 0 ,
      options: {
      responsive: true,
      maintainAspectRatio: false
      },
      //loc: [],
      ActiveCases: null,
      FatalityRate: null,
      IncidenceRate: null,
      datacollection: null,
      url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
      attribution:'© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      // markers: [
      // { cor: [-7.796945, 110.401611] },
      // { cor: [ -7.832545, 110.465698] },
      // { cor: [-7.960524, 110.375836] }
      // ],
      markers:[],
      zoom: 9,
      center: [-7.417245, 110.343244],
      
      bounds: null,
      value1: -7.796945,
      value2: 110.401611,
      //center: [],
      kabupaten: [
        {text:'Nasional', value:	0 },
        {text:'Kulon Progo', value:	1},
        {text:'Bantul'	, value:2 },
        {text:'Gunung Kidul' , value:	3 },
        {text:'Sleman'	, value:4},
        {text:'Yogyakarta'	, value:5},
        {text:'Semarang'	, value:6},
        {text:'Ungaran'	, value:7},
        {text:'Surakarta'	, value:8},
        {text:'Karanganyar'	, value:9}, 
        {text:'Kudus'	, value:10}
      ],

       ListApi: [
        {text:'Nasional', value:	0, center:[-7.417245, 110.343244],  zoom: 9, pop:80.551},
        {text:'Kulon Progo', value:	34.01, center:[-7.8102598,	110.0831856],  zoom: 14, pop:4.302},
        {text:'Bantul'	, value:34.02, center:[	-7.8982156,	110.3408742], zoom: 14, pop:10.184},
        {text:'Gunung Kidul' , value:	34.03, center:[	-7.9861228,	110.3997117], zoom: 14, pop:7.427},
        {text:'Sleman'	, value:34.04, center:[	-7.6939481,	110.316545], zoom: 14, pop:12.196},
        {text:'Yogyakarta'	, value:34.71, center:[	-7.8021861,	110.3574634], zoom: 14, pop:4.319},
        {text:'Semarang'	, value:33.74, center:[	-7.0245542,	110.3468523], zoom: 14, pop:17.861},
        {text:'Ungaran'	, value:33.22, center:[	-7.1358505,	110.3758049 ], zoom: 14,  pop:1.677},
        {text:'Surakarta'	, value:33.72, center:[	-7.5591225,	110.7837065], zoom: 14,  pop:5.179},
        {text:'Karanganyar'	, value:33.13, center:[	-7.6531954,	110.9192305], zoom: 14,  pop:8.79}, 
        {text:'Kudus'	, value:33.19, center:[	-6.8186048,	110.8327991], zoom: 14,  pop:8.614} 
      ]
    };
  },

  methods: {
     Changedata(){
       this.Changecenter();
       this.GetActiveCases();
       this.GetIncidence();
       this.GetFatality();
       this.GetLocation();
       this.fillData();
     },
    Changecenter(){
    this.center=[];
    this.center.push(this.ListApi[this.kabs].center[0]);
    this.center.push(this.ListApi[this.kabs].center[1]);
    console.log(this.center);
    this.zoom=this.ListApi[this.kabs].zoom;
    
  },

  onMarkerClick(item){
    console.log(item.sum);
    this.$vs.notify({title:''+item.name,text:'Jumlah Pasien Sakit : '+item.sum})
  },

  fillData () {
    this.datacollection = {
      labels: [ ],
      datasets: [
        {
          label: 'Positif',
          borderColor: 'Red',
          borderWidth: '4',
          backgroundColor: '#f87979',
          fill: false,
          data: []
        }, {
          label: 'Sembuh',
          borderColor: 'Green',
          borderWidth: '4',
          backgroundColor: '#f87979',
          fill: false,
          data: []
        },{
          label: 'Meninggal',
          borderColor: 'Orange',
          borderWidth: '4',
          backgroundColor: '#f87979',
          fill: false,
          data: []
        }
      ]
    }
     
    axios.post('/DBD-SI/index.php/Dashboard/getGraphTotal/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
    //console.log(response.data.Data);
     console.log(response.data.Data.length);
    // return response.data.Data;
    var i;
    for (i = 0; i < response.data.Data.length; i++) {
      // console.log(response.data.Data[i].date_recap);
      // console.log(response.data.Data[i].total);
      this.datacollection.labels[i]= response.data.Data[i].date_recap;
      //this.datacollection.datasets[1].data[i]=this.getRandomInt();
      this.datacollection.datasets[0].data[i]=response.data.Data[i].total;
      // console.log(this.datacollection.labels[i]);
      // console.log(this.datacollection.datasets[0].data[i]);
      }

    })
    .catch(function (error) {
    console.log(error.response)
    });

    axios.post('/DBD-SI/index.php/Dashboard/getGraphSembuh/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
    //console.log(response.data.Data);
     console.log(response.data.Data.length);
    // return response.data.Data;
    var i;
    for (i = 0; i < response.data.Data.length; i++) {
      // console.log(response.data.Data[i].date_recap);
      // console.log(response.data.Data[i].total);
      //this.datacollection.labels[i]= response.data.Data[i].date_recap;
      //this.datacollection.datasets[1].data[i]=this.getRandomInt();
      this.datacollection.datasets[1].data[i]=response.data.Data[i].total;
      // console.log(this.datacollection.labels[i]);
      // console.log(this.datacollection.datasets[0].data[i]);
      }

    })
    .catch(function (error) {
    console.log(error.response)
    });

     axios.post('/DBD-SI/index.php/Dashboard/getGraphDie/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
   //console.log(response.data.Data);
     console.log(response.data.Data.length);
    // return response.data.Data;
    var i;
    for (i = 0; i < response.data.Data.length; i++) {
      // console.log(response.data.Data[i].date_recap);
      // console.log(response.data.Data[i].total);
      //this.datacollection.labels[i]= response.data.Data[i].date_recap;
      //this.datacollection.datasets[1].data[i]=this.getRandomInt();
      this.datacollection.datasets[2].data[i]=response.data.Data[i].total;
      // console.log(this.datacollection.labels[i]);
      // console.log(this.datacollection.datasets[0].data[i]);
      }

    })
    .catch(function (error) {
    console.log(error.response)
    });
    
    // var i;
    // for (i = 0; i < 50; i++) {
    //   this.datacollection.labels[i]= i;
    //   //this.datacollection.datasets[1].data[i]=this.getRandomInt();
    //   this.datacollection.datasets[0].data[i]=i;
    //   }
    // console.log(this.datacollection.datasets[1].data);

    // this.$data._chart.update();
    },
  getRandomInt () {
    return Math.floor(Math.random() * (50 - 5 + 1)) + 5
  },

  GetActiveCases: function() {
    axios.post('/DBD-SI/index.php/Dashboard/getCaseactive/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
    console.log(response);
    this.ActiveCases= response.data.Data[0].total;

    })
    .catch(function (error) {
    console.log(error.response)
    });
  },

  GetLocation: function() {
     this.markers=[];
    axios.post('/DBD-SI/index.php/Dashboard/getLocation/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
    console.log(response.data.Data[1]);
    console.log(response.data.Data.length);

    var i=0;
     for (i = 0; i < response.data.Data.length; i++) {
       this.markers.push({cor: [response.data.Data[i].lat_rs, response.data.Data[i].lon_rs], sum: response.data.Data[i].total, name: response.data.Data[i].name_rs });
     }
    //this.loc = response.data.Data; 
    //response.data.Data[0].total;
    // console.log(loc.length);
    // console.log(loc[1]);
    // console.log(markers);

    })
    .catch(function (error) {
    console.log(error.response)
    });

    // var i=0;
    //  for (i = 0; i < this.loc.length; i++) {
    //    this.markers.push({cor: [this.loc[i].lat_rs, this.loc[i].lon_rs]});
    //  }

    console.log(this.markers);
  },

   GetIncidence: function() {
    axios.post('/DBD-SI/index.php/Dashboard/getIncidenceRate/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
    console.log(response);
    this.IncidenceRate = (response.data.Data.total / this.ListApi[this.kabs].pop).toFixed(2);
    // this.IncidenceRate = this.IncidenceRate/ListApi[this.kabs].pop;
    console.log('insiden ='+this.IncidenceRate);
    //this.IncidenceRate.toFixed(2);
    // console.log('insiden 2='+this.IncidenceRate);
    })
    .catch(function (error) {
    console.log(error.response)
    });
  },

   GetFatality: function() {
    axios.post('/DBD-SI/index.php/Dashboard/getFatalityRate/'+ this.ListApi[this.kabs].value)
    .then( (response)=> {
    console.log(response);
    this.FatalityRate= response.data.Data.toFixed(2);

    })
    .catch(function (error) {
    console.log(error.response)
    });
  },

  // GetGraphTotal: function() {
  //   axios.post('/DBD-SI/index.php/Dashboard/getGraphTotal/'+ this.ListApi[this.kabs].value)
  //   .then( (response)=> {
  //   //console.log(response);
  //   return response.data.Data;

  //   })
  //   .catch(function (error) {
  //   console.log(error.response)
  //   });
  // },
    
  },

  mounted() {
      setTimeout(function() { window.dispatchEvent(new Event('resize')) }, 250);
        
  },

  created(){ 
  this.GetIncidence();
  this.GetFatality();
  this.GetActiveCases();
  this.fillData();
  this.GetLocation();
  }
}
</script>
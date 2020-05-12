import Vue from 'vue'
import App from './App.vue'
import Vuesax from 'vuesax'

import axios from 'axios'
import 'vuesax/dist/vuesax.css' //Vuesax styles

import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
import { Icon } from 'leaflet';
import 'leaflet/dist/leaflet.css';

var meta = document.getElementsByTagName('meta');
var siteUrl = meta['site-url'].content;


window.sessionStorage.setItem('siteUrl', siteUrl);

var router = require('./routes').default;

Vue.prototype.$http = axios;

Vue.use(Vuesax);

// Vue.component('v-map', Vue2Leaflet.Map);
// Vue.component('v-tilelayer', Vue2Leaflet.TileLayer);
// Vue.component('v-marker', Vue2Leaflet.Marker);
Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);

delete Icon.Default.prototype._getIconUrl;


Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});

// Icon.Default.mergeOptions({
//   iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
//   iconUrl: require('leaflet/dist/images/marker-icon.png'),
//   shadowUrl: require('leaflet/dist/images/marker-shadow.png')
// });

Vue.config.productionTip = false;
var app = new Vue({
  router, 
  el: '#app',
  template: '<App/>',
  components: { App },
 // render: h => h(App)
})
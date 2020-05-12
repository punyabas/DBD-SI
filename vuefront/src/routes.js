import Vue from 'vue'
import Router from 'vue-router'
import Login from './component/Login.vue'
import Dirjen from './component/Dirjen.vue'
import RS from './component/RS.vue'
import Maps from './component/Maps.vue'

Vue.use(Router)

var siteUrl = window.sessionStorage.getItem('siteUrl')
console.log(siteUrl);
// console.log(baseUrl);

export default new Router({
  mode:'history',
  routes: [
    { path: siteUrl + '/web/login',
      name: 'login',
      component: Login
    },
    { path: siteUrl + '/web/maps',
      name: 'maps',
      component: Maps
    },
    { path: siteUrl + '/web/RS',
      name: 'rs',
      component: RS
    },
    { path: siteUrl + '/web/dirjen',
    name: 'dirjen',
    component: Dirjen
  }
  ]
})
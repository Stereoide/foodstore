
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('ingredients-list', require('./components/IngredientsListComponent.vue'));
Vue.component('ingredient', require('./components/IngredientComponent.vue'));
Vue.component('new-ingredient', require('./components/NewIngredientComponent.vue'));

import vueWebcam from 'vue-webcam'

const app = new Vue({
    el: '#app'
});

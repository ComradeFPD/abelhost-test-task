/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-index', require('./components/Users/Index').default);
Vue.component('user-form', require('./components/Users/UserForm').default);
Vue.component('cake-index', require('./components/Cakes/Index').default);
Vue.component('cake-form', require('./components/Cakes/CakeForm').default);
Vue.component('component-index', require('./components/CakeComponents/Index').default);
Vue.component('component-form', require('./components/CakeComponents/CakeComponentForm').default);
Vue.component('ingredient-index', require('./components/Ingredients/Index').default);
Vue.component('ingredient-form', require('./components/Ingredients/IngredientForm').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#vue',
});

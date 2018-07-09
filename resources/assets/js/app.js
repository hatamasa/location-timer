import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const routes = [
    { path: '/test/index/', component: require('./components/Test/Index.vue') },
    { path: '/test/hello/', component: require('./components/Test/Hello.vue') }
];

const router = new VueRouter({
    routes: routes
});

const app = new Vue({
    router
}).$mount('#app');

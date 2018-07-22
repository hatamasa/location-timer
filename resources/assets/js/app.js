import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import TestHeader from './components/TestHeader.vue';
import Todo from './components/Todo.vue';

const routes = [
    { path: '/vue/spa/', components: require('./components/Spa/Index.vue')},
    { path: '/vue/spa/hello', components: require('./components/Spa/Hello.vue')}
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    router
}).$mount('#app');

const app2 = new Vue({
    el: '#header',
    components: {
        TestHeader
    }
});

const todo = new Vue({
    el: '#todo',
    components: {
        Todo
    }
});
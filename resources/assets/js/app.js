import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import MyList1 from './components/MyList1.vue';

import Todo from './components/Todo.vue';
Vue.component('draggable', require('vuedraggable'));

import TestHeader from './components/Test/TestHeader.vue';

const routes = [
    { path: '/vue/test/', components: require('./components/Test/Index.vue')},
    { path: '/vue/test/hello', components: require('./components/Test/Hello.vue')}
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    router
}).$mount('#app');

const myList = new Vue({
    el: '#myList',
    components: {
        MyList1
    }
});

const todo = new Vue({
    el: '#todo',
    components: {
        Todo
    }
});

const app2 = new Vue({
    el: '#header',
    components: {
        TestHeader
    }
});

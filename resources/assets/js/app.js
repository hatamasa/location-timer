import Vue from 'vue';
import VueRouter from 'vue-router';
import MyList1 from './components/MyList.vue';
import Todo from './components/Todo.vue';
import TestHeader from './components/Test/TestHeader.vue';
//ElementUI
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/ja';

require('./bootstrap');

Vue.use(VueRouter);
//ElementUI
Vue.use(ElementUI, {locale});

Vue.component('draggable', require('vuedraggable'));

// router-vueの設定
const routes = [
    { path: '/vue/test_router_link/', components: require('./components/Test/Index.vue')},
    { path: '/vue/test_router_link/hello', components: require('./components/Test/Hello.vue')}
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

// location-timer
const myList = new Vue({
    el: '#myList',
    components: {
        MyList1
    }
});

// todoリスト
const todo = new Vue({
    el: '#todo',
    components: {
        Todo
    }
});



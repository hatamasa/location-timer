<template>
    <div>
        <input type="text" placeholder="TODOを入力" v-model="newItemTitle" v-on:keyup.enter="addTodo(newItemTitle)">
        <ul>
            <li v-for="item in items">
                <label v-bind:class="{ done: item.isChecked }">
                    <input type="checkbox" v-model="item.isChecked"> {{ item.title }}
                </label>
            </li>
        </ul>
        <button v-on:click="deleteTodo()">チェック済み項目を削除する</button>
    </div>
</template>

<style>
    .done {
        text-decoration: line-through;
    }
</style>

<script>
export default {
  data() {
    return {
      items: [],
      newItemTitle: ''
    }
  },
  mounted: function() {
      this.loadTodo();
  },
  methods: {
      addTodo(newTitle) {
          if (! newTitle.trim()) return;
          this.items.push({
              title: newTitle,
              isChecked: false
          });
          this.newItemTitle = '';
          this.saveTodo();
      },
      deleteTodo() {
          this.items = this.items.filter( item => {
              return item.isChecked === false;
          });
          this.saveTodo();
      },
      saveTodo() {
          localStorage.setItem('items', JSON.stringify(this.items));
      },
      loadTodo() {
        this.items = JSON.parse(localStorage.getItem('items'));
        if (! this.items) {
            this.items = [];
        }
      },
  }
}
</script>
<template>
    <div>
        <input type="text" placeholder="TODOを入力" v-model="newItemTitle">
        <button type="button" v-on:click="addTodo(newItemTitle)">追加</button>
        <ul class="item">
            <draggable v-model="items" v-bind:options="{
                animation: 200,
                delay: 50,
                handle:'.handle'
            }" @end="onEnd">
            <li v-for="item in items">
                <div class="handle"><div></div><div></div><div></div></div>
                <label v-bind:class="{ done: item.isChecked }">
                    <input type="checkbox" v-model="item.isChecked"> {{ item.title }}
                </label>
            </li>
            </draggable>
        </ul>
        <button v-on:click="deleteTodo()">チェック済み項目を削除する</button>
    </div>
</template>

<style>
  ul {
    list-style: none;
  }
  .done {
    text-decoration: line-through;
  }
  .handle {
    position: relative;
    height: 22px;
    width: 22px;
    display: inline-block;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    border: 1px solid #ccc;
  }
  .handle div {
    position: absolute;
    left: 5px;
    height: 1px;
    width: 10px;
    background-color: #444;
    border-radius: 4px;
    display: inline-block;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  .handle div:nth-of-type(1) {
    top: 6px;
  }
  .handle div:nth-of-type(2) {
    top: 9px;
  }
  .handle div:nth-of-type(3) {
    bottom: 7px;
  }
  .item {
    padding-left: 0;
    margin-top: 10px;
  }
  .item li {
    display: flex;
  }
  .item li label {
    border: 1px solid #ccc;
    height: 22px;
    width: 100%;
    margin-left: 5px;
    padding-left: 5px;
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
  computed: {
      todoList: {
          get() {
              return this.items;
          },
          set(value) {
              this.items = value;
          }
      }
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
      onEnd() {
          this.saveTodo();
      }
  }
}
</script>
<template>
    <div>
        <input type="text" placeholder="TODOを入力" v-model="newItemTitle" v-on:keyup.enter="addTodo(newItemTitle)">
        <ul>
            <li v-for="item in items">
                <label><input type="checkbox" v-model="item.isChecked"> {{ item.title }}</label>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
  data() {
    return {
      items: [
          { title: '領収書を準備する', isChecked: true },
          { title: 'Vue.jsハンズオンの資料を作る', isChecked: true },
          { title: '参加者の人数を確認する', isChecked: false },
          { title: 'ピザを注文する', isChecked: false },
          { title: '参加費のお釣りを準備する', isChecked: false },
          { title: '会場設営をする', isChecked: false },
      ],
      newItemTitle: ''
    }
  },
  methods: {
      addTodo(newTitle) {
          this.items.push({
              title: newTitle,
              isChecked: false
          });
          this.newItemTitle = '';
      },
  }
}

</script>
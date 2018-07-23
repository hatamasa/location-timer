<template>
  <div>
    <input type="text" v-model="msg">
    <button @click="clear()">clear</button>
    <p v-if="msg.length > 0">
      {{msg}}
    </p>
    <p v-else>
      ↓入力してください
    </p>
  </div>
</template>

<script>
export default {
  data () {
    return {
      msg: 'test input'
    }
  },
  methods: {
    clear () {
      this.msg = ''
    }
  }
}
</script>

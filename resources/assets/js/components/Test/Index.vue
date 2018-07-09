<template>
  <div>
    <div v-for="article in articles">
      <div class="row">
        <div class="thumbs">
            {{ article.id }} : {{ article.title }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.fetchTestData()
  },
  data() {
    return {
      articles: []
    }
  },
  methods: {
    fetchTestData() {
      this.$http({
        url: '/api/test',
        method: 'GET'
      }).then(res =>  {
        this.articles =  res.data
      })
    }
  }
}
</script>

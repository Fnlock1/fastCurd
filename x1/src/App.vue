<template>
  <div>
    <h1>代码生成</h1>
    <form @submit.prevent="generateCode">
      <div>
        <label for="type">类型:</label>
        <select v-model="type">
          <option value="controller">控制器</option>
          <option value="model">模型</option>
          <option value="migration">数据迁移</option>
        </select>
      </div>
      <div>
        <label for="name">名字:</label>
        <input type="text" v-model="name" required />
      </div>
      <button type="submit">生成</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      type: 'controller',
      name: ''
    };
  },
  methods: {
    generateCode() {
      axios.post('http://127.0.0.1:8000/generate-code', {
        type: this.type,
        name: this.name
      })
          .then(response => {
            alert(response.data.message);
          })
          .catch(error => {
            console.error(error);
            alert('Error generating code');
          });
    }
  }
};
</script>

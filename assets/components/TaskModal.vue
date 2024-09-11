<template>
    <div class="modal">
      <div class="modal-content">
        <span class="close" @click="$emit('close')">&times;</span>
        <h2>{{ task ? 'Edit Task' : 'Add Task' }}</h2>
        <form @submit.prevent="saveTask">
          <input v-model="taskData.title" placeholder="Title" required />
          <textarea v-model="taskData.description" placeholder="Description"></textarea>
          <select v-model="taskData.status">
            <option value="3">To Do</option>
            <option value="2">In Progress</option>
            <option value="1">Done</option>
          </select>
          <button type="submit">Save</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from '../axios';
  
  export default {
    props: ['task'],
    data() {
      return {
        taskData: {
          idTask: this.task ? this.task.id : null,
          title: '',
          description: '',
          status: 'todo',
          ...this.task,
        },
      };
    },
    methods: {
      async saveTask() {
        try {
            const url = this.taskData.idTask ? '/add' : '/add';
            await axios.post(url, this.taskData); // Envoyer l'ID avec les données

            this.$emit('save');
            this.$emit('close');
            
        } catch (error) {
          console.error('Error saving task:', error);
        }
      },
    },
  };
  </script>
  
  <style>
  /* Add your styles for the modal here */
  </style>
  
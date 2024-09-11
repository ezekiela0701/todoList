<template>
    <div>
      <button @click="openModal">Add Task</button>
      <ul>
        <li v-for="task in tasks" :key="task.id">
            
          {{ task.title }} - {{ task.status }}
          
          <button @click="openModal(task)">Edit</button>
        </li>
      </ul>
      <TaskModal
        v-if="showModal"
        :task="currentTask"
        @close="closeModal"
        @save="fetchTasks"
      />
    </div>
  </template>
  
  <script>
  import axios from '../axios';
  import TaskModal from './TaskModal.vue';
  
  export default {
    components: { TaskModal },
    data() {
      return {
        tasks: [],
        showModal: false,
        currentTask: null,
      };
    },
    methods: {
      async fetchTasks() {
        try {
          const response = await axios.get('/list');
          this.tasks = response.data.data;
          console.log(this.tasks);
          
          
        } catch (error) {
          console.error('Error fetching tasks:', error);
        }
      },
      openModal(task = null) {
        this.currentTask = task;
        this.showModal = true;
      },
      closeModal() {
        this.showModal = false;
        this.currentTask = null;
      },
    },
    mounted() {
      this.fetchTasks();
    },
  };
  </script>
  
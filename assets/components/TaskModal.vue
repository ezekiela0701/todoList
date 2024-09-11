<template>
    <div v-if="showModal" class="modal-overlay" @click="closeModal">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal">&times;</button>
        <h2>{{ taskData.idTask ? 'Edit Task' : 'Add Task' }}</h2>
        <form @submit.prevent="saveTask">
          <div class="form-group">
            <label for="taskTitle">Title</label>
            <input id="taskTitle" v-model="taskData.title" type="text" placeholder="Title" required />
          </div>
          <div class="form-group">
            <label for="taskDescription">Description</label>
            <textarea id="taskDescription" v-model="taskData.description" placeholder="Description"></textarea>
          </div>
          <div class="form-group">
            <label for="taskStatus">Status</label>
            <select id="taskStatus" v-model="taskData.status">
              <option value="3">To Do</option>
              <option value="2">In Progress</option>
              <option value="1">Done</option>
            </select>
          </div>
          <button type="submit">Save</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from '../axios';
  
  export default {
    props: ['task', 'showModal'],
    data() {
      return {
        taskData: {
          idTask: this.task ? this.task.id : null,
          title: this.task ? this.task.title : '',
          description: this.task ? this.task.description : '',
          status: this.task ? this.task.status : '3',
        },
      };
    },
    methods: {
      closeModal() {
        this.$emit('close');
      },
      async saveTask() {
        try {
          const url = this.taskData.idTask ? '/update' : '/add'; // Use '/update' for edits
          await axios.post(url, this.taskData);
          this.$emit('save');
          this.closeModal();
        } catch (error) {
          console.error('Error saving task:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }
  
  .modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 500px;
    max-width: 100%;
    position: relative;
  }
  
  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    border: none;
    background: none;
    cursor: pointer;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  form input,
  form textarea,
  form select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  button {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background: #0056b3;
  }
  </style>
  
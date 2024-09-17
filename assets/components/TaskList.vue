<template>
    <div class="container">
      <div>
        <button class="add-task-button" @click="openModal">Add Task</button>
        <!-- Table and other content -->
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id">
            <td>{{ task.id }}</td>
            <td>{{ task.title }}</td>
            <td>{{ task.description }}</td>
            <td>
              <span :class="statusBadgeClass(task.status)">{{ statusText(task.status) }}</span>
              <!-- {{ task.status }} -->
            </td>
            <td>
              <button class="btn btn-primary" @click="openModal(task)">Edit</button>
              <!-- <button class="btn btn-danger" @click="deleteTask(task.id)">Delete</button> -->
            </td>
          </tr>
        </tbody>
      </table>
      <TaskModal
        :task="currentTask"
        :showModal="showModal"
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
    // Méthode pour retourner le texte du statut
    statusText(status) {
      switch (status) {
        case 3:
          return 'À faire';
        case 2:
          return 'En cours';
        case 1:
          return 'Fait';
        default:
          return 'Inconnu';
      }
    },
    // Méthode pour retourner les classes CSS selon le statut
    statusBadgeClass(status) {
      switch (status) {
        case 3:
          return 'badge badge-todo';
        case 2:
          return 'badge badge-inprogress';
        case 1:
          return 'badge badge-done';
        default:
          return 'badge';
      }
    },
    },
    mounted() {
      this.fetchTasks();
    },
  };
  </script>
  
  <style scoped>
  .badge {
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
    font-size: 14px;
  }
  
  .badge-todo {
    background-color: #ffc107; /* Jaune pour À faire */
  }
  
  .badge-inprogress {
    background-color: #17a2b8; /* Bleu pour En cours */
  }
  
  .badge-done {
    background-color: #28a745; /* Vert pour Fait */
  }

  .add-task-button {
    background: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .add-task-button:hover {
    background: #218838;
  }
  </style>
  
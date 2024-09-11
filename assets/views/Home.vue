<template>
    <div>
      <header>
        <h1>My To-Do List</h1>
      </header>
      <main>
        <TaskList />
      </main>
    </div>
  </template>
  
  <script>
  import TaskList from '../components/TaskList.vue';
  
  export default {
    components: {
      TaskList
    }
  };
  </script>
  
  <style>
  /* Add your styles here */
  header {
    background-color: #f8f9fa;
    padding: 10px;
  }
  
  main {
    padding: 20px;
  }
  </style>
  
<template>
  <div>
    <button @click="showAlert">Show Alert</button>
  </div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
  methods: {
    showAlert() {
      Swal.fire('This is an alert message!');
    }
  }
}
</script>
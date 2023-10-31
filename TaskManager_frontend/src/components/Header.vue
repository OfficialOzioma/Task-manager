<script setup>
</script>
<template>
  <div class="container">
    <header
      class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom"
    >
      <a href="/" class="nav-link"> <h1>Task Manager</h1></a>
      <div class="col-md-3 mb-2 mb-md-0">
        <a
          href="/"
          class="d-inline-flex link-body-emphasis text-decoration-none"
        >
        </a>
      </div>

      <div class="col-md-3 text-end">
        <slot name="auth_link"></slot>
      </div>
    </header>
  </div>
</template>



<style>
</style>
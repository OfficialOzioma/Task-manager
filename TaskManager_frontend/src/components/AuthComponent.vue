<script setup>
import Header from "./Header.vue";
</script>

<template>
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">
          <slot name="info"></slot>
        </h1>
        <p class="col-lg-10 fs-4">
          To start using the Task Manager App, you need to login or register
          <br />
          You can use this Task Manager App to manage your day-to-day activities
        </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <slot name="auth_form"></slot>
      </div>
    </div>
  </div>
</template>

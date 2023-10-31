<script setup>
import TheWelcome from "../components/TheWelcome.vue";
</script>

<template>
  <div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold text-body-emphasis">
      Welcome to Task Manager
    </h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">
        This is a Test project for the Position of Senior backend Developer at
        APTIW
      </p>
      <p class="lead mb-4">
        This is the Frontend of the project <br />
        The technology used for this Frontend include <b>Vuejs</b>,
        <b>Bootstrap</b>, <b>Apollo graphql</b>
      </p>

      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
        <RouterLink to="/auth/login">
          <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">
            Login
          </button>
        </RouterLink>

        <RouterLink to="/auth/register">
          <button type="button" class="btn btn-outline-secondary btn-lg px-4">
            Register
          </button>
        </RouterLink>
      </div>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh">
      <div class="container px-5">
        <img
          src="bootstrap-docs.png"
          class="img-fluid border rounded-3 shadow-lg mb-4"
          alt="Example image"
          width="700"
          height="500"
          loading="lazy"
        />
      </div>
    </div>
  </div>
</template>

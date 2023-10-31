<script setup>
import { RouterLink, RouterView } from "vue-router";
import Header from "./components/Header.vue";
import { watch } from "vue";
import { useQuery } from "@vue/apollo-composable";
import gql from "graphql-tag";

const { result } = useQuery(gql`
  query getUsers {
    users {
      data {
        name
        email
        id
      }
    }
  }
`);

watch(() => {
  console.log(result.value);
});
</script>

<template>
  <div class="container">
    <Header>
      <template #auth_link>
        <RouterLink to="/auth/login">
          <button type="button" class="btn btn-outline-primary me-2">
            Login
          </button>
        </RouterLink>
        <RouterLink to="/auth/register">
          <button type="button" class="btn btn-primary">Register</button>
        </RouterLink>
      </template>
    </Header>
  </div>

  <RouterView />
</template>

<style scoped>
</style>

<script setup>
import { ref, onMounted } from "vue";
import { useQuery, useMutation } from "@vue/apollo-composable";
import { FETCH_ONE_TASK_QUERY, UPDATE_TASK_MUTATION } from "@/graphql";
import router from "../../router";

onMounted(() => {
  const { result } = useQuery(FETCH_ONE_TASK_QUERY, {
    unique_id: router.params.id,
  });
});
</script>

<template>
  <div class="container">
    <div class="align-content-center">
      <h1>Edit Task</h1>
    </div>
    <br />
    <form class="border border-1 p-5">
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="row mb-4">
        <div class="col">
          <div class="form-outline">
            <label class="form-label" for="form3Example1">Title</label> <br />
            <input
              class="form-control form-control-lg"
              type="text"
              placeholder=".form-control-lg"
              aria-label=".form-control-lg example"
            />
          </div>
        </div>
        <div class="col">
          <div class="form-outline">
            <label class="form-label">Select Category </label>
            <br />
            <select
              class="form-select form-select-lg mb-3"
              aria-label="Large select example"
            >
              <option selected>Open this select menu</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Due Date input -->
      <div class="form-outline mb-4">
        <label class="form-label" for="form3Example4">Due Date</label> <br />
        <input
          type="date"
          pattern="\d{4}-\d{2}-\d{2}"
          class="form-control form-control-lg"
        />
      </div>

      <!-- Description input -->
      <div class="form-outline mb-4">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Enter Description</label
        >
        <textarea
          class="form-control form-control-lg"
          id="exampleFormControlTextarea1"
          rows="3"
        ></textarea>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">
        Update up
      </button>
    </form>
  </div>
</template>


<style scoped>
</style>

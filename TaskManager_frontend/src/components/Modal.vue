<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="createTaskModal"
    tabindex="-1"
    aria-labelledby="createTaskModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createTaskModalLabel">
            Create New Task
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form method="POST" @submit.prevent="create">
            <!-- Display the message here -->
            <div v-if="message" class="alert" :class="messageType">
              {{ message }}
            </div>

            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                  <label class="form-label">Title</label>
                  <br />
                  <input
                    class="form-control form-control-lg"
                    type="text"
                    placeholder="Enter Title"
                    id="title"
                    v-model="title"
                  />
                </div>
              </div>
              <div class="col">
                <div class="form-outline">
                  <label class="form-label">Select Category </label>
                  <br />
                  <select
                    class="form-select form-select-lg mb-3"
                    id="category"
                    v-model="category"
                  >
                    <option value="" disabled>Select a category</option>
                    <option
                      v-for="cat in categories"
                      :key="cat.id"
                      :value="cat.id"
                    >
                      {{ cat.name }}
                    </option>
                  </select>
                </div>
              </div>
              <button
                type="button"
                class="btn btn-link"
                data-bs-target="#categoryModal"
                data-bs-toggle="modal"
                data-bs-dismiss="modal"
              >
                add new category
              </button>
            </div>

            <!-- Due Date input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example4">Due Date</label>
              <br />
              <input
                type="date"
                class="form-control form-control-lg"
                id="date"
                v-model="date"
              />
            </div>

            <!-- Description input -->
            <div class="form-outline mb-4">
              <label for="description" class="form-label"
                >Enter Description</label
              >
              <textarea
                class="form-control form-control-lg"
                rows="3"
                id="description"
                v-model="description"
              ></textarea>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="categoryModal"
    tabindex="-1"
    aria-labelledby="categoryModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="categoryModalLabel">
            Create New Task
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form method="POST" @submit.prevent="create_category">
            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                  <label class="form-label">Category</label>
                  <br />
                  <input
                    class="form-control form-control-lg"
                    type="text"
                    placeholder="Enter category name"
                    id="categoryName"
                    v-model="categoryName"
                  />
                </div>
              </div>
              <div class="col">
                <div class="form-outline">
                  <br />
                  <button type="submit" class="btn btn-primary btn-lg">
                    Save Category
                  </button>
                </div>
              </div>
            </div>

            <!-- Display the message here -->
            <div v-if="message4category" class="alert" :class="messageType">
              {{ message4category }}
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-success"
                data-bs-target="#createTaskModal"
                data-bs-toggle="modal"
                data-bs-dismiss="modal"
              >
                Back
              </button>

              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useQuery, useMutation } from "@vue/apollo-composable";
import {
  CREATE_CATEGORY_MUTATION,
  CREATE_TASK_MUTATION,
  FETCH_CATEGORIES_QUERY,
} from "@/graphql"; // Import your queries/mutations

const title = ref("");
const category = ref("");
const date = ref(new Date());
const description = ref("");

const categoryName = ref("");

const { mutate: createTask } = useMutation(CREATE_TASK_MUTATION);
const { mutate: createCategory } = useMutation(CREATE_CATEGORY_MUTATION);
// const { result } = useQuery(FETCH_CATEGORIES_QUERY);

const message = ref(""); // Initialize the message variable
const message4category = ref(""); // Initialize the message variable
const messageType = ref(""); // Initialize the message type (e.g., "alert-success" or "alert-danger")

// Access the categories data
const categories = ref([]);

onMounted(() => {
  // Check if data exists in local storage
  const storedCategoriesData = localStorage.getItem("categoriesData");
  if (storedCategoriesData) {
    // Data found in local storage, parse and assign it to the categories ref
    categories.value = JSON.parse(storedCategoriesData);
  }

  // Fetch data using the GraphQL query
  const { result } = useQuery(FETCH_CATEGORIES_QUERY);
  if (result.value) {
    categories.value = result.value.categories;

    // Save the fetched data to local storage for future use
    localStorage.setItem(
      "categoriesData",
      JSON.stringify(result.value.categories)
    );
  }
});

const create = async () => {
  // Get the values at the moment of mutation execution
  const variables = {
    title: title.value,
    category_id: parseInt(category.value),
    due_date: date.value,
    description: description.value,
  };

  try {
    const result = await createTask(variables);

    if (result.data) {
      console.log(result.data.createTask.message);
      // Registration was successful
      message.value = result.data.createTask.message;
      messageType.value = "alert-success";
    } else if (result.errors) {
      console.log(result.errors);

      message.value = result.data.createTask.message;
      messageType.value = "alert-danger";
    }
  } catch (error) {
    //     // Handle any other errors
    console.error(error);
    //     message.value = "An error occurred. Please try again.";
    //     messageType.value = "alert-danger";
  }
};

const create_category = async () => {
  // Get the values at the moment of mutation execution
  const variables = {
    name: categoryName.value,
  };

  try {
    const result = await createCategory(variables);
    console.log(result);
    if (result.data) {
      // Creation was successful
      message4category.value = "Created successfully";
      messageType.value = "alert-success";
    } else if (result.errors) {
      console.log(result.errors);

      message.value = result.data.createTask.message;
      messageType.value = "alert-danger";
    }
  } catch (error) {
    //     // Handle any other errors
    console.error(error);
    //     message.value = "An error occurred. Please try again.";
    //     messageType.value = "alert-danger";
  }
};
</script>

<style>
</style>

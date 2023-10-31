<template>
  <div class="container m-5 p-2 rounded mx-auto bg-light shadow">
    <!-- App title section -->
    <div class="row m-1 p-4">
      <div class="col">
        <div
          class="p-1 h1 text-primary text-center mx-auto display-inline-block"
        >
          <h1>
            <i class="fas fa-check bg-primary text-white rounded p-2"></i>
            Task Manager
          </h1>
        </div>
      </div>
    </div>
    <!-- Create todo section -->
    <div class="row m-1 p-3">
      <div class="col col-11 mx-auto">
        <div
          class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center"
        >
          <button
            type="button"
            class="btn btn-primary btn-lg"
            data-bs-toggle="modal"
            data-bs-target="#createTaskModal"
          >
            Add new Task
          </button>
        </div>
      </div>
    </div>

    <div class="p-2 mx-4 border-black-25 border-bottom"></div>
    <!-- View options section -->

    <!-- Todo list section -->
    <div class="row mx-1 px-5 pb-3 w-80">
      <div class="col mx-auto">
        <section style="background-color: #eee">
          <div class="container py-5 h-100">
            <div
              class="row d-flex justify-content-center align-items-center h-100"
            >
              <div class="col-md-12 col-xl-10">
                <div class="card">
                  <div class="card-header p-3">
                    <h5 class="mb-0">
                      <i class="fas fa-tasks me-2"></i>
                      Task List
                    </h5>
                  </div>
                  <div
                    class="card-body"
                    data-mdb-perfect-scrollbar="true"
                    style="position: relative; height: 400px"
                  >
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th scope="col">Title</th>
                          <th scope="col">Category</th>
                          <th scope="col">Due Date</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="task in tasks"
                          :key="task.id"
                          class="fw-normal"
                        >
                          <th>
                            <span class="ms-2"> {{ task.title }}</span>
                          </th>
                          <td class="align-middle">
                            <span>{{ task.category.name }}</span>
                          </td>
                          <td class="align-middle">
                            <h6 class="mb-0">
                              <span class="badge bg-primary">{{
                                task.due_date
                              }}</span>
                            </h6>
                          </td>
                          <td class="align-middle">
                            <a
                              :href="`/task/edit/${task.id}`"
                              data-mdb-toggle="tooltip"
                              title="Done"
                              ><i class="fas fa-edit text-success me-3"></i
                            ></a>
                            <a
                              :href="edit"
                              data-mdb-toggle="tooltip"
                              title="Remove"
                              ><i class="fas fa-trash-alt text-danger"></i
                            ></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <Modal />
  </div>
</template>

<script setup>
import Modal from "../../components/Modal.vue";
import { ref, onMounted } from "vue";
import { useQuery, useMutation } from "@vue/apollo-composable";
import { FETCH_ALL_TASKS_QUERY, DELETE_TASK_MUTATION } from "@/graphql"; // Import your queries/mutations

// const { mutate: deteteTask } = useMutation(DELETE_TASK_MUTATION);

const tasks = ref([]);

onMounted(() => {
  // Check if data exists in local storage
  const storedTasksData = localStorage.getItem("tasksData");
  if (storedTasksData) {
    tasks.value = JSON.parse(storedTasksData);
  }

  const { result } = useQuery(FETCH_ALL_TASKS_QUERY);
  if (result._value) {
    tasks.value = result._value.tasks.data;

    localStorage.setItem("tasksData", JSON.stringify(result._value.tasks.data));
  }
  console.log(result._value.tasks.data);
});
// const tasks = result.value ? result.value.categories : [];
</script>


<style scoped>
body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.6;
}

.add-todo-input,
.edit-todo-input {
  outline: none;
}

.add-todo-input:focus,
.edit-todo-input:focus {
  border: none !important;
  box-shadow: none !important;
}

.view-opt-label,
.date-label {
  font-size: 0.8rem;
}

.edit-todo-input {
  font-size: 1.7rem !important;
}

.todo-actions {
  visibility: hidden !important;
}

.todo-item:hover .todo-actions {
  visibility: visible !important;
}

.todo-item.editing .todo-actions .edit-icon {
  display: none !important;
}
</style>

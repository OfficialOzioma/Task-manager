<template>
  <AuthComponent>
    <template #info> Register </template>

    <template #auth_form>
      <form
        method="POST"
        @submit.prevent="register"
        class="p-4 p-md-5 border rounded-3 bg-body-tertiary"
      >
        <!-- Display the message here -->
        <div v-if="message" class="alert" :class="messageType">
          {{ message }}
        </div>

        <!-- Display validation errors here -->
        <div v-if="validationErrors" class="alert alert-danger">
          <ul>
            <li v-for="error in validationErrors" :key="error.field">
              {{ error.field }}: {{ error.message }}
            </li>
          </ul>
        </div>

        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Enter your Fullname"
            id="name"
            v-model="name"
          />
          <label for="name">Full Name</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            placeholder="name@example.com"
            id="email"
            v-model="email"
          />
          <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            placeholder="Enter Password"
            id="password"
            v-model="password"
          />
          <label for="password">Password</label>
        </div>
        <div class="checkbox mb-3">
          <label>
            <span>
              Already a user?
              <RouterLink to="/auth/login">
                <button class="btn btn-link">Login Here</button>
              </RouterLink>
            </span>
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">
          Register
        </button>
        <hr class="my-4" />
        <small class="text-body-secondary"
          >By clicking Register, you agree to the terms of use.</small
        >
      </form>
    </template>
  </AuthComponent>
</template>


<script setup>
import AuthComponent from "../../components/AuthComponent.vue";
import { REGISTER_MUTATION } from "../../graphql";
import { useMutation } from "@vue/apollo-composable";
import { ref } from "vue";

const name = ref("");
const email = ref("");
const password = ref("");

const { mutate: registerUser } = useMutation(REGISTER_MUTATION);

const validationErrors = ref(null); // Initialize validationErrors
const message = ref(""); // Initialize the message variable
const messageType = ref(""); // Initialize the message type (e.g., "alert-success" or "alert-danger")

const register = async () => {
  // Get the values at the moment of mutation execution
  const variables = {
    name: name.value,
    email: email.value,
    password: password.value,
  };

  try {
    const result = await registerUser(variables);
    if (result.data) {
      console.log(result.data.register.message);

      // Registration was successful
      message.value = result.data.register.message;
      messageType.value = "alert-success";
    } else if (result.errors) {
      console.log(result.errors);

      // Check for validation errors in the response
      const validationErrorsData = result.errors.find(
        (error) => error.extensions.category === "validation"
      );

      if (validationErrorsData) {
        validationErrors.value = validationErrorsData.extensions.validation;
      } else {
        // Registration had an error other than validation
        message.value = "Registration failed. Please try again.";
        messageType.value = "alert-danger";
      }
    }
  } catch (error) {
    // Handle any other errors
    console.error(error);
    message.value = "An error occurred. Please try again.";
    messageType.value = "alert-danger";
  }
};
</script>

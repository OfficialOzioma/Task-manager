<template>
  <AuthComponent>
    <template #info> Login </template>
    <template #auth_form>
      <form
        method="POST"
        @submit.prevent="login"
        class="p-4 p-md-5 border rounded-3 bg-body-tertiary"
      >
        <!-- Display the success or general error message here -->
        <div v-if="message" class="alert" :class="messageType">
          {{ message }}
        </div>
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            placeholder="Enter your email address"
            id="email"
            v-model="email"
          />
          <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            placeholder="Enter your password"
            id="password"
            v-model="password"
          />
          <label for="password">Password</label>
        </div>
        <div class="checkbox mb-3">
          <label>
            <span>
              Not yet a user?
              <RouterLink to="/auth/register">
                <button class="btn btn-link">Register Here</button>
              </RouterLink>
            </span>
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">
          Login
        </button>
      </form>
    </template>
  </AuthComponent>
</template>

<script setup>
import AuthComponent from "../../components/AuthComponent.vue";
import { LOGIN_MUTATION } from "../../graphql";
import { useMutation } from "@vue/apollo-composable";
import { ref } from "vue";
import { useStore } from "vuex";
import router from "../../router/index";

const email = ref("");
const password = ref("");

const store = useStore();

const { mutate: loginUser } = useMutation(LOGIN_MUTATION);

const message = ref(""); // Initialize the message variable
const messageType = ref(""); // Initialize the message type (e.g., "alert-success" or "alert-danger")

const login = async () => {
  const variables = {
    email: email.value,
    password: password.value,
  };

  try {
    const result = await loginUser(variables);

    if (result.data && result.data.login.status === 0) {
      // Login was successful, store the token in localStorage
      // localStorage.setItem("auth_token", result.data.login.token);
      message.value = result.data.login.message;
      messageType.value = "alert-danger";
    }
    if (result.data && result.data.login.status === 1) {
      let token = result.data.login.token;

      // Login was successful, store the token in localStorage
      localStorage.setItem("auth_token", token.split("|")[1]);

      store.commit("setAuthentication", true);

      message.value = result.data.login.message;
      messageType.value = "alert-success";

      // redirect user
      router.replace("/tasks");
    }

    console.log(result);
  } catch (e) {
    console.error(e);
  }
};
</script>
// import './assets/main.css'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { createApp, provide, h } from 'vue'
import App from './App.vue'
import router from './router'

import { ApolloClient, ApolloLink, InMemoryCache, from, HttpLink } from "@apollo/client/core";
import { ApolloClients } from '@vue/apollo-composable'

// Get the authorization  the localStorage
const token = localStorage.getItem('auth_token');

const additiveLink = from([
    new ApolloLink((operation, forward) => {
        operation.setContext(({ headers }) => ({
            headers: {
                ...headers,
                authorization: token ? `Bearer ${token}` : null,
            },
        }));
        return forward(operation); // Go to the next link in the chain. Similar to `next` in Express.js middleware.
    }),

    // HTTP connection to the API
    new HttpLink({ uri: "http://localhost:8000/graphql" }),
]);


// Create the apollo client
const apolloClient = new ApolloClient({
    link: additiveLink,

    // Cache implementation
    cache: new InMemoryCache(),

    connectToDevTools: true,
});


const app = createApp({
    setup() {
        provide(ApolloClients, {
            default: apolloClient,
        })
    },

    render: () => h(App),
})

// const app = createApp(App)

app.use(router)
app.mount('#app')

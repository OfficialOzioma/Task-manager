import gql from "graphql-tag";


// Mutation for user login
export const LOGIN_MUTATION = gql`
  mutation LoginMutation($email: String!, $password: String!) {
    login(
      email: $email,
      password: $password
    ) {
      status
      token
      message
    }
  }
`

export const REGISTER_MUTATION = gql`
  mutation RegisterMutation($name: String!, $email: String!, $password: String!) {
    register(
      name: $name,
      email: $email,
      password: $password
    ) {
      status
      message
      user{
        name
      }
    }
  }
`

export const CREATE_CATEGORY_MUTATION = gql`
  mutation CreateCategoryMutation($name: String!) {
    createTaskCategory(
      name: $name
    ) {
      name
    }
  }
`

// Fetch all tasks
export const FETCH_ALL_TASKS_QUERY = gql`
  query fetch_All_Tasks_Query {
    tasks {
      data {
        id
        category{
            id
            name
        }
        user_id{
            name
        }
        unique_id
        due_date
        title
        description
      }
    }
  }
`;

// Fetch one task
export const FETCH_ONE_TASK_QUERY = gql`
  query fetch_One_Task_Query($unique_id: String!) {
    task(unique_id: $unique_id) {
      title
      description
    }
  }
`;

export const FETCH_CATEGORIES_QUERY = gql`
  query FetchCategories {
     categories {
      id
      name
    }
  }
`;

// Create a task
export const CREATE_TASK_MUTATION = gql`
  mutation CreateTaskMutation($title: String!, $category_id: Int!, $description: String!, $due_date: Date!) {
    createTask(
        title: $title,
        category_id:$category_id,
        description:$description,
        due_date:$due_date,
    ) {
       status
        message
        task{
            title
            unique_id
        }
    }
  }
`;

// Update a task
export const UPDATE_TASK_MUTATION = gql`
  mutation UpdateTaskMutation($unique_id: String!, $title: String, $category_id: Int, $description: String, $status: String ) {
    updateTask(
    unique_id: $unique_id,
    title: $title,
    category_id: $category_id,
    description: $description,
    status:$status
    ) {
      status
    message
     task{
       title
     }
    }
  }
`;

// Delete a task
export const DELETE_TASK_MUTATION = gql`
  mutation DeleteTaskMutation($unique_id: String!) {
    deleteTask(unique_id: $unique_id) {
       status
    message

    }
  }
`;

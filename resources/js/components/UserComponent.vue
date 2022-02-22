<template>
  <div>
    <h1>Ползователи</h1>
    <table class="table table-bordered my-3">
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <ul
              class="d-flex align-items-center"
              v-for="role in user.roles"
              :key="role.id"
            >
              <li>{{ role.name }}</li>
              <button
                class="btn btn-light"
                @click="rmRoleToUser(user.id, role.id), getUsers()"
              >
                Удалить
              </button>
            </ul>
          </td>

          <td class="d-flex">
            <form class="d-flex form-group" @submit.prevent="addRoleToUser(user.id, selected)">
              <select class="form-control" v-model="selected">
                <option disabled>Выбрать</option>
                <option v-for="role in roles" :key="role.id" :value="role.id">
                  {{ role.name }}
                </option>
              </select>
              <button class="btn btn-success">Добавить</button>
            </form>
          </td>
          <td>
              <a class="btn btn-primary" @click="enterAsUser(user.id)">Войти</a>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="getUsers" class="btn btn-success">
      Получить пользователей
    </button>
    <h1 class="my-3">Роли</h1>
    <table class="table table-bordered my-3">
      <tbody>
        <tr v-for="role in roles" :key="role.id">
          <td>{{ role.id }}</td>
          <td>{{ role.name }}</td>
          <td>
            <button
              @click="rmRole(role.id), getRoles()"
              class="btn btn-outline-danger my-3"
            >
              Удалить
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="getRoles" class="btn btn-success">Получить роли</button>
    <div>
      <form @submit.prevent="addRole">
        <h3 class="my-3">Добавить новую роль</h3>
        <input v-model.lazy="post.name" class="form-control my-2" />
        <button class="btn btn-success my-3" type="submit">Сохранить</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
    //   value: "",
      options: [
        { text: "Один", value: "1" },
        { text: "Два", value: "2" },
        { text: "Три", value: "3" },
      ],
        // selected: "",
      users: [],
      roles: [],
      post: {
        name: [],
      },
    };
  },

  methods: {
    getUsers() {
      axios.get("/api/users").then((response) => {
        this.users = response.data;
      });
    },

    getRoles() {
      axios.get("/api/roles").then((response) => {
        this.roles = response.data;
      });
    },

    rmRoleToUser(id, role_id) {
      if (confirm()) {
        axios.post(`/api/rmRoleToUserJ/${id}`, { role_id: role_id });
      }
    },

    rmRole(id) {
      axios.post(`/api/rmRoleJ/${id}`).then((response) => {
        this.error = response.data;
        console.log(response);
        alert(this.error);
      });
    },
    addRole() {
      axios.post(`/api/addRoleJ`, { name: this.post.name });

      axios.get("/api/roles").then((response) => {
        this.roles = response.data;
      });
    },

    addRoleToUser(id, selected) {
      axios.post(`/api/addRoleToUserJ/${id}`, {role_id: selected})
      .then((response) => {
          this.success = response.data;
          console.log(response);
          alert(this.success)
      });

      axios.get("/api/users").then((response) => {
        this.users = response.data;
      });

    },

    enterAsUser(id){
        axios.get(`/api/enterAsUserJ/${id}`)
        .then((response) => {
            console.log(response)
        })
    }
  },

  mounted() {
    axios.get("/api/roles").then((response) => {
      this.roles = response.data;
      console.log(response.data);
    });

    axios.get("/api/users").then((response) => {
      this.users = response.data;
      console.log(response.data);
    });
  },
  name: "UserComponent",
};
</script>

<style scoped>
</style>

<template>
  <div>
    <form enctype="multipart/form-data">
      @csrf
      <div class="flex-column">
        <input type="hidden" v-model="user.id" name="userId" />
        <div class="form-group my-3">
          <label class="form-label">Изображение</label>
          <img class="user-picture mb-2" :src="`/storage/${user.picture}`" />
        </div>
        <div class="form-group my-3">
          <label for="picture">Фото</label>
          <input type="file" name="picture" class="form-control" />
        </div>
        <div class="form-group mb-3">
          <label for="exampleInputEmail1" class="form-label">Почта</label>
          <input
            readonly
            type="email"
            name="email"
            v-model="user.email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
          />
          <div id="emailHelp" class="form-text">
            <!-- {{ __("We'll never share your email with anyone else.") }} -->
          </div>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Имя</label>
          <input name="name" v-model="user.name" class="form-control" />
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Текущий пароль</label>
          <input
            type="password"
            autocomplete="off"
            name="current_password"
            class="form-control"
          />
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Новый пароль</label>
          <input type="password" name="password" class="form-control" />
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Повторите новый пароль</label>
          <input
            type="password"
            name="password_confirmation"
            class="form-control"
          />
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Список адресов</label>

          <ol v-for="(address, index) in user.addresses" :key="index">
            <li>
              <label
                v-if="address.main"
                class="form-check-label h5"
                for="main_address
                address.id"
                >{{ address.address }}</label
              >
              <input
                class="form-check-input"
                v-if="address.main"
                checked
                id="address.id"
                name="main_address"
                type="radio"
                v-model="address.id"
              />
            </li>
            @empty
            <em>Нет адресов</em>
            @endforelse
          </ol>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Новый адрес</label>
          <input
            name="new_address"
            class="form-control"
            placeholder="Введите новый адрес"
          />
          <div v-if="!user.addresses" class="form-check my-3">
            <label class="form-check-label" for="main_address"
              >Указать основным</label
            >
            <input
              class="form-check-input"
              name="main_address"
              type="checkbox"
            />
          </div>
        </div>
        <button class="btn btn-success">Сохранить</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["test", "user"],
  mounted() {
    console.log(this.user);
  },
};
</script>

<style scoped>
</style>

<template>
    <div>
        <table class="table table-bordered">
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
            </tr>
            </tbody>

        </table>
        <button @click="getData" class="btn btn-success">Получить</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: []
        }

    },

    methods: {
        getData() {
            axios.get('/api/test')
                .then(response => {
                    this.users = response.data
                    console.log(response.data)
                })
        }
    },
    mounted() {

        console.log('Component mounted.')
    }
}
</script>

<template>
<div class="col-md-12">
    <div class="card">
        <a href="/user/create" class="btn btn-success">Добавить пользователя</a>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
                <tr v-for="user in JSON.parse(users)">
                    <td>{{ user.id}}</td>
                    <td>{{ user.name}}</td>
                    <td>{{ user.surname}}</td>
                    <td>{{ user.patronymic}}</td>
                    <td>{{ user.role }}</td>
                    <td>
                        <a :href="'/user/' + user.id + '/edit'" class="btn btn-info">Редактировать</a>
                        <button v-on:click="deleteUser(user.id)" class="btn btn-danger">Удалить</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "Index",
        props: ['users'],
        methods: {
            deleteUser : function(id) {
                axios.delete('/user/' + id)
                .then(function (response) {
                    document.location.reload();
                }).catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>

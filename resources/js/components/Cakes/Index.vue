<template>
    <div class="col-md-12">
        <div class="card">
            <a v-if="role == 'designer'" href="/cake/create" class="btn btn-success">Добавить торт</a>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Компоненты</th>
                        <th>Действия</th>
                    </tr>
                    <tr v-for="cake in JSON.parse(cakes)">
                        <td>{{ cake.id}}</td>
                        <td>{{ cake.title}}</td>
                        <td>
                            <p v-for="component in cake.components">{{ component.title }}</p>
                        </td>
                        <td>
                            <a v-if="role == 'designer'" :href="'/cake/' + cake.id + '/edit'" class="btn btn-info">Редактировать</a>
                            <button v-on:click="deleteCake(cake.id)" class="btn btn-danger">Удалить</button>
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
        props: ['cakes', 'role'],
        methods: {
            deleteCake: function (id) {
                axios.delete('/cake/' + id)
                .then(function (response) {
                    alert('Торт успешно удалён');
                    document.location.reload()
                }).catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>

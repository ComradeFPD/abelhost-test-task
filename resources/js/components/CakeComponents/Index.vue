<template>
    <div class="col-md-12">
        <div class="card">
            <a v-if="role == 'baker'" href="/component/create" class="btn btn-success">Добавить компонент</a>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Ингредиенты</th>
                        <th>Действия</th>
                    </tr>
                    <tr v-for="component in JSON.parse(components)">
                        <td>{{ component.id}}</td>
                        <td>{{ component.title}}</td>
                        <td>
                            <p v-for="ingredient in component.ingredients">{{ ingredient.title }}</p>
                        </td>
                        <td>
                            <a v-if="role == 'baker'" :href="'/component/' + component.id + '/edit'" class="btn btn-info">Редактировать</a>
                            <button v-if="role == 'designer'" v-on:click="deleteComponent(component.id)" class="btn btn-danger">Удалить</button>
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
        props: ['components', 'role'],
        methods: {
            deleteComponent: function (id) {
                axios.delete('/component/' + id)
                .then(function (response) {
                    alert('Компонент успешно удалён');
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

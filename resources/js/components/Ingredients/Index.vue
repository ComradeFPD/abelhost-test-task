<template>
    <div class="col-md-12">
        <div class="card">
            <a href="/ingredient/create" class="btn btn-success">Добавить ингредиент</a>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                    <tr v-for="ingredient in JSON.parse(ingredients)">
                        <td>{{ ingredient.id}}</td>
                        <td>{{ ingredient.title}}</td>
                        <td>
                            <a  :href="'/ingredient/' + ingredient.id + '/edit'" class="btn btn-info">Редактировать</a>
                            <button  v-on:click="deleteIngredient(ingredient.id)" class="btn btn-danger">Удалить</button>
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
        props: ['ingredients', 'role'],
        methods: {
            deleteIngredient: function (id) {
                axios.delete('/ingredient/' + id)
                    .then(function (response) {
                        alert('Ингредиент успешно удалён');
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

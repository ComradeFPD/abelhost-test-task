<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4" for="title">Название</label>
                    <div class="col-md-6">
                        <input type="text" name="title" class="form-control" v-model="title" id="title">
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" v-on:click="submit()" class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IngredientForm",
        props: ['ingredient', 'isUpdate'],
        data: function () {
            return {
                title : this.ingredient != '' ? JSON.parse(this.ingredient).title : '',
                id : this.ingredient != '' ? JSON.parse(this.ingredient).id : ''
            }
        },
        methods: {
            submit: function () {
                const fd = new FormData();
                fd.append('title', this.title);
                let request = '';
                if(this.isUpdate){
                    fd.append('_method', 'PUT');
                    request = axios.post('/ingredient/' + this.id, fd)
                } else {
                    request = axios.post('/ingredient', fd)
                }
                request
                .then(function (response) {
                    alert('Ингредиент добавлен успешно');
                    document.location = '/ingredient';
                }).catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>

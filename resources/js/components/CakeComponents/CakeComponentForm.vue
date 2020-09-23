<template>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4" for="title">Название</label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" v-model="title" id="title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="components" class="col-md-4">Компоненты</label>
                    <div class="col-md-6">
                        <select name="ingredients[]" id="components" class="from-control custom-select" v-model="ingredientsArray" multiple>
                            <option v-for="ingredient in JSON.parse(ingredients)"  v-bind:value="ingredient.id">{{ ingredient.title }}</option>
                        </select>
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
        name: "CakeComponentForm",
        props: ['ingredients', 'component', 'isUpdate'],
        data: function () {
            return {
                id : this.component != '' ? JSON.parse(this.component).id : '',
                title : this.component != '' ? JSON.parse(this.component).title : '',
                ingredientsArray : this.component != '' ? JSON.parse(this.component).ingredient : []
            }
        },
        methods: {
            submit: function () {
                const fd = new FormData();
                fd.append('title', this.title);
                for(let i = 0; i < this.ingredientsArray.length; i++){
                    fd.append('ingredients[]', this.ingredientsArray[i]);
                }
                let request = '';
                if(this.isUpdate){
                    fd.append('_method', 'put');
                    request = axios.post('/component/' + this.id, fd)
                } else {
                    request = axios.post('/component', fd);
                }
                request
                .then(function (response) {
                    alert('Компонент успешно добавлен.');
                    document.location = '/component';
                }).catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>

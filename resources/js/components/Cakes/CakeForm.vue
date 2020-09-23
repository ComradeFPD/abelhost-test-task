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
                        <select name="components[]" id="components" class="from-control custom-select" v-model="componentsArray" multiple>
                            <option v-for="component in JSON.parse(components)"  v-bind:value="component.id">{{ component.title }}</option>
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
        name: "CakeForm",
        props: ['cake', 'components', 'isUpdate'],
        data: function () {
            return {
                id: this.cake != '' ? JSON.parse(this.cake).id : '',
                title: this.cake != '' ? JSON.parse(this.cake).title : '',
                componentsArray: this.cake != '' ? JSON.parse(this.cake).comp : [],
            }
        },
        methods: {
            submit: function () {
                const fd = new FormData();
                let arrIds = [];
                fd.append('title', this.title);
                for (let i = 0; i < this.componentsArray.length; i++){
                    fd.append('components[]', this.componentsArray[i]);
                }
                let request = '';
                if(this.isUpdate){
                    fd.append('_method', 'PUT');
                    request = axios.post('/cake/' + this.id, fd)
                } else {
                    request = axios.post('/cake', fd);
                }
                request
                .then(function (response) {
                    alert('Торт успешно добавлен');
                    document.location = '/cake';
                }).catch(function (error) {
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>

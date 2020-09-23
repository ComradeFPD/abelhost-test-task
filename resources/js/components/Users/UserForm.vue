<template>
    <div class="col-md-10">
    <div class="card">
        <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4" for="name">Имя</label>
                    <div class="col-md-6">
                    <input type="text" name="name" class="form-control" v-model="name" id="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="surname">Фамилия</label>
                    <div class="col-md-6">
                        <input type="text" name="surname" class="form-control" v-model="surname" id="surname">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="patronymic">Отчество</label>
                    <div class="col-md-6">
                        <input type="text" name="patronymic" class="form-control" v-model="patronymic" id="patronymic">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="email">Email</label>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" v-model="email" id="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4" for="password">Пароль</label>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control" v-model="password" id="password">
                    </div>
                </div>
            <div class="form-group row">
                <label for="role" class="col-md-4">Роль</label>
                <div class="col-md-6">
                <select name="role" id="role" class="from-control custom-select" v-model="role">
                    <option v-for="role in JSON.parse(roles)"  v-bind:value="role.id">{{ role.name }}</option>
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
        name: "UserForm",
        props: ['roles', 'user', 'isUpdate'],
        data: function() {
            return {
                id: this.user != '' ? JSON.parse(this.user).id : '',
                name: this.user != '' ? JSON.parse(this.user).name : '',
                surname: this.user != '' ? JSON.parse(this.user).surname : '',
                patronymic: this.user != '' ? JSON.parse(this.user).patronymic : '',
                email: this.user != '' ? JSON.parse(this.user).email : '',
                password: this.user != '' ? JSON.parse(this.user).password : '',
                role: this.user != '' ? JSON.parse(this.user).role : ''
            }
        },
        methods: {
            submit: function () {
                const fd = new FormData();
                fd.append('name', this.name);
                fd.append('surname', this.surname);
                fd.append('patronymic', this.patronymic);
                fd.append('email', this.email);
                fd.append('password', this.password);
                fd.append('role', this.role);
                let request = '';
                if(this.isUpdate){
                    fd.append('_method', 'PUT');
                    request = axios.post('/user/' + this.id, fd)
                } else {
                    request = axios.post('/user', fd)
                }
                request
                .then(function (response) {
                    alert('Пользователь успешно создан');
                    window.location = '/user';
                }).catch(function(error){
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>

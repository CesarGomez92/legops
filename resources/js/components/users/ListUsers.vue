<template>
    <div class="pb-10 mt-2 container">
        <div class="mx-auto">
            <div class="w-full px-6 pb-2 text-right">
                <el-button type="success" round @click="createUser">Crear usuario</el-button>
            </div>
            <div v-if="users" class="flex flex-wrap">
                <div class="w-full shadow rounded-lg border-2 bg-white p-4 flex flex-wrap">
                    <div class="w-full md:w-1/2">
                        <el-input placeholder="¿Deseas buscar algo?" v-model="search_key" class="input-with-select">
                            <el-button @click="searchUsers" slot="append" icon="el-icon-search"></el-button>
                        </el-input>
                    </div>
                </div>
                <div v-for="user in users" class="w-full mt-2">
                    <div class="flex flex-wrap shadow rounded-lg border-2 bg-white px-4 py-2">
                        <div class="w-full lg:w-5/6 flex flex-wrap">
                            <div class="w-full md:w-2/3 lg:w-1/4 py-1">
                                {{ user.first_name }} {{ user.last_name }}
                            </div>
                            <div class="w-full md:w-1/2 lg:w-1/4 py-1">
                                {{ user.email }}
                            </div>
                            <div class="w-1/2 md:1/3 lg:w-1/6 py-1">
                                {{ user.identification }}
                            </div>
                            <div class="w-1/2 md:1/3 lg:w-1/6 py-1">
                                {{ user.country }}
                            </div>
                            <div class="w-1/2 md:1/3 lg:w-1/6 py-1">
                                {{ user.address }}
                            </div>
                            <div class="w-1/2 md:1/3 lg:w-1/4 py-1">
                                <div v-if="user.category && user.category.name">
                                    <i class="far fa-user" v-if="user.category.name === 'Cliente'"></i>
                                    <i class="far fa-address-card" v-else-if="user.category.name === 'Proveedor'"></i>
                                    <i class="far fa-building" v-else></i>
                                    {{ user.category.name }}
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/6 pt-2">
                            <el-button @click="editUser(user.id)" type="primary" round>Editar</el-button>
                            <el-popconfirm title="¿Estas seguro que deseas eliminar este usuario?" @confirm="deleteUser(user.id)">
                                <el-button type="danger" round slot="reference">Eliminar</el-button>
                            </el-popconfirm>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <h1 class="font-bold text-lg">No se encontraron usuarios</h1>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "ListUsers",
    data() {
        return {
            users: [],
            search_key: '',
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        async getUsers() {
            try {
                const response = await axios.get('/get-users')
                this.users = response.data.users
            } catch (error) {
                console.error(error)
            }
        },
        async searchUsers() {
            try {
                const response = await axios.get('/search-users?search_key=' + this.search_key)
                this.users = response.data.users
            } catch (error) {
                console.error(error)
            }
        },
        async deleteUser(user_id) {
            try {
                const response = await axios.delete('/users/' + user_id)
                if (response.data.status === 'success') {
                    this.$notify({
                                     title: 'Eliminado',
                                     message: 'Usuario eliminado satisfactoriamente',
                                     type: 'success'
                                 });
                    this.getUsers()
                }
            } catch (error) {
                console.log(error)
            }
        },
        createUser() {
            window.location.href = '/users/create';
        },
        editUser(user_id) {
            window.location.href = '/users/' + user_id;
        }
    },
}
</script>
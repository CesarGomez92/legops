<template>
    <div class="pb-10 mt-10 container">
        <div class="shadow rounded-lg border-2 bg-white p-4 flex">
            <div class="w-full text-center">
                <h1 class="font-bold text-lg">Crear Usuario</h1>
                
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Nombres:
                    </div>
                    <div class="w-3/4">
                        <el-input v-model="first_name" minlength="5" maxlength="100" show-word-limit></el-input>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Apellidos:
                    </div>
                    <div class="w-3/4">
                        <el-input v-model="last_name" maxlength="100" show-word-limit></el-input>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Cédula:
                    </div>
                    <div class="w-3/4">
                        <el-input v-model="identification"></el-input>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        email:
                    </div>
                    <div class="w-3/4">
                        <el-input v-model="email" maxlength="150" show-word-limit></el-input>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Celular:
                    </div>
                    <div class="w-3/4">
                        <el-input v-model="cell_phone" minlength="10" maxlength="10" show-word-limit></el-input>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2" v-if="categories">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Categoria:
                    </div>
                    <div class="w-3/4">
                        <el-select v-model="category_id" placeholder="Selecciona una categoria" class="w-full">
                            <el-option
                                v-for="category in categories"
                                :key="category.id"
                                :label="category.name"
                                :value="category.id">
                            </el-option>
                        </el-select>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2" v-if="countries">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Pais:
                    </div>
                    <div class="w-3/4">
                        <el-select v-model="country" filterable placeholder="Selecciona un pais" class="w-full">
                            <el-option
                                v-for="item in countries"
                                :key="item.country"
                                :label="item.country"
                                :value="item.country">
                            </el-option>
                        </el-select>
                    </div>
                </div>
                <div class="flex flex-wrap mt-2">
                    <div class="w-1/4 text-right pr-4 pt-2">
                        Dirección:
                    </div>
                    <div class="w-3/4">
                        <el-input v-model="address" maxlength="180" show-word-limit></el-input>
                    </div>
                </div>
                <div class="text-center pt-4">
                    <el-button v-if="id === 0" @click="saveUser" type="success" round>Guardar</el-button>
                    <el-button v-else @click="saveUser" type="success" round>Actualizar</el-button>
                    <el-button round @click="cancelAction">cancelar</el-button>
                </div>
            </div>
            <div class="w-full p-4">
                <div v-if="errorValues.length" class="rounded-md bg-red-300 p-2">
                    <ul class="list-disc ml-4">
                        <li v-for="(error, key) in errorValues" :key="key">{{ error[0] }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UsersForm",
    props: {
        categories: {
            default: null,
        },
        user: {
            default: null,
        }
    },
    data() {
        return {
            id: 0,
            countries: {},
            first_name: '',
            last_name: '',
            identification: '',
            email: '',
            category_id: '',
            errors: {},
            country: '',
            address: '',
            cell_phone: '',
        }
    },
    mounted() {
        this.getCountries()
        if (this.user) {
            this.id = this.user.id
            this.first_name = this.user.first_name
            this.last_name = this.user.last_name
            this.identification = this.user.identification
            this.email = this.user.email
            this.category_id = this.user.category_id
            this.country = this.user.country
            this.address = this.user.address
            this.cell_phone = this.user.cell_phone
        }
    },
    computed: {
        errorValues () {
            return Object.keys(this.errors).length ? Object.values(this.errors) : []
        },
    },
    methods: {
        async getCountries() {
            try {
                const data = await axios.get('/get-countries')
                console.log(data.data.data)
                this.countries = data.data.data
                console.log(this.countries)
            } catch (error) {
                console.error(error)
            }
                
        },
        clearInputs(){
            this.first_name = ''
            this.last_name = ''
            this.identification = ''
            this.email = ''
            this.category_id = ''
            this.country = ''
            this.address = ''
            this.cell_phone = ''
        },
        cancelAction () {
            window.location.href = '/users';
        },
        async saveUser () {
            try {
                const result = await axios.post(`/users`, {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    identification: this.identification,
                    email: this.email,
                    category_id: this.category_id,
                    country: this.country,
                    address: this.address,
                    cell_phone: this.cell_phone,
                })
                this.$notify({
                                 title: 'Creado',
                                 message: 'Usuario creado correctamente',
                                 type: 'success'
                             });
                this.clearInputs()
                
            } catch (error) {
                this.errors = error.response?.data?.errors
            }
        },
        async updateUser () {
            try {
                const result = await axios.put(`/users/` + this.id, {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    identification: this.identification,
                    email: this.email,
                    category_id: this.category_id,
                    country: this.country,
                    address: this.address,
                    cell_phone: this.cell_phone,
                })
                this.$notify({
                                 title: 'Actualizado',
                                 message: 'Usuario actualizado correctamente',
                                 type: 'success'
                             });

            } catch (error) {
                this.errors = error.response?.data?.errors
            }
        }
    },
}
</script>

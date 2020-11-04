<template>
    <div>
        <b-form @submit="" @reset="">
            <b-form-group id="input-group-1" label="Номер НПА:" label-for="input-1">
                <b-form-input id="input-1" v-model="form.npaId" type="text" required placeholder="Номер НПА"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="ФИО держателя Договора:" label-for="input-2">
                <b-form-input id="input-2" v-model="form.fio1" type="text" required placeholder="ФИО держателя Договора"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label="ФИО назначенного лица:" label-for="input-3">
                <b-form-input id="input-3" v-model="form.fio2" type="text" required placeholder="ФИО назначенного лица"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-4" label="Уровень квалификации:" label-for="input-4">
                <b-form-select id="input-4" v-model="form.qualification" :options="qualifications"></b-form-select>
            </b-form-group>

            <b-form-group id="input-group-5" label="Номер телефона:" label-for="input-5">
                <b-form-input id="input-5" v-model="form.phone" type="text" required placeholder="Номер телефона"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-6" label="Электронная почта:" label-for="input-6">
                <b-form-input id="input-6" v-model="form.email" type="email" required placeholder="Электронная почта"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-7" label="Инстаграм (аккаунт):" label-for="input-7">
                <b-form-input id="input-7" v-model="form.instagram" type="text" required placeholder="Инстаграм (аккаунт)"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-8" label="Фотографии:" label-for="input-8">
                <b-form-file multiple accept="image/*" v-model="form.photos">
                    <template slot="file-name" slot-scope="{ names }">
                        <b-badge variant="dark" class="mr-2 p-1" v-for="name in names">{{ name }}</b-badge>
                    </template>
                </b-form-file>
            </b-form-group>


            <b-button type="submit" variant="primary">Отправить</b-button>
            <b-button type="reset" variant="danger">Сбросить</b-button>
        </b-form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    npaId: '',
                    fio1: '',
                    fio2: '',
                    qualification: '',
                    phone: '',
                    email: '',
                    instagram: '',
                    photos: [],
                },
                qualifications: ['Серебро', 'Золото']
            }
        },
    }
</script>

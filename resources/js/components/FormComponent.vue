<template>
    <div>
        <form @submit.prevent="onSumbit" method="POST">

            <b-form-group id="input-group-1" label="Номер НПА:" label-for="input-1">
                <b-form-input id="input-1" v-model="form.npaId" type="text" placeholder="Номер НПА" :state="getError('npaId')"/>
                <b-form-invalid-feedback :state="getError('npaId')">{{ form.errors.has('npaId') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-2" label="ФИО держателя Договора:" label-for="input-2">
                <b-form-input id="input-2" v-model="form.fio1" type="text" placeholder="ФИО держателя Договора" :state="getError('fio1')"></b-form-input>
                <b-form-invalid-feedback :state="getError('fio1')">{{ form.errors.has('fio1') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-3" label="ФИО назначенного лица:" label-for="input-3">
                <b-form-input id="input-3" v-model="form.fio2" type="text" placeholder="ФИО назначенного лица" :state="getError('fio2')"></b-form-input>
                <b-form-invalid-feedback :state="getError('fio2')">{{ form.errors.has('fio2') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-4" label="Уровень квалификации:" label-for="input-4">
                <b-form-select id="input-4" v-model="form.qualification" :options="qualifications" :state="getError('qualification')"></b-form-select>
                <b-form-invalid-feedback :state="getError('qualification')">{{ form.errors.has('qualification') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-5" label="Номер телефона:" label-for="input-5">
                <b-form-input id="input-5" v-model="form.phone" type="text" placeholder="Номер телефона" :state="getError('phone')"></b-form-input>
                <b-form-invalid-feedback :state="getError('phone')">{{ form.errors.has('phone') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-6" label="Электронная почта:" label-for="input-6">
                <b-form-input id="input-6" v-model="form.email" type="email" placeholder="Электронная почта" :state="getError('email')"></b-form-input>
                <b-form-invalid-feedback :state="getError('email')">{{ form.errors.has('email') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-7" label="Инстаграм (аккаунт):" label-for="input-7">
                <b-form-input id="input-7" v-model="form.instagram" type="text" placeholder="Инстаграм (аккаунт)" :state="getError('instagram')"></b-form-input>
                <b-form-invalid-feedback :state="getError('instagram')">{{ form.errors.has('instagram') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group id="input-group-8" label="Фотографии:" label-for="input-8">
                <b-form-file multiple accept="image/*" v-model="form.files" :state="getError('files')">
                    <template slot="file-name" slot-scope="{ names }">
                        <b-badge variant="dark" class="mr-2 p-1" v-for="name in names" :key="name">{{ name }}</b-badge>
                    </template>
                </b-form-file>
                <b-form-invalid-feedback :state="getError('files')">{{ form.errors.has('files') }}</b-form-invalid-feedback>
            </b-form-group>

            <b-button type="submit" variant="primary">Отправить</b-button>
        </form>
    </div>
</template>

<script>
    import Form from './Form';

    export default {
        data() {
            return {
                form: new Form({
                    npaId: '',
                    fio1: '',
                    fio2: '',
                    qualification: '',
                    phone: '',
                    email: '',
                    instagram: '',
                    files: [],
                }),
                qualifications: ['Серебро', 'Золото']
            }
        },
        methods: {
            onSumbit(){

                this.form
                  .submitFormData('/')
                  .then(response => {
                      if(response.success && response.redirect){
                          window.location.href = response.redirect;
                      }else{
                          console.log(response);
                          alert('Что то пошло не так')
                      }
                  })
                  .catch(error => {
                      console.log(error);
                      alert('Что то пошло не так');
                  });

            },
            getError(type){
                return this.form.errors.has(type) ? false : null;
            }
        }
    }
</script>

<template>
  <div>
    <b-overlay :show="loading" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block">

      <form @submit.prevent="onSumbit" method="POST">

        <b-form-group id="input-group-1">

          <slot name="label">
            <label for="input-1">Номер НПА <span class="red">*</span></label>
          </slot>
          <b-form-input
            id="input-1"
            v-model="form.npaId"
            v-mask="getNpaMask()"
            type="text"
            placeholder="Номер НПА"
            :state="getError('npaId')"
          />
          <b-form-invalid-feedback :state="getError('npaId')">{{ form.errors.has('npaId') }}</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-2">
          <slot name="label">
            <label for="input-2">ФИО держателя Договора <span class="red">*</span></label>
          </slot>
          <b-form-input id="input-2" v-model="form.fio1" type="text" placeholder="ФИО держателя Договора"
                        :state="getError('fio1')"></b-form-input>
          <b-form-invalid-feedback :state="getError('fio1')">{{ form.errors.has('fio1') }}</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-3">
          <slot name="label">
            <label for="input-3">ФИО назначенного лица <span class="red">*</span></label>
          </slot>
          <b-form-input id="input-3" v-model="form.fio2" type="text" placeholder="ФИО назначенного лица"
                        :state="getError('fio2')"></b-form-input>
          <b-form-invalid-feedback :state="getError('fio2')">{{ form.errors.has('fio2') }}</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-4">
          <slot name="label">
            <label for="input-4">Уровень квалификации <span class="red">*</span></label>
          </slot>
          <b-form-select id="input-4" v-model="form.qualification" :options="qualifications"
                         :state="getError('qualification')"></b-form-select>
          <b-form-invalid-feedback :state="getError('qualification')">{{ form.errors.has('qualification') }}
          </b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-5">
          <slot name="label">
            <label for="input-5">Номер телефона <span class="red">*</span></label>
          </slot>

          <vue-tel-input v-model="form.phone"></vue-tel-input>

          <b-form-invalid-feedback :state="getError('phone')">{{ form.errors.has('phone') }}</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-6">
          <slot name="label">
            <label for="input-6">Электронная почта <span class="red">*</span></label>
          </slot>
          <b-form-input id="input-6" v-model="form.email" type="text" placeholder="Электронная почта"
                        :state="getError('email')"></b-form-input>
          <b-form-invalid-feedback :state="getError('email')">{{ form.errors.has('email') }}</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-7">
          <slot name="label">
            <label for="input-7">Инстаграм (аккаунт) <span class="red">*</span></label>
          </slot>
          <b-form-input id="input-7" v-model="form.instagram" type="text" placeholder="Инстаграм (аккаунт)"
                        :state="getError('instagram')"></b-form-input>
          <b-form-invalid-feedback :state="getError('instagram')">{{ form.errors.has('instagram') }}
          </b-form-invalid-feedback>
        </b-form-group>

        <b-form-group id="input-group-8" description="Фотография должна быть не менее 512 килобайт и размер не менее 1000 пикселей по высоте и ширине">
          <slot name="label">
            <label for="input-8">Фотографии <span class="red">*</span></label>
          </slot>

          <image-loader @load-image="loadImage($event)"/>

          <b-form-invalid-feedback :state="getError('files')">{{ form.errors.has('files') }}</b-form-invalid-feedback>

          <template v-for="(e, index) in 10">
            <b-form-invalid-feedback :key="index" :state="getError('files.' + index)"
                                     v-for="err in form.errors.hasArray('files.' + index)">
              {{ getFileName(err, index) }}
            </b-form-invalid-feedback>
          </template>

        </b-form-group>

        <div class="row">
          <div class="col-md-10">
            <b-alert show variant="light">
              Все поля, отмеченные красной <span class="red">*</span> - являются обязательными к заполнению. В
              случае если у Вас нет назначенного лица, адреса электронной почты и/или аккаунта в Инстаграм, просим
              Вас проставить в соответствующем(-их) поле(-ях) прочерк
            </b-alert>
          </div>
        </div>


        <b-button type="submit" variant="primary" :disabled="!isValid">Отправить</b-button>
      </form>

    </b-overlay>
  </div>
</template>

<script>
  import Form from './Form';
  import ImageLoader from './ImageLoader';

  export default {
    components:{
      ImageLoader
    },
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
        loading: false,
        qualifications: ['Серебро', 'Золото']
      }
    },
    computed: {
      isValid() {
        let f = this.form;
        return !!(f.npaId.length
          && f.fio1.length
          && f.fio2.length
          && f.qualification.length
          && f.phone.length
          && f.email.length
          && f.instagram.length
          && f.files.length);
      }
    },
    methods: {
      onSumbit() {

        this.loading = true;

        this.form
          .submitFormData('/')
          .then(response => {
            if (response.success && response.redirect) {
              window.location.href = response.redirect;
            } else {
              console.log(response);
              alert('Что то пошло не так')
            }
            this.loading = false;
          })
          .catch(error => {
            console.log(error);
            this.loading = false;

          });

      },
      getNpaMask() {
        return this.form.npaId.length > 7 ? '### ### ### #' : '### ### #';
      },
      getError(type) {
        return this.form.errors.has(type) ? false : null;
      },
      getFileName(error, index) {
        let f = this.form.files;
        let f_name = (f[index] && f[index].name) || '';
        if (f_name) {
          return error.replace(`files.${index}`, f_name);
        }
        return error;
      },
      loadImage(files) {
        this.form.files = [...files];
      },
    }
  }
</script>

<style scoped>
  span.red {
    color: red;
  }
</style>
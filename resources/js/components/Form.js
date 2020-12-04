import qs from 'qs';


async function getRecaptchaToken() {
    const key = _.get(document.querySelector("meta[name='captcha-token']"), 'content', '');
    return grecaptcha.execute(key).then((token) => token);
}

class Errors{

    constructor()
    {
        this.errors = {};
    }

    record(errors){
        this.errors = errors;
    }

    has(field){
        if(this.errors[field]){
            return this.errors[field][0];
        }
    }

    hasArray(field){
        if(this.errors[field]){
            return this.errors[field];
        }
    }

    any(){
        return Object.keys(this.errors).length > 0;
    }

    clear(field){
        if (field){
            delete this.errors[field];
            return;
        }

        this.errors = {};
    }

}

export default class Form{

    constructor(data)
    {
        this.originalData = data;

        for(let field in data){
            this[field] = data[field];
        }

        this.errors = new Errors();

        this.message = null;

    }

    reset(){
        for(let field in this.originalData){
            this[field] = '';
        }
    }

    data(){
        let data = Object.assign({}, this);
        delete data.errors;
        delete data.originalData;
        delete data.message;
        return data;
    }

    /**
     * Отправка формы
     * @param requestType
     * @param url
     * @param captcha
     * @returns {Promise<*>}
     */
    async submit(requestType, url, captcha = false)
    {
        let data = this.data();

        if (captcha) {
            await getRecaptchaToken().then(token => data.recapcha = token);
        }

        return new Promise((resolve, reject) => {

            ajax[requestType](url, qs.stringify(data))
                .then(response => {
                    this.errors.clear();
                    //this.reset();
                    this.onSuccess(response);

                    this.message = null;
                    if(response.data.data.message){
                        this.message = response.data.data.message;
                    }

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error);
                    this.message = null;
                    reject(error);
                });
        })

    }

    submitFormData(url){
        return new Promise((resolve, reject) => {

            let bodyFormData = this.createFormData();

            axios({
                method: 'post',
                url: url,
                data: bodyFormData,
                config: { headers: {'Content-Type': 'multipart/form-data' }}
            })
            .then(response => {
                this.errors.clear();
                //this.reset();
                this.onSuccess(response);

                this.message = null;

                if(_.get(response, 'data.data.message')){
                    this.message = response.data.data.message;
                }

                resolve(response.data);
            })
            .catch(error => {
                this.onFail(error);
                this.message = null;
                reject(error);
            });

        })
    }

    onSuccess(response) {

    }

    onFail(error){
        if(error.response.data.errors){
            this.errors.record(error.response.data.errors);
        }
    }

    /**
     * Если
     * есть
     * картинки
     * @returns {FormData}
     *     https://stackoverflow.com/questions/47630163/axios-post-request-to-send-form-data?rq=1
     */
    createFormData()
    {
        let bodyFormData = new FormData();

        _.forEach(this.originalData, (value, key) => {
            if (key === 'files')
            {
                this.files.forEach((file, index) => {
                    if(file) bodyFormData.append(`files[${index}]`, file);
                })

            }
            else if (key === 'file')
            {
                if(this[key]) bodyFormData.append(`file`, this[key]);
            }
            else
            {
                if(this[key]) bodyFormData.set(key, this[key]);
            }
        });

        return bodyFormData;
    }
}

<template>
  <div class="photoFrame_wrapper">
    <div v-for="n in limit" class="photoFrame position-relative" :key="n">
        <input type="file" @change="Upload" class="photoFrame_input" accept="image/*">
        <div class="photoFrame_slot">
          <button type="button" class="imgRemove" @click="removeImage($event, n-1)">
            <img src="/img/trash.svg" alt="#">
          </button>
        </div>
    </div>
  </div>
</template>

<script>
  export default {
    data: () => ({
      files_uploaded: [],
      limit: 3
    }),
    methods: {
      Upload(event) {
        var inputElement = event.target;
        var file = inputElement.files[0];
        if (file instanceof Blob) {
          let reader = new FileReader();
          reader.readAsDataURL(file);

          reader.onload = event => {
            let source = event.target.result;
            inputElement.nextElementSibling.style.background = `url(${source}) center no-repeat, #f7eeec`;
            inputElement.nextElementSibling.style.backgroundSize = `contain`;
            inputElement.nextElementSibling.firstElementChild.style.display = 'block';
          }

          this.files_uploaded.push(file);

          this.$emit('load-image', this.files_uploaded);
        }
      },
      removeImage(event, fileIndex) {
        var defaultImage = 'url(/img/camera.svg) center no-repeat, #f7eeec';
        var clicked = event.currentTarget;

        if (confirm("Вы уверены?")) {
          clicked.parentElement.style.background = defaultImage;
          clicked.style.display = 'none';

          this.files_uploaded.splice(fileIndex, 1);

          let fileInputes = document.querySelectorAll('.photoFrame_input');
          if (fileInputes[fileIndex]) {
            fileInputes[fileIndex].value = '';
          }

          this.$emit('load-image', this.files_uploaded);
        }
      },
      getUrl(file) {
        return file.url;
      }
    }
  }
</script>

<style scoped>

  .photoFrame_wrapper {
    display: flex;
    flex-wrap: wrap;
    position: relative;
  }
  .photoFrame_input {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 10;
    border: 2px solid black;
    width: 100%;
    background: black;
    opacity: 0;
    cursor: pointer;
  }
  .photoFrame_slot {
    background: url(/img/camera.svg) center no-repeat, #f7eeec;
    width: 105px;
    height: 105px;
    border: 1px solid #f4e5e2;
    margin-right: 10px;
    margin-bottom: 10px;
  }
  .imgRemove {
    z-index: 11;
    position: absolute;
    right: 0;
    top: 0;
    width: 26px;
    height: 26px;
    background: white;
    display: none;
    border: none;
  }
</style>

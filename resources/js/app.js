import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: 'Sube tu imagen aqui',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    }
});

dropzone.on('success', function (file, response) {
    //seleccionar el input hidden en el dom, y agregarle como valor (value) en nombre de la imagen subida
    document.querySelector('[name="imagen"]').value = response.imagen
    console.log()
});

dropzone.on('removedfile', function () {
    document.querySelector('[name="imagen"]').value = ''
});
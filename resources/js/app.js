import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,
    maxFilesize: 5,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone.on("sending", function (file, xhr, formData) {
    console.log(formData);
});

dropzone.on("success", function (file, response) {
    console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("error", function (file, message) {
    if (file.size > dropzone.options.maxFilesize * 1024 * 1024) {
        dropzone.removeFile(file); // Opcional: elimina el archivo de la vista de Dropzone
        alert("El archivo es demasiado grande. El tamaño máximo permitido es de 5 MB.");
    } else {
        dropzone.removeFile(file);
        alert("La imagen que intentas subir, puede estar dañada, tenga algun formato que el servidor no pueda procesar o excedio el tamaño requerido (pixeles), recorta la imagen o intenta subir otra"); // Muestra otros errores
    }
});

dropzone.on("removedfile", function () {
    console.log("Archivo Eliminado");
    document.querySelector('[name="imagen"]').value = "";
});
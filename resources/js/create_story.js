import Dropzone from 'dropzone';

document.addEventListener("DOMContentLoaded", function() {


    Dropzone.autoDiscover = false;

    var storeUrl = document.querySelector('meta[name="store-url"]').getAttribute('content');
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(storeUrl);

    // Fonction pour envoyer le formulaire sans image
    function sendFormWithoutImage() {
        var formData = new FormData();
        formData.append("_token", csrfToken);
        formData.append("title", document.querySelector("#title").value);
        formData.append("accroche", document.querySelector("#accroche").value);
        formData.append("note", document.querySelector("#note").value);
        formData.append("tags", document.querySelector("#tags").value);

        fetch(storeUrl, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log("Formulaire envoyé avec succès :", data);
            // Rediriger après le succès
            window.location.href = data.redirectUrl;
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi du formulaire :", error);
        });
    }

    var myDropzone = new Dropzone("div#dropzoneDragArea", {
        paramName: "illustration",
        url:storeUrl,
        // previewsContainer: "div.previews",
        maxFiles: 1,
        autoProcessQueue: false,
        parallelUploads: 100,
        dictDefaultMessage: "Cliquez ou déposez votre illustration ici",
        acceptedFiles: "image/*",
        clickable: true,
        init: function() {
            var myDropzone = this;
            document.querySelector("#valide_but").addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Validation des champs du formulaire côté client
                var title = document.querySelector("#title").value;
                var tags = document.querySelector("#tags").value;

                if (!title) {
                    alert("Le titre est obligatoire.");
                    return;
                } else if (!tags) {
                    alert("Sélectionner au moins un tag");
                    return;
                }

                if (myDropzone.getAcceptedFiles().length > 0) myDropzone.processQueue();
                else sendFormWithoutImage();

                });

            this.on("sending", function(file, xhr, formData) {
                // Ajouter le token CSRF au formData
                formData.append("_token", csrfToken);

                // Ajouter les autres champs du formulaire
                formData.append("title", document.querySelector("#title").value);
                formData.append("accroche", document.querySelector("#accroche").value);
                formData.append("note", document.querySelector("#note").value);
                formData.append("tags", document.querySelector("#tags").value);
            });

            // Réception du succès du serveur
            this.on("success", function(file, response) {
                if (response.success) {
                    // Rediriger vers la page de la nouvelle histoire
                    window.location.href = response.redirectUrl;
                } else {
                    alert("Une erreur s'est produite lors de l'envoi.");
                }
            });
            },
        },
    )

});

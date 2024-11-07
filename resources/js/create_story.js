import Dropzone from 'dropzone';
import { Editor } from 'https://esm.sh/@tiptap/core@2.6.6';
import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.6.6';
import Highlight from 'https://esm.sh/@tiptap/extension-highlight@2.6.6';
import Underline from 'https://esm.sh/@tiptap/extension-underline@2.6.6';
import Link from 'https://esm.sh/@tiptap/extension-link@2.6.6';
import TextAlign from 'https://esm.sh/@tiptap/extension-text-align@2.6.6';
import HorizontalRule from 'https://esm.sh/@tiptap/extension-horizontal-rule@2.6.6';
import Image from 'https://esm.sh/@tiptap/extension-image@2.6.6';
import TextStyle from 'https://esm.sh/@tiptap/extension-text-style@2.6.6';
import { Color } from 'https://esm.sh/@tiptap/extension-color@2.6.6';
import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder@2.6.6';

document.addEventListener("DOMContentLoaded", function() {
    var father_id = null;
    const fatheridElement = document.querySelector("#father_id")
    if (fatheridElement) {
        father_id = fatheridElement.value
        console.log("Father ID:", father_id);
    };


    Dropzone.autoDiscover = false;

    var storeUrl = document.querySelector('meta[name="store-url"]').getAttribute('content');
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // console.log(storeUrl);


    function form_create(formData) {
        // Father id
        var father_id = null;
        const fatheridElement = document.querySelector("#father_id")
        if (fatheridElement) father_id = fatheridElement.value;
        console.log("Father ID:", father_id);
        console.log("null");

        // end
        var end = 0;
        const endElement = document.querySelector("#end")
        if (endElement) end = endElement.checked ? 1 : 0;

        // reponse
        const reponseElement = document.querySelector("#reponse")
        var rep = null;
        if (reponseElement) {
            if (reponseElement.value.trim() === "") rep = document.querySelector("#question").value;
            else rep = reponseElement.value;
        }

        // ajout des infos dans le formulaire
        formData.append("_token", csrfToken);
        formData.append("title", document.querySelector("#title").value);
        formData.append("accroche", document.querySelector("#accroche").value);
        formData.append("note", document.querySelector("#note").value);
        formData.append("tags", document.querySelector("#tags").value);
        formData.append("question", document.querySelector("#question").value);
        formData.append("reponse", rep);
        formData.append("father_id", father_id);
        formData.append("end", end);
        formData.append("contentEditeur", editor.getHTML().trim());
    }


    // tip tap editor setup
    const editor = new Editor({
        element: document.querySelector('#wysiwyg-example'),
        extensions: [
            StarterKit,
            Highlight,
            Underline,
            Link.configure({
                openOnClick: false,
                autolink: true,
                defaultProtocol: 'https',
            }),
            TextAlign.configure({
                types: ['heading', 'paragraph'],
            }),
            HorizontalRule,
            Image,
            TextStyle,
            Color,
            Placeholder.configure({
                placeholder: "Start to write here...", // Ton texte de placeholder
            }),
        ],
        editorProps: {
            attributes: {
                class: 'format lg:format-lg dark:format-invert focus:outline-none format-blue max-w-none',
            },
        }
    });

    // Fonction pour envoyer le formulaire sans image
    function sendFormWithoutImage() {
        var formData = new FormData();
        form_create(formData);

        fetch(storeUrl, {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            console.log("Formulaire envoyé avec succès :", data);
            // Rediriger après le succès
            window.location.href = data.redirectUrl;
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi du formulaire :", error.message);
            // Affiche l'erreur HTML complète si c'est une erreur 500
            document.body.innerHTML = error.message;
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
        addRemoveLinks: true, // Ajoute un lien "Remove"
        clickable: true,
        // previewsContainer: ".previews",
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
                } else if (editor.getHTML().trim() == "") {

                    alert("Aucune histoire écrite");
                    return;

                } else if (!tags) {
                    alert("Sélectionner au moins un tag");
                    return;
                }

                if (myDropzone.getAcceptedFiles().length > 0) myDropzone.processQueue();
                else sendFormWithoutImage();

                });

            this.on("sending", function(file, xhr, formData) {
               form_create(formData);

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

            // Masque le texte lorsqu'un fichier est ajouté
            this.on("addedfile", function(file) {
                document.querySelectorAll('.togone').forEach((element) => {
                    element.style.display = 'none'
                });
            });

            // Remettre le texte lorsqu'un fichier est supprimé
            this.on("removedfile", function(file) {
                document.querySelectorAll('.togone').forEach((element) => {
                    element.style.display = 'block'
                });
                myDropzone.setupEventListeners();
            });

            this.on('maxfilesreached', function() {
                myDropzone.removeEventListeners();
            });
            },


        },
    )

    window.addEventListener('load', function() {
        if (document.getElementById("wysiwyg-example")) {

        const FontSizeTextStyle = TextStyle.extend({
            addAttributes() {
                return {
                fontSize: {
                    default: null,
                    parseHTML: element => element.style.fontSize,
                    renderHTML: attributes => {
                    if (!attributes.fontSize) {
                        return {};
                    }
                    return { style: 'font-size: ' + attributes.fontSize };
                    },
                },
                };
            },
        });


        // set up custom event listeners for the buttons
        document.getElementById('toggleBoldButton').addEventListener('click', () => editor.chain().focus().toggleBold().run());
        document.getElementById('toggleItalicButton').addEventListener('click', () => editor.chain().focus().toggleItalic().run());
        document.getElementById('toggleUnderlineButton').addEventListener('click', () => editor.chain().focus().toggleUnderline().run());
        document.getElementById('toggleStrikeButton').addEventListener('click', () => editor.chain().focus().toggleStrike().run());
        document.getElementById('toggleHighlightButton').addEventListener('click', () => editor.chain().focus().toggleHighlight({ color: '#ffc078' }).run());
        document.getElementById('toggleLinkButton').addEventListener('click', () => {
            const url = window.prompt('Enter image URL:', 'https://flowbite.com');
            editor.chain().focus().toggleLink({ href: url }).run();
        });
        document.getElementById('removeLinkButton').addEventListener('click', () => {
            editor.chain().focus().unsetLink().run()
        });

        document.getElementById('toggleLeftAlignButton').addEventListener('click', () => {
            editor.chain().focus().setTextAlign('left').run();
        });
        document.getElementById('toggleCenterAlignButton').addEventListener('click', () => {
            editor.chain().focus().setTextAlign('center').run();
        });
        document.getElementById('toggleRightAlignButton').addEventListener('click', () => {
            editor.chain().focus().setTextAlign('right').run();
        });
        document.getElementById('toggleListButton').addEventListener('click', () => {
           editor.chain().focus().toggleBulletList().run();
        });
        document.getElementById('toggleOrderedListButton').addEventListener('click', () => {
            editor.chain().focus().toggleOrderedList().run();
        });
        document.getElementById('toggleBlockquoteButton').addEventListener('click', () => {
            editor.chain().focus().toggleBlockquote().run();
        });
        document.getElementById('toggleHRButton').addEventListener('click', () => {
            editor.chain().focus().setHorizontalRule().run();
        });
        document.getElementById('addImageButton').addEventListener('click', () => {
            const url = window.prompt('Enter image URL:', 'https://placehold.co/600x400');
            if (url) {
                editor.chain().focus().setImage({ src: url }).run();
            }
        });


        // typography dropdown
        const typographyDropdown = FlowbiteInstances.getInstance('Dropdown', 'typographyDropdown');

        document.getElementById('toggleParagraphButton').addEventListener('click', () => {
            editor.chain().focus().setParagraph().run();
            typographyDropdown.hide();
        });

        document.querySelectorAll('[data-heading-level]').forEach((button) => {
            button.addEventListener('click', () => {
                const level = button.getAttribute('data-heading-level');
                editor.chain().focus().toggleHeading({ level: parseInt(level) }).run()
                typographyDropdown.hide();
            });
        });

        const textSizeDropdown = FlowbiteInstances.getInstance('Dropdown', 'textSizeDropdown');

        // Loop through all elements with the data-text-size attribute
        document.querySelectorAll('[data-text-size]').forEach((button) => {
            button.addEventListener('click', () => {
                const fontSize = button.getAttribute('data-text-size');

                // Apply the selected font size via pixels using the TipTap editor chain
                editor.chain().focus().setMark('textStyle', { fontSize }).run();

                // Hide the dropdown after selection
                textSizeDropdown.hide();
            });
        });

        // Listen for color picker changes
        const colorPicker = document.getElementById('color');
        colorPicker.addEventListener('input', (event) => {
            const selectedColor = event.target.value;

            // Apply the selected color to the selected text
            editor.chain().focus().setColor(selectedColor).run();
        })

        document.querySelectorAll('[data-hex-color]').forEach((button) => {
            button.addEventListener('click', () => {
                const selectedColor = button.getAttribute('data-hex-color');

                // Apply the selected color to the selected text
                editor.chain().focus().setColor(selectedColor).run();
            });
        });

        document.getElementById('reset-color').addEventListener('click', () => {
            editor.commands.unsetColor();
        })


    }
    })



});

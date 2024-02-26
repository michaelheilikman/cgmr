$(function() {
    $('.add-new-page').on("click", function() {
        var website = $(this).data('website');
        
        $.ajax({
            type: 'POST',
            url: 'insert/new--page.php',
            data: { 'website': website },
            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                if (data.success) {
                    //$('#pagesList').append('<div>' + data.newPageId.from_site + '</div>');
                    window.location.href = 'pageSingle.php?id=' + data.newPageId;
                } else {
                    // Gérer l'échec de l'ajout
                    console.log(data.message);
                }
            },
            error: function() {
                console.log("Erreur lors de l'ajout de la page");
            }
        });
    });
});

$(function() {
    var dropZoneCounter = 0; // Compteur pour créer des zones uniques

    $('#addImage').on("click", function() {
        var website = $(this).data('website');
        var pageId = $(this).data('page-id');
        var newDropZoneId = 'dropZone' + dropZoneCounter++;

        // Créer une nouvelle zone de drag and drop
        var newDropZone = $('<div>', {
            id: newDropZoneId,
            class: 'drop-zone',
            text: 'Glissez-déposez une image ici ou cliquez pour sélectionner',
            'data-website': website,
            'data-page-id': pageId,
            css: {
                border: '2px dashed #ccc',
                height: '200px',
                width: '300px',
                marginTop: '10px'
            }
        }).appendTo('.dropZones');

        initializeDropZone(newDropZone);
    });

    function initializeDropZone(dropZone) {
        dropZone.on('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('dragover');
        });

        dropZone.on('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');
        });

        dropZone.on('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('dragover');

            var files = e.originalEvent.dataTransfer.files;
            var website = $(this).data('website');
            var pageId = $(this).data('page-id');
            handleFileUpload(files, website, pageId, $(this));
        });

        // Permettre de cliquer pour uploader
        dropZone.on("click", function() {
            $('<input type="file" hidden />').appendTo('body').click().on('change', function(e) {
                var files = e.target.files;
                var website = dropZone.data('website');
                var pageId = dropZone.data('page-id');
                handleFileUpload(files, website, pageId, dropZone);
            });
        });
    }

    function handleFileUpload(files, website, pageId, dropZone) {
        var uploadedFile = files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            dropZone.html($('<img>', {src: e.target.result, style: 'width: 100%'}));
            uploadImage(uploadedFile, website, pageId, dropZone);
        };

        reader.readAsDataURL(uploadedFile);
    }

    function uploadImage(file, website, pageId, dropZone, columnNumber) {
        var formData = new FormData();
        formData.append('image', file);
        formData.append('from_site', website);
        formData.append('tool_type', 'image');
        formData.append('page_id', pageId);

        $.ajax({
            url: 'insert/modules/image.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    if(columnNumber){

                    }else{
                        var newImageHtml = '<div id="' + data.tool_id + '" class="image-container image-container-' + data.tool_id + '">' +
                        '<img src="upload/thumb/' + data.imageName + '" alt="' + data.imageName + '" width="300">' +
                        '<div class="image-actions">' +
                        '<button class="edit-btn" data-tool-id="' + data.tool_id + '">Éditer</button>' +
                        '<button class="delete-btn" data-tool-id="' + data.tool_id + '">Supprimer</button>' +
                        '</div></div>';

                        $('#content').append(newImageHtml);

                        // Masquer la dropZone
                        dropZone.hide();
                    }
                } else {
                    alert('Erreur lors de l\'envoi de l\'image.');
                }
            },
            error: function() {
                alert('Erreur lors de l\'envoi de l\'image.');
            }
        });
    }
});

$(function() {
    $('.edit-btn').on("click", function() {
        var toolId = $(this).data('tool-id');
        // Logique pour éditer l'image
        console.log('Éditer l\'image avec tool_id:', toolId);
    });

    $('.delete-btn').on("click", function() {
        var toolId = $(this).data('tool-id');
        $.ajax({
            url: 'delete/del--image.php', 
            type: 'POST',
            data: { tool_id: toolId },
            success: function(response) {
                console.log(response);
                $('.image-container-' + toolId).remove();
            },
            error: function() {
                alert('Erreur lors de la suppression de l\'image.');
            }
        });
    });
    
});


$(function() {
    $('#addTwoColumns').on('click', function(e) {
        e.preventDefault();
        var website = $(this).data('website');
        var pageId = $(this).data('page-id');

        // Créer la structure HTML pour le module "2 colonnes"
        var twoColumnsHtml = '<div class="two-columns-module bg-light" height="300px" width="100%" data-tool-type="two-columns">' +
            '<div class="column" data-column="1"></div>' +
            '<div class="column" data-column="2"></div>' +
            '</div>';

        // Ajouter cette structure au contenu de la page
        $('#content').append(twoColumnsHtml);

        saveTwoColumnsModule(website, pageId);
    });
});

function saveTwoColumnsModule(website, pageId) {
    var formData = new FormData();
    formData.append('from_site', website);
    formData.append('tool_type', 'two-columns');
    formData.append('page_id', pageId);

    $.ajax({
        url: 'insert/modules/twoColumns.php', // URL du script PHP
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                console.log("Module '2 colonnes' ajouté avec succès. ID: ", data.newToolId);
            } else {
                console.error('Erreur lors de l\'enregistrement du module : ', data.error);
            }
        },
        error: function() {
            alert('Erreur lors de la communication avec le serveur.');
        }
    });
}

$(function() {
    $('.sortable').sortable({
        opacity: 0.7,
        cancel:".unMove",
        cursor:"move",
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
            // change order in the database using Ajax
            $.ajax({
                url: 'load/tools_order.php',
                type: 'POST',
                data: {list_order:list_sortable},
                success: function(data) {
                    $('.saveActive').addClass('spinner-border')
                    $('.saveActive').addClass('mr-1')
                    setTimeout(function(){
                        $('.saveActive').removeClass('spinner-border')
                        $('.saveActive').removeClass('mr-1')
                        $(':focus').blur()
                    },500);
                }
            });
        }
    }); // fin sortable
});
$(function() {
    $('.crossnav').click(function() {
        $(this).toggleClass('active');
    });
    $('.closeCrossnav').click(function(){
        $('.crossnav').toggleClass('active');
    })
});

$(function() {
    $('.closeCanvas').click(function(e) {
        var offcanvasElement = $('#offcanvasRight.show');
        offcanvasElement.offcanvas('hide');
        $('.crossnav').toggleClass('active');
    });
});



$(function(){
    $(".input-group-text").on('click', function(e){
        e.preventDefault();
        if($(this).prev('.show_hide_password').children('input').attr("type") == "text"){
            $(this).prev('.show_hide_password').children('input').attr('type', 'password');
            $(this).children('i').addClass( "bi bi-eye-slash" );
            $(this).children('i').removeClass( "bi bi-eye" );
        }else if($(this).prev('.show_hide_password').children('input').attr("type") == "password"){
            $(this).prev('.show_hide_password').children('input').attr('type', 'text');
            $(this).children('i').removeClass( "bi bi-eye-slash" );
            $(this).children('i').addClass( "bi bi-eye" );
        }
    });
});

$(function() {
    $(".input-group-append").on('click', function(event) {
        event.preventDefault();
        if($(this).parent('.show_hide_password').children('input').attr("type") == "text"){
            $(this).parent('.show_hide_password').children('input').attr('type', 'password');
            $(this).children('span').children('i').addClass( "bi bi-eye-slash" );
            $(this).children('span').children('i').removeClass( "bi bi-eye" );
        }else if($(this).parent('.show_hide_password').children('input').attr("type") == "password"){
            $(this).parent('.show_hide_password').children('input').attr('type', 'text');
            $(this).children('span').children('i').removeClass( "bi bi-eye-slash" );
            $(this).children('span').children('i').addClass( "bi bi-eye" );
        }
    });
}); 

$(function(){
    $(document).on('scroll',function () {
        var y = $(this).scrollTop();
        if (y > 700) {
            $('.newsletter').addClass('active');
        } else {
            $('.newsletter').removeClass('active');
        }
    
    });
})

$(function(){
    $('[data-toggle="tooltip"]').tooltip()
})

$(function(){
    $('form').attr("autocomplete", "off");
})

$(function() {
    $('#summernote1').summernote({
        height:250,
    });
    $('.note-editor').addClass('bg-white')
});

$(function(){
    $('a.anchor').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        $('html, body').animate({ 
            scrollTop:$(href).position().top-40
        },'slow');
    });
});

$(function(){
    if($("#js-typedjs").length){
      var typed = new Typed('#js-typedjs', {
          strings: ['Votre rêve, notre expertise'],
          typeSpeed: 60,
          backSpeed: 20,
          backDelay: 500,
          startDelay: 300,
          loop: false,
          shuffle: false,
          onComplete: function () {
            setTimeout(function() {
                $(".typed-cursor").fadeOut();
            }, 2000); // 1000 millisecondes équivalent à 1 seconde
          }
      });
    }
});

$(function(){
    if($("#js-typedjs-mobile").length){
      var typed = new Typed('#js-typedjs-mobile', {
          strings: ['Votre rêve, notre expertise'],
          typeSpeed: 60,
          backSpeed: 20,
          backDelay: 500,
          startDelay: 300,
          loop: false,
          shuffle: false,
          onComplete: function () {
            setTimeout(function() {
                $(".typed-cursor").fadeOut();
            }, 2000); // 1000 millisecondes équivalent à 1 seconde
          }
      });
    }
});

//backoffice

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#hiddenFile').attr('value', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#file-input").on('change',function(){
    readURL(this);
});

$('#pageSubmit').on('click',function(e){
    e.preventDefault();
    $('.saveActive').addClass('spinner-border');
    $('.saveActive').addClass('mr-1');
    $(':focus').trigger('blur');
    setTimeout(function(){
        $('#pageSubmit').off('click');
        $('#pageSubmit').trigger('click');
    }, 1500);
});
$('#submitFormBlog').on('click',function(e){
    e.preventDefault();
    $('.saveActive').addClass('spinner-border');
    $('.saveActive').addClass('mr-1');
    $(':focus').trigger('blur')
    setTimeout(function(){
        $('#submitFormBlog').off('click');
        $('#submitFormBlog').trigger('click');
    }, 1500);
});

$(document).ready(function () {
    var textarea = $('#page_title');

    // Appeler la fonction de redimensionnement initiale
    autoResizeTextarea();

    // Attacher un gestionnaire d'événements à l'entrée de texte pour redimensionner le textarea
    textarea.on('input', autoResizeTextarea);

    function autoResizeTextarea() {
        // Réinitialiser la hauteur à 0 pour obtenir la hauteur de la totalité du contenu
        textarea.height(0);
        
        // Ajuster la hauteur du textarea en fonction du contenu et ajouter un peu de marge
        textarea.height(textarea[0].scrollHeight + 10);
    }
});

$(function(){
    $(".calendrier td").on('click', function(){
        var getClassDate = $(this).attr('class');
        $('.getDate').attr("id","date-"+getClassDate);
        $('#getTheDate').attr("value",getClassDate);
    })
});

var anchor = window.location.hash;
$('.tabs').each(function() {
    var current = null;
    var id = $(this).attr('id');
    if(anchor != '' && $(this).find('a[href="'+anchor+'"]').length > 0) {
        current = anchor;
    } else if($.cookie('tab'+id) && $(this).find('a[href="'+$.cookie('tab'+id)+'"]').length > 0) {
        current = $.cookie('tab'+id);
    } else {
        current = $(this).find('a:first').attr('href');
    }
    $(this).find('a[href="'+current+'"]').addClass('active');
    $(current).addClass('active').siblings().hide();
    $(this).find('a').on('click',function() {
        var link = $(this).attr('href');
        if(link == current) {
            return false;
        } else {
            $('.tabs').find('a').removeClass('active');
            $(this).addClass('active');
            $(link).addClass('active').show().siblings().hide().removeClass('active');
            current = link;
            $.cookie('tab'+id, current);
        }
        return false;
    })
});

$(function(){
    $(".chatBox--icon").on('click',function(){
        $(".chatBox").toggleClass('chatBox--open');
    })
    $(document).on('keyup',function(c){
        if(c.key === 27)
        $(".chatBox").removeClass('chatBox--open');
    })
})


$(function(){
    $('.supprimer').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getImage = $(this).attr('data-img');
        var removeURL = "remove/delDoc.php?";
        $('#getValue').attr("href", "remove/delDoc.php?id="+getIdAttribute+"&file="+getImage);
    });

    $('.suppr_contact').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        var removeURL = "remove/delUser.php?";
        $('#getValue').attr("href", "remove/delUser.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });

    $('.suppr_company').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        var removeURL = "remove/delUser.php?";
        $('#getValue').attr("href", "remove/delEnt.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
    $('.suppr_action').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        var removeURL = "remove/delAction.php?";
        $('#getValue').attr("href", "remove/delAction.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });

    $('.suppr_event').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-date');
        $('#getValue').attr("href", "remove/delEvent.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });

    $('.suppr_blog').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        var removeURL = "remove/delBlog.php?";
        $('#getValue').attr("href", "remove/delBlog.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
    $('.suppr_page').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        var removeURL = "remove/delBlog.php?";
        $('#getValue').attr("href", "remove/delPage.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
    $('.suppr_tool').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        $('#getValue').attr("href", "remove/delTool.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
    $('.suppr_cat').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        $('#getValue').attr("href", "remove/delCat.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
    $('.suppr_key').bind('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        $('#getValue').attr("href", "remove/delKey.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
    $('.suppr_newsletter').on('click', function(){
        var getIdAttribute = $(this).attr('id');
        var getUserName = $(this).attr('data-name');
        $('#getValue').attr("href", "remove/delNewsletter.php?id="+getIdAttribute);
        $('.getUserName').html(getUserName);
    });
})

$(function(){
    $('.edit-file').bind('click', function(){
        //modification d'un un document
        var getFileParent = $(this).attr('file-parent');
        var getFileID = $(this).attr('file-id');
        var getFileName = $(this).attr('file-name');
        var getFileDate = $(this).attr('file-date');
        var getFileDesc = $(this).attr('file-desc');
        var getFileType = $(this).attr('file-type');
        var getFileProd = $(this).attr('file-prod');
        var getFileTarget = $(this).attr('file-target');
        var getFileLink = $(this).attr('file-link');
        var getFileActive = $(this).attr('file-active');
        var getConfigRole = $(this).attr('data-role');
        var getActiveID = $(this).attr('active-id');

        $('#getFile-url').attr('action' , 'files.php?files='+getFileParent)
        $('#getFile-parent').attr("value" , getFileParent);
        $('#getFile-id').attr("value" , getFileID);
        $('#getFile-name').html(getFileName);
        $('#getFile-date').attr("value" , getFileDate);
        $('#getFile-desc').html(getFileDesc);
        $('#getFile-type').attr("value" , getFileType);
        $('#getFile-prod').attr("value" , getFileProd);
        $('#getFile-target').attr("value" , getFileTarget);
        $('#getFile-link').attr("src" , getFileLink);
        $('#getActive-id').attr("value" , getActiveID);

        var getRoleCount = $(this).attr('data-count');
        for (var i = 0; i < getRoleCount ; i++) {
            var getConfigRole = $(this).attr('data-role'+[i]);
            if($('#'+getConfigRole+'Edit').attr('id') == getConfigRole+'Edit'){
                $('input[type="checkbox"]#'+getConfigRole+'Edit').attr('checked','checked');
            }else if($('input[type="checkbox"]#'+getConfigRole+'Edit').attr('checked','checked')){
                $('input[type="checkbox"]#'+getConfigRole+'Edit').click(function(){
                    $('input[type="checkbox"]#'+getConfigRole+'Edit').toggleAttr('checked');
                });
            }
        }
        if($('#activation'+getFileActive).attr('id') == 'activation1'){
            $('#activation1').html('<p class="text-center">Voulez vous vraiment <span class="font-weight-bold text-danger">DÉSACTIVER</span> le document : <br><span class="font-weight-bold lead">' + getFileName + '</span></p>');
            $('#titleActive').html('Désactiver le document');
            $('#getFile-active').attr("value" , 0);
        }else if($('#activation'+getFileActive).attr('id') == 'activation0'){
            $('#activation0').html('<p class="text-center">Voulez vous vraiment <span class="font-weight-bold text-success">ACTIVER</span> le document : <br><span class="font-weight-bold lead">' + getFileName + '</span></p>');
            $('#titleActive').html('Activer le document');
            $('#getFile-active').attr("value" , 1);
        }
    });
})

$(function(){
    var el = $('#fileDetach').detach();
    var fileSubmit = $('#submitWidthFile').hide();
    $('.modifier').bind('click', function(){
        // id dans une table
        var getConfigId = $(this).attr('data-id');
        var getConfigIdEnt = $(this).attr('data-idEntreprise');
        var getConfigIdRole = $(this).attr('data-idRole');
        $('#getConfigID').attr("value" , getConfigId);
        $('#getConfigIdEnt').attr("value" , getConfigIdEnt);
        $('#getConfigIdAction').attr("value" , getConfigIdRole);
        //modification d'un fichier
        var getConfigName = $(this).attr('data-name');
        var getConfigDate = $(this).attr('data-fileDate');
        $('#getFolderName').html(getConfigName);
        $('#getFolderDate').attr("value" , getConfigDate);
        // modification d'un role
        var getConfigAction = $(this).attr('data-action');
        $('#getAction').attr("value" , getConfigAction);
        $('#getActionRole').attr("value" , getConfigAction);
        $('#fiche-action').html(getConfigAction);
        // modification d'un utilisateur
        var getConfigPrenom = $(this).attr('data-prenom');
        var getConfigNom = $(this).attr('data-nom');
        var getConfigMail = $(this).attr('data-mail');
        var getConfigWork = $(this).attr('data-work');
        var getConfigGouvern = $(this).attr('data-gouvernance');
        var getConfigEntId = $(this).attr('data-entId');
        var getConfigFonct = $(this).attr('data-fonction');
        var getConfigAdr = $(this).attr('data-adresse');
        var getConfigCp = $(this).attr('data-cp');
        var getConfigVille = $(this).attr('data-ville');
        var getConfigFix = $(this).attr('data-telFix');
        var getConfigMob = $(this).attr('data-telMob');
        var getConfigActive = $(this).attr('data-active');
        var getConfigType = $(this).attr('data-type');
        //modification d'une entreprise
        var getConfigEntreprise = $(this).attr('data-entreprise');
        var getConfigGouv = $(this).attr('data-gouv');
        var getConfigAdrEnt = $(this).attr('data-adresseEnt');
        var getConfigVilleEnt = $(this).attr('data-villeEnt');
        var getConfigCpEnt = $(this).attr('data-cpEnt');
        var getConfigTva = $(this).attr('data-tva');
        $('#getEntreprise').attr("value" , getConfigEntreprise);
        $('#getGouv').attr("value" , getConfigGouv).html(getConfigGouv + 's');
        $('#getAdr').attr("value" , getConfigAdrEnt);
        $('#getCp').attr("value" , getConfigCpEnt);
        $('#getVille').attr("value" , getConfigVilleEnt);
        $('#getTVA').attr("value" , getConfigTva);
        $('#fiche-entreprise').html('<span class="font-weight-bold text-info">' + getConfigEntreprise + '</span>');
        $('#getFiche-entreprise').html('<span class="font-weight-bold text-info">' + getConfigEntreprise + '</span>' + 
            ' <p class="mb-0" style="font-size:0.7em;text-transform:capitalize"> Gouvernance <span class="font-weight-bold text-muted">' + getConfigGouv + '</span></p>');
        $('#getFiche-adresseEnt').html(getConfigAdrEnt + '<br>' + getConfigCpEnt + ' - ' + getConfigVilleEnt);
        $('#get-entreprise').html(getConfigEntreprise);
        $('#getFiche-TVA').html(getConfigTva);
        if ($('#getFiche-TVA').is(':empty')){
          $('#getFiche-TVA').parent('p').hide();
        }else{
            $('#getFiche-TVA').parent('p').show();
        };
       if($('#getFiche-adresseEnt').html().length < 20){
            $('#getFiche-adresseEnt').hide();
       }else{
            $('#getFiche-adresseEnt').show();
       }
        //modification d'un un document
        var getFileParent = $(this).attr('file-parent');
        var getFileID = $(this).attr('file-id');
        var getFileName = $(this).attr('file-name');
        var getFileDate = $(this).attr('file-date');
        var getFileDesc = $(this).attr('file-desc');
        var getFileType = $(this).attr('file-type');
        var getFileProd = $(this).attr('file-prod');
        var getFileTarget = $(this).attr('file-target');
        var getFileLink = $(this).attr('file-link');
        //Assignation des variables FILES
        $('#getFile-url').attr('action' , 'files.php?files='+getFileParent)
        $('#getFile-parent').attr("value" , getFileParent);
        $('#getFile-id').attr("value" , getFileID);
        $('#getFile-name').attr("value" , getFileName);
        $('#getFile-date').attr("value" , getFileDate);
        $('#getFile-desc').html(getFileDesc);
        $('#getFile-type').html(getFileType);
        $('#getFile-prod').attr("value" , getFileProd);
        $('#getFile-target').attr("value" , getFileTarget);
        $('#getFile-link').attr("value" , getFileLink);
        //Assignation des variables USERS
        $('#getUser-prenom').attr("value" , getConfigPrenom);
        $('#getUser-nom').attr("value" , getConfigNom);
        $('#fiche-user').html('Modifier la fiche de ' + getConfigPrenom + ' ' + getConfigNom);
        $('#getFiche-user').html('<span class="font-weight-bold text-info">' +getConfigPrenom + ' ' + getConfigNom + '</span> - <small class="text-info">' + getConfigFonct + '</small>');
        $('#getUser-mail').attr("value" , getConfigMail);
        $('#getFiche-mail').html(getConfigMail).attr('href' , 'mailto:'+getConfigMail);
        $('#getUser-work').attr("value" , getConfigWork).html(getConfigWork);
        $('#getFiche-work').html(getConfigWork);
        //$('#getUser-role').attr("value" , getConfigRole);
        $('#getUser-fonction').attr("value" , getConfigFonct);
        $('#getUser-adr').attr("value" , getConfigAdr);
        $('#getUser-gouv').attr("value" , getConfigGouvern);
        $('#getUser-entId').attr("value" , getConfigEntId);
        $('#getUser-cp').attr("value" , getConfigCp);
        $('#getUser-ville').attr("value" , getConfigVille);
        $('#getFiche-adresse').html(getConfigAdr + '<br>' + getConfigCp + ' - ' + getConfigVille);
        if($('#getFiche-adresse').html().length < 20){
            $('#getFiche-adresse').hide();
        }else{
            $('#getFiche-adresse').show();
        };
        $('#getUser-fix').attr("value" , getConfigFix);
        $('#getFiche-fix').html(getConfigFix);
        if($('#getFiche-fix').html().length < 10){
            $('.telBureau').hide();
            $('.telBureau').removeClass('hydrated d-inline-block mr-2');
            $('.telBureau').css('position','absolute');
            $('.telMobile').removeClass('ml-3');
        }else{
            $('.telBureau').show();
            $('.telBureau').addClass('hydrated d-inline-block mr-2');
            $('.telBureau').css('position','relative');
            $('.telMobile').addClass('ml-3');
        };
        $('#getUser-mob').attr("value" , getConfigMob);
        $('#getFiche-mob').html(getConfigMob);
        if($('#getFiche-mob').html().length < 10){
            $('.telMobile').hide();
            $('.telMobile').removeClass('hydrated d-inline-block ml-3 mr-0');
            $('.telMobile').css('position','absolute');
            $('.telMobile').removeClass('ml-3');
        }else{
            $('.telMobile').show();
            $('.telMobile').addClass('hydrated d-inline-block ml-3 mr-0');
            $('.telMobile').css('position','relative');
            $('.telMobile').addClass('ml-3');
        };
        $('#getUser-active').attr("value" , getConfigActive);
        $('.getUser-type').attr("value" , getConfigType);
            
        if ($('#supAd').attr('id') == getConfigType){
            $('input[type="radio"]#supAd').attr('checked','checked');
            $('input[type="radio"]#supAd').attr('value','supAd')
        }else if($('#copil').attr('id') == getConfigType){
            $('input[type="radio"]#copil').attr('checked','checked');
            $('input[type="radio"]#copil').attr('value','copil')
        }else if($('#admin').attr('id') == getConfigType){
            $('input[type="radio"]#admin').attr('checked','checked');
            $('input[type="radio"]#admin').attr('value','admin')
        }else if($('#autre').attr('id') == getConfigType){
            $('input[type="radio"]#autre').attr('checked','checked');
            $('input[type="radio"]#autre').attr('value','autre')
        }

        var getRoleCount = $(this).attr('data-count');
        for (var i = 0; i < getRoleCount ; i++) {
            var getConfigRole = $(this).attr('data-role'+[i]);
            if($('#'+getConfigRole+'Edit').attr('id') == getConfigRole+'Edit'){
                $('input[type="checkbox"]#'+getConfigRole+'Edit').attr('checked','checked');
            }else if($('input[type="checkbox"]#'+getConfigRole+'Edit').attr('checked','checked')){
                $('input[type="checkbox"]#'+getConfigRole+'Edit').click(function(){
                    $('input[type="checkbox"]#'+getConfigRole+'Edit').toggleAttr('checked');
                });
            }
        }

    });
    $("#showInputFile").on('click',function(){
        $('#fileAdd').append(el);
        $("#hideInputFile").detach();
        $("#submit").detach();
        $("#submitWidthFile").show();
    });
})

$(function(){
    $("#chatBoxSubmit").on('click',function(d){
        d.preventDefault()        

        var doc_id = $("#doc_id").val();
        var author = $("#author").val();
        var texte = $("#texte").val();

        $.ajax({
            type    : "POST",
            data    : {doc_id:doc_id,author:author,texte:texte},
            url     : "insert/new--chat.php",
            success: function(result){
                $('.chatBox--text').load("files.php?files=" + doc_id +" .content");
                $("textarea#texte").val("");
            }
        })
    })
});

$(function(){
    $( "textarea#texte" ).on('keypress',function(f) {
        var doc_id = $("#doc_id").val();
        var author = $("#author").val();
        var texte = $("#texte").val();

        if (f.key == 13 ) {
            $.ajax({
                type    : "POST",
                data    : {doc_id:doc_id,author:author,texte:texte},
                url     : "insert/new--chat.php",
                success: function(result){
                    $('.chatBox--text').load("files.php?files=" + doc_id +" .content");
                    $("textarea#texte").val("");
                }
            }) // fin ajax
        }
    });
})

$(function(){
    var auto_refresh = setInterval(function(){
        var doc_id = $("#doc_id").val();
        $('.chatBox--text').load("files.php?files=" + doc_id +" .content");
        $('.chatBox--icon span').load("files.php?files=" + doc_id +" .countMessage");
    }, 1000); // refresh every 1 sec
})

$(function() {
    if($("#sortable,#sort").length){
        $('#sortable,#sort').sortable({
            opacity: 0.7,
            cancel:".unMove",
            update: function(event, ui) {
                var list_sortable = $(this).sortable('toArray').toString();
                // change order in the database using Ajax
                $.ajax({
                    url: 'includes/set_order.php',
                    type: 'POST',
                    data: {list_order:list_sortable},
                    success: function(data) {
                        console.log('Le changement a bien été effectué');
                    }
                });
            }
        }); // fin sortable
    }
});

$(function(){
    $('[data-drop]').on('click',function(event){
        event.preventDefault();
        var getDropId = $(this).next('.dropped')
        $(getDropId).fadeToggle(200,'linear',function(){
            $('#overlay').show().css('z-index','1');
        })
        $(document).on('keyup',function(c){
            if(c.key === 27)
            $(getDropId).fadeOut(200, 'linear');
            $('#overlay').hide();
        })
        $('#overlay').on('click',function(e){
            $(getDropId).fadeOut(200, 'linear');
            $('#overlay').hide();
        })
    });
});


$(function() {
    $(".imgDocs").on('click', function(event) {
        let activeDoc = $(this).children('div').toggleClass('active');
        let $this = $(this).children('div');
        let getDocID = $(this).attr('data-docid');
        let getDocIMG = $(this).attr('data-docBackground');
        
        if($(this).children('div').hasClass('active')){
            $('.importedDocs').append('<input type="hidden" name="embededFiles[]" class="doc' + getDocID + '" value="' + getDocID + '"/>');
            $('.importedDocs').append('<div class="p-1 img' + getDocID + '"><div style="background-image:url(' + getDocIMG + ');background-size:cover;width:100px;height:100px;position:relative" class="p-2 rounded"><div class="bg-white shadow-sm" style="width:20px;height:20px;position:absolute;top:-5px;right:-5px;border-radius:50px"><button type="button" class="close position-relative" aria-label="Close"><span aria-hidden="true" class="position-absolute" style="top:-1px;right:2px;">&times;</span></button></div></div></div>');
        }else{
            $('.doc' + getDocID).remove();
            $('.img' + getDocID).remove();
        }

        $('.img' + getDocID).children('div').on('click',function(){
            $('.doc' + getDocID).remove();
            $('.img' + getDocID).remove();
            $this.removeClass('active')
        });
        
    });
});
$(function() {
    $(".subFolder").on('click', function(event) {
        let activeDoc = $(this).children('div').toggleClass('active');
        let getDocID = $(this).attr('data-docid');
        let getParentID = $(this).attr('data-parent');
        let getPrevID = $(this).attr('data-prev');

        
        $(".subFolder.folder"+getParentID).hide();
        $(this).parent().prev('.return').removeClass('d-none');
        $(this).parent().prev('.return').attr('data-parent', getParentID)
        $(this).parent().prev('.return').attr('data-id', getDocID)
        $(this).parent().prev('.return').attr('data-prev', getPrevID)

        $('.prout' + getDocID).toggleClass('d-none')
        $('.prout' + getParentID).toggleClass('d-none')
        
    });
});
$(function() {
    $(".openChildren").on('click', function(event) {
        //let activeDoc = $(this).children('div').toggleClass('active');
        let getDocID = $(this).attr('data-docid');
        let getParentID = $(this).attr('data-parent');
        let getPrevID = $(this).attr('data-parent');
        
        $(".openChildren").toggleClass('d-none');
        $(this).parent().prev('.return').removeClass('d-none');
        $(this).parent().prev('.return').attr('data-parent', getParentID)
        $(this).parent().prev('.return').attr('data-id', getDocID)
        $('.folder'+getDocID).attr('data-prev', getPrevID)

        $('.prout' + getDocID).toggleClass('d-none')
       
        
    });
});

$(function() {
    $(".return").on('click', function(event) {
        let getParentID = $(this).attr('data-parent');
        let getDocID = $(this).attr('data-id');
        let getPrevParentID = $(this).attr('data-prev');

        $('.folder' + getParentID).removeClass('d-none');
        $('.folder' + getParentID).show();
        $('.folder' + getDocID).toggleClass('d-none');

        if(getPrevParentID || getParentID == 0){
            $(this).attr('data-parent',getPrevParentID);
            $(this).attr('data-id',getParentID);
            $('.folder' + getPrevParentID).show();
            if($('.openChildren').hasClass('d-none')){
                console.log('invisible')
            }else{
                $(this).toggleClass('d-none')
                console.log('visible')
            }
        }

    });
});

$(function() {
    $(".imgEdit").on('mouseenter',function(event) {
        let editDocID = $(this).attr('data-editDocID');

        $('.img' + editDocID).children('div').children('.fermer').on('click',function(){
            $('.doc' + editDocID).remove();
            $('.img' + editDocID).remove();
        });

    })
});

$(function() {
    $("#checkBlogDate").on('click', function(f) {
        $(this).parent().next().toggleClass('d-none');
    });
    if ($('input#checkBlogDate').is(':checked')) {
        $('.blogDates').removeClass('d-none');
    }
});

$(function() {
    // $('#newToolBox').bind('click',function(){
    //     $( "#toolBox" ).slideToggle( "slow" );
    // })

    $( "#newToolBox" ).on('click',function() {
        $( "#toolBox" ).animate({
          left: "+=50",
          height: "toggle"
        }, 500, function() {
          // Animation complete.
        });
      });
});

$(function(){
    $('.modifCategory').on('click',function(){
        console.log('test')
        $(this).children('span').toggleClass('d-none')
        $(this).parent().prev().toggleClass('d-none')
        $(this).parent().prev().prev().toggleClass('d-none')
    })
})


$(function(){
    $("#addNewNews").on('click',function(event){
        event.preventDefault()
        var news_prenom = $("#newsprenom").val();
        var news_nom = $("#newsnom").val();
        var news_mail = $("#newsmail").val();
        var website = $(this).attr('data-website');
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

        if(news_prenom.length < 1){
            console.log("error prenom vide")
            $("#newsprenom").addClass('is-invalid');
        }else if(news_nom.length < 1){
            console.log("error nom vide")
            $("#newsnom").addClass('is-invalid');
        }else if(news_mail.length < 1){
            console.log("error mail vide")
            $("#newsmail").addClass('is-invalid');
        }else if(!pattern.test(news_mail)){
            console.log("error mail")
            $("#newsmail").addClass('is-invalid');
        }else{
            $.ajax({
                type    : "POST",
                data    : {news_prenom:news_prenom,news_nom:news_nom,news_mail:news_mail,website:website},
                url     : "backoffice/insert/new--newsletter.php",
                success: function(result){
                    console.log(news_prenom,news_nom,news_mail,website)
                    $("#newsprenom").val("");
                    $("#newsnom").val("");
                    $("#newsmail").val("");
                    $("#newsprenom").removeClass('is-invalid');
                    $("#newsnom").removeClass('is-invalid');
                    $("#newsmail").removeClass('is-invalid');
                    $('#liveToast').toast('show')
                    setTimeout(function(){
                        $('#liveToast').toast('hide')
                    },5000);
                }
            })
        }
    })
});

$("#submitButton").on('click',function(event) {

    var form = $("#signup-form")
    
    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }

    form.addClass('was-validated')
});

// $(function() {
//     if (!localStorage.getItem('cookie_accepted')) {
//       $('#cookie-banner').show();
//     }
//     $('#accept-cookies').on('click',function() {
//       localStorage.setItem('cookie_accepted', true);
//       $('#cookie-banner').hide();
//       $.post('includes/cookie-accept.php');
//     });
//     $('#refuse-cookies').on('click',function() {
//       localStorage.setItem('cookie_refused', true);
//       $('#cookie-banner').hide();
//       $.post('includes/cookie-refuse.php');  
//     });
// });

$(document).ready(function(){
    var $tabs = $('#v-pills-tab .nav-link');

    $('#next-tab').click(function(){
        var $active = $tabs.filter('.active');
        var activeIndex = $tabs.index($active);
        var nextTab = $tabs.eq(activeIndex + 1);
        if (nextTab.length) {
            nextTab.tab('show');
        } else {
            $tabs.first().tab('show'); // Revenir au premier onglet si aucun suivant
        }
    });

    $('#prev-tab').click(function(){
        var $active = $tabs.filter('.active');
        var activeIndex = $tabs.index($active);
        var prevTab = $tabs.eq(activeIndex - 1);
        if (activeIndex > 0 && prevTab.length) {
            prevTab.tab('show');
        } else {
            $tabs.last().tab('show'); // Revenir au dernier onglet si aucun précédent
        }
    });
});


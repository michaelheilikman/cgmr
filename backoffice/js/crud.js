$(function(){
    $("#addSimpleText").bind('click',function(e){
        e.preventDefault()
        var page_id = $("#tools_page_id").val();
        var website = $("#tools_website").val();
        var type = $(this).attr('data-type');
        
        $.ajax({
            type    : "POST",
            data    : {page_id:page_id,website:website,type:type},
            url     : "insert/new--simpleTextTool.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                setTimeout(function(){
                    $('#pageTools').load("pageSingle.php?page_id=" + page_id +" #pageTools");
                },500);
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    $(':focus').blur()
                },2000);
            }
        })
    })
});
$(function(){
    $("#addSimpleImage").click(function(f){
        f.preventDefault()
        var page_id = $("#tools_page_id").val();
        var website = $("#tools_website").val();
        var type = $(this).attr('data-type');
        
        $.ajax({
            type    : "POST",
            data    : {page_id:page_id,website:website,type:type},
            url     : "insert/new--simpleImgTool.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                setTimeout(function(){
                    $('#pageTools').load("pageSingle.php?page_id=" + page_id +" #pageTools");
                    tinymce.init({
                        selector: '.descriptionArea',
                    });
                },500);
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    $(':focus').blur()
                },2000);
            }
        })
    })
});

$(function(){
    $("#addNewCategory").click(function(event){
        event.preventDefault()
        var cat_name = $("#newCategory").val();
        var website = $(this).attr('data-website');
        var page_id = $("#tools_page_id").val();

        console.log(cat_name)

        $.ajax({
            type    : "POST",
            data    : {cat_name:cat_name,website:website},
            url     : "insert/new--category.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                setTimeout(function(){
                    $('#catOutput').load("pageSingle.php?page_id=" + page_id +" #catOutput");
                },500);
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    $(':focus').blur()
                },2000);
            }
        })
    })
});

$(function(){
    $("#addNewKeyword").click(function(event){
        event.preventDefault()
        var key_name = $("#newKeyword").val();
        var website = $(this).attr('data-website');
        var key_date = $(this).attr('data-now');

        console.log(key_name, website, key_date)

        $.ajax({
            type    : "POST",
            data    : {key_name:key_name,website:website,key_date:key_date},
            url     : "insert/new--keyword.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                setTimeout(function(){
                    $('#new-key').modal('hide')
                    $('#pages').load("keywords.php #pages");
                },500);
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    $(':focus').blur()
                    $("#newKeyword").val('')
                },2000);
            }
        })
    })
});

$(function(){
    $("#addNewCompany").click(function(e){
        e.preventDefault()
        var id = $("#newCompId").val();
        var entreprise = $("#companyName").val();
        var gouvernance = $("#selectGov").val();
        var adresse = $("#adresse").val();
        var cp = $("#cp").val();
        var ville = $("#ville").val();
        var numTVA = $("#numTVA").val();
        var website = $(this).attr('data-website');

        console.log(id, entreprise, gouvernance, website, adresse, cp, ville, numTVA)

        $.ajax({
            type    : "POST",
            data    : {id:id, entreprise:entreprise, gouvernance:gouvernance, website:website, adresse:adresse, cp:cp, ville:ville, numTVA:numTVA},
            url     : "insert/new--company.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                console.log(entreprise)
                if($("#entrepriseNew").length){
                    setTimeout(function(){
                            $('#entrepriseNew').prepend('<option value="' + entreprise + '" data-idEntreprise="' + id + '" data-gouv="' + gouvernance + '" data-adresseEnt="' + adresse + '" data-cpEnt="' + cp + '" data-villeEnt="' + ville + '" selected>' + entreprise + '</option>');
                            $('#newEntId').attr('value', id)
                    },500);
                }else if(("#pages").length){
                    setTimeout(function(){
                        $('#pages').load("entreprise.php #pages");
                    },500);
                }
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    if($("#addNewEntrepriseBtn").length){
                        $('#addNewEntrepriseBtn').hide()
                    }
                    $(':focus').blur()
                },2000);
            }
        })
    })
});

$(function(){
    $("#addNewUrl").bind('click', function(eventURL){
        eventURL.preventDefault()
        var url = $("#newURL").val();
        var id = $(this).attr('data-id');
        $.ajax({
            type    : "POST",
            data    : {url:url,id:id},
            url     : "edit/edit--url.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                setTimeout(function(){
                    $('#displayURL').load("eventEdit.php?id=" + id + " #displayURL");
                },500);
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    $(':focus').blur()
                },800);
            }
        })
    })
});

$(function(){
    $("#addNewPageUrl").bind('click', function(eventURL){
        eventURL.preventDefault()
        var page_url = $("#newURL").val();
        var page_id = $(this).attr('data-id');
        console.log(page_url);
        $.ajax({
            type    : "POST",
            data    : {page_url:page_url,page_id:page_id},
            url     : "edit/edit--pageurl.php",
            success: function(result){
                $('.saveActive').addClass('spinner-border')
                $('.saveActive').addClass('mr-1')
                setTimeout(function(){
                    $('#displayURL').load("pageSingle.php?page_id=" + page_id + " #displayURL");
                },500);
                setTimeout(function(){
                    $('.saveActive').removeClass('spinner-border')
                    $('.saveActive').removeClass('mr-1')
                    $(':focus').blur()
                },2000);
            }
        })
    })
});


$(function(){
    $(".changeCategory").bind('click', function(event){
        event.preventDefault()
        var cat_name = $(this).prev('input').val();
        var cat_id = $(this).attr('data-id');
        var TBname = '#' + $(this).parent().prev('p').attr('id');
        var inputWrapper = '#' + $(this).parent('div').attr('id');
        console.log(inputWrapper);
        $.ajax({
            type    : "POST",
            data    : {cat_name:cat_name,cat_id:cat_id},
            url     : "edit/edit--category.php",
            success: function(result){
                $(TBname).load("category.php " + TBname + "");
                $(inputWrapper).addClass('d-none');
                $(inputWrapper).prev().removeClass('d-none');
            }
        })
    })
});

$(function(){
    $(".changeKeyword").bind('click', function(event){
        event.preventDefault()
        var key_name = $(this).prev('input').val();
        var key_id = $(this).attr('data-id');
        var TBname = '#' + $(this).parent().prev('p').attr('id');
        var inputWrapper = '#' + $(this).parent('div').attr('id');
        var hideCancel = $(this).parent().next().children().children();
        $.ajax({
            type    : "POST",
            data    : {key_name:key_name,key_id:key_id},
            url     : "edit/edit--keyword.php",
            success: function(result){
                $(TBname).load("keywords.php " + TBname + "");
                $(inputWrapper).addClass('d-none');
                $(inputWrapper).prev().removeClass('d-none');
                hideCancel.toggleClass('d-none');
            }
        })
    })
});

$(function() {
    $('.sortable').sortable({
        opacity: 0.7,
        cancel:".unMove",
        cursor:"move",
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
            // change order in the database using Ajax
            $.ajax({
                url: 'includes/tools_order.php',
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
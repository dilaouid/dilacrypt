var readURL = (input, filename) => {
    if (input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#filenameGrp').removeClass('d-none');
            $('#filename').html(filename);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('#importFileStyleBtn').on('click', function(){
    $('#importFile').click();
});

$("input[type=file]").change(function(){
    let filename = $(this).val().replace(/C:\\fakepath\\/i, '');
    readURL(this, filename);
});

$('input:radio').click(function (){
    $(':radio').each(function(){
        $("#"+this.id).next().removeClass( "selectRadio" );
    });
    $("#"+this.id).next().addClass( "selectRadio" );
    let labelTxt = $("#"+this.id).next().text();
    if(labelTxt == 'Decrypt'){
        $('#selectExt').removeClass('d-none');
    }else if(labelTxt == 'Encrypt'){
        $('#selectExt').addClass('d-none');
    }
});

$('.keyvalue').on('input', function(e1) {
    if($(e1.target).val().length > 1){
        $('#process').removeAttr('disabled');
    }else{
        $('#process').attr('disabled', 'true');
    }
});
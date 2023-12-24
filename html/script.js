
$('#form1').submit(function(e){
    e.preventDefault();

    var u_name = $('#name').val();
    var u_comment = $('#comment').val();

    $.ajax({
        url: 'http://localhost/PROJETO-GAIT-master/php/inserir_cliente.php',
        method: 'POST',
        data: {name: u_name, comment:u_comment},
        dataType: 'json'
    }).done(function(result){
        $('#name').val('');
        $('#comment').val('');
        console.log(result);
        getComments();
    });
});

    

function getComments() {
    $.ajax({
        url: 'http://localhost/ajax_com_php/selecionar.php',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        //console.log(result);
        alert('Comentário cadastrado');

        for (var i = 0; i < result.length; i++) {
            $('.box_comment').prepend('<div class="b_comm"><h4>' + result[i].name + '</h4><p>' + result[i].comment + '</p></div>');
        }
    });
}

getComments();
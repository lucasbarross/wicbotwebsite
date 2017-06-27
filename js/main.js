$.ajax({
    url: 'statistics.php',
    success: function(data){
        var resultado = jQuery.parseJSON(data);
        createChart(resultado.acertos, resultado.erros);
        $("#easiest-champion").html('<img style="max-width:80px; opacity: 0.8;"src=http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/'+capitalize(resultado.nomeMaisAcertos)+'.png> <strong style="margin-left:20px; text-shadow: 2px 2px rgba(0,0,0,0.1);">EASIEST CHAMPION</strong> with '+resultado.porcentagemMaisAcertos+' correct answers.')
        $("#hardest-champion").html('<img style="max-width:80px; opacity: 0.8;"src=http://ddragon.leagueoflegends.com/cdn/6.24.1/img/champion/'+capitalize(resultado.nomeMenosAcertos)+'.png> <strong style="margin-left:20px; text-shadow: 2px 2px rgba(0,0,0,0.1);">HARDEST CHAMPION</strong> with '+resultado.porcentagemMenosAcertos+' correct answers.')
}
});

function createChart(acertos, erros){
    data = {
        labels : ['Correct','Wrong'],
        datasets: [{
            data: [acertos,erros],
            backgroundColor: ['#05c000', '#c00000'],
            borderColor: ['#05c000', '#c00000']
        }]
    }

    options = {
        animation: false,
        legend: {
            labels: {
                fontColor:'white',
                fontFamily: "'Segoe UI', 'Arial', sans-serif"
            }
        },
        responsive: true,
        pieceLabel: {
            mode: 'percentage',
            precision: 1
        }
    }    

    const CHART = $("#submissionsChart");
    let pieSubmissionsChart = new Chart(CHART, 
    {
        type:'pie',
        data: data,
        options: options
    })
}

function capitalize(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function isScrolledIntoView(elem)
{
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

$('a').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
});

$(window).scroll(function(){
    var scrollPos = $(document).scrollTop();
    $("#menu a").each(function(){
        var current = $(this);
        var li = current.parents('li');
        if(!li.hasClass("invite-button")){
            var section = $((current).attr("href"));
            if(section.position().top <= scrollPos && section.position().top + section.height() > scrollPos){
                $('#menu ul li a').removeClass("active");
                li.addClass("active");
            } else {
                li.removeClass("active");
            }
        }
    })
})
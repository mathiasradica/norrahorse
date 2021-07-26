$('#submit').on('click', '', {}, function () {
    $('input').each(function (index, element) {
        if(!element.checkValidity()){
            if($(element).next()){
                $(element).next().text('Vaadittu kenttä.')
            }
        }
    })
})

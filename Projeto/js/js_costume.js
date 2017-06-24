$(function(){
    $('.readmore a.more').on('click', function(){
        var $parent = $(this).parent();
        if($parent.data('visible')) {
            $parent.data('visible', false).find('.ellipsis').show()
                .end().find('.moreText').hide()
                .end().find('a.more').text('Ler mais...');
        } else {
            $parent.data('visible', true).find('.ellipsis').hide()
                .end().find('.moreText').show()
                .end().find('a.more').text('Mostrar menos');
        }
    });
});
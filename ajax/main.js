$(document).ready(function (){
    $('.page-link').on('click',function (e){
        e.preventDefault();

        let page = $(this).attr('href');

        $(this).closest('ul').find('li').removeClass('active');
        $(this).parent().addClass('active');

        $.ajax({
            url:'/../ajax/allReviews.php',
            type:'POST',
            data: page + '&movie',
            success: function (data){
                $('.note').html(data);
            }
        })
    })
});

$('.prev').on('click',function (e){
    e.preventDefault();

    let list =$('.pagination li').filter('.active').prev().addClass('active');

    list.each(function (i,elem){
        if($(this).hasClass('prev')){
            $(this).removeClass('active');
        }
    })

    let page = $('.page-link').parent('.active').data('id');
    if(page === undefined){
        $('.pagination li[data-id]:first').addClass('active');
    }else{
        $.ajax({
            url:'/../ajax/allReviews.php',
            data: page + '&movie',
            success: function (data){
                $('.note').html(data);
            }
        })
    }
});

$('.next').on('click',function ($e){
    e.preventDefault();

    let list = $('.pagination li').filter('.active').removeClass('active').next().addClass('active');
    list.each(function (i,elem){
        if($(this).hasClass('next')){
            $(this).removeClass('active')
        }
    })
    let page = $('.page-link').parent('.active').data('id');
    if(page === undefined){
        $('.pagination li[data-id]:last').addClass('active');
    }else{
        $.ajax({
            url:'/../ajax/allReviews.php',
            data: page + '&movie',
            success: function (data){
                $('.note').html(data);
            }
        })
    }

})
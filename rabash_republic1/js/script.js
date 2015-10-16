(function ($, Drupal, window, document, undefined) {

Drupal.behaviors.rabash = {
attach: function(context, settings) {

  // Mobilmeny
  $('.navigation--primary .navigation__title', context).css('cursor', 'pointer').attr('tabindex', 0).click(function() {
    if ($('.navigation--primary .navigation__title', context).is(':visible')) {
      $('.navigation--primary .navigation__title', context).toggleClass('open').next('.menu').slideToggle();
      return false;
    }
  });

  // Mobilsök
  $('.navigation--secondary .menu-938', context).click(function() {
    $('.block--search--form', context).slideToggle();
    return false;
  });

  // Flexslider
  $('.view-bildspel-i-nod .flexslider', context).flexslider({
    animation: 'slide',
    slideshowSpeed: '7000',
    animationDuration: '500',
    controlNav: false,
    slideshow: false,
    prevText: 'Föregående bild',
    nextText: 'Nästa bild'
  });

    // Flexslider
  $('.view-nodequeue-4 .flexslider', context).flexslider({
    animation: 'slide',
    slideshowSpeed: '7000',
    animationDuration: '500',
    controlNav: false,
    animationLoop: false,
    itemWidth: 220,
    itemMargin: 20,
    maxItems: 3,
    slideshow: false,
    prevText: 'Föregående bild',
    nextText: 'Nästa bild'
  });

   /** LYBE: Björn [Add email explain: ] **/
  jQuery('#edit-account-login').append('<div style="width: 290px; background: whitesmoke; padding: 6px 12px;">Om du beställer 2 prenumerationer till priset av 1 så mejlar vi dig och frågar efter din väns adress</div>');


  // Toggle bildtext på små skärmar
  $('.field-name-field-file-image-caption', context).before('<a href="#" class="toggle-bildtext" title="Visa bildtext"><i aria-hidden="true" class="icon icon-FRIA_ikon_bildtext-01 "></i><span class="element-invisible">Visa bildtext</span></a>');
  if ($('.toggle-bildtext').is(':visible')) {

    $('.toggle-bildtext', context).click(function() {
      $(this).next('.field-name-field-file-image-caption', context).toggle();
      return false;
    });

    $('.field-name-field-file-image-caption', context).click(function() {
      $(this).hide();
    });
  }

  // Toggle dela undermeny
  $('.navigation--share ul ul:not(.read)', context).hide();
  $('.navigation--share .share', context).click(function() {
    $(this).parent().children('ul').slideToggle();
    return false;
  });



  // Samma höjd på teaser-rutor
  var borderHeight = 6;
  $('.view-start.view-display-id-panel_pane_1 .views-row-odd').each(function() {
    var artikelOdd = $('article', this);
    var next = $(this).next('.views-row');
    var artikelEven = $('article', next);

    if (artikelOdd.height() < artikelEven.height()) {
      artikelOdd.css('min-height', artikelEven.height() + borderHeight);
    } else {
      artikelEven.css('min-height', artikelOdd.height() + borderHeight);
    }
  });

}
}; 

})(jQuery, Drupal, this, this.document);

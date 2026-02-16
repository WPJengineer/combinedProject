$(document).on('click', '#accessibility-btn', function () {
  $('#accessibility-panel').css("display", "flex");
});

$(document).on('click', '#accessibility-panel #btnCloseMenu', function () {
  $('#accessibility-panel').css("display", "none");
});

$('[data-accessibility="font-inc"]').on('click', function () {
  const root = document.documentElement;
  let currentScale = parseFloat(getComputedStyle(root)
    .getPropertyValue('--accessibility-scale'));
  let newScale = currentScale * 1.1;
  if (newScale > 2) {
    newScale = 2;
  }
  root.style.setProperty('--accessibility-scale', newScale);
  $('#accessibility-status').text(
    `Line spacing ${Math.round(newScale * 100)}%`
  );
});

$('[data-accessibility="font-dec"]').on('click', function () {
  const root = document.documentElement;
  let currentScale = parseFloat(getComputedStyle(root)
    .getPropertyValue('--accessibility-scale'));
  let newScale = currentScale * 0.9;
  if (newScale < 0.8) {
    newScale = 0.8;
  }
  root.style.setProperty('--accessibility-scale', newScale);
  $('#accessibility-status').text(
    `Line spacing ${Math.round(newScale * 100)}%`
  );
});

$('[data-accessibility="line-inc"]').on('click', function () {
  const root = document.documentElement;
  let currentScale = parseFloat(getComputedStyle(root)
    .getPropertyValue('--accessibility-line-scale'));
  let newScale = currentScale + 0.1;
  if (newScale > 2) {
    newScale = 2;
  }
  root.style.setProperty('--accessibility-line-scale', newScale);
  $('#accessibility-status').text(
    `Line spacing ${Math.round(newScale * 100)}%`
  );
});

$('[data-accessibility="word-inc"]').on('click', function () {
  const root = document.documentElement;
  let currentScale = parseFloat(getComputedStyle(root)
    .getPropertyValue('--accessibility-word-spacing'));
  let newSpacing = currentScale + 0.05;
  if (newSpacing > 0.3) {
    newSpacing = 0.3;
  }
  root.style.setProperty(
    '--accessibility-word-spacing',
    newSpacing + 'em'
  );
  $('#accessibility-status').text(
    `Word spacing ${newSpacing.toFixed(2)}em`
  );
});

$('[data-accessibility="letter-inc"]').on('click', function () {
  const root = document.documentElement;
  let currentScale = parseFloat(getComputedStyle(root)
    .getPropertyValue('--accessibility-letter-spacing'));
  let newSpacing = currentScale + 0.02;
  if (newSpacing > 0.2) {
    newSpacing = 0.2;
  }
  root.style.setProperty(
    '--accessibility-letter-spacing',
    newSpacing + 'em'
  );
  $('#accessibility-status').text(
    `Letter spacing ${newSpacing.toFixed(2)}em`
  );
});

$('[data-accessibility="greys"]').on('click', function () {

  const $html = $('html');
  const isActive = $html.hasClass('accessibility-grey');

  if (isActive) {
    $html.removeClass('accessibility-grey');
    $(this).attr('aria-pressed', 'false');
    $('#accessibility-status').text('Grayscale disabled');
  } else {
    $html.addClass('accessibility-grey');
    $(this).attr('aria-pressed', 'true');
    $('#accessibility-status').text('Grayscale enabled');
  }

});

$('[data-accessibility="contrast-dark"]').on('click', function () {
  const $html = $('html');
  const isOn = $html.hasClass('accessibility-contrast-dark');

  $html.removeClass('accessibility-contrast-light');

  if (isOn) {
    $html.removeClass('accessibility-contrast-dark');
    $('[data-accessibility="contrast-dark"]').attr('aria-pressed', 'false');
    $('#accessibility-status').text('Dark contrast disabled');
  } else {
    $html.addClass('accessibility-contrast-dark');
    $('[data-accessibility="contrast-dark"]').attr('aria-pressed', 'true');
    $('[data-accessibility="contrast-light"]').attr('aria-pressed', 'false');
    $('#accessibility-status').text('Dark contrast enabled');
  }
});

$('[data-accessibility="contrast-light"]').on('click', function () {
  const $html = $('html');
  const isOn = $html.hasClass('accessibility-contrast-light');

  $html.removeClass('accessibility-contrast-dark');

  if (isOn) {
    $html.removeClass('accessibility-contrast-light');
    $('[data-accessibility="contrast-light"]').attr('aria-pressed', 'false');
    $('#accessibility-status').text('Light contrast disabled');
  } else {
    $html.addClass('accessibility-contrast-light');
    $('[data-accessibility="contrast-light"]').attr('aria-pressed', 'true');
    $('[data-accessibility="contrast-dark"]').attr('aria-pressed', 'false');
    $('#accessibility-status').text('Light contrast enabled');
  }
});

$('[data-accessibility="saturation-high"]').on('click', function () {

  const $html = $('html');
  const isActive = $html.hasClass('saturation-high');

  if (isActive) {
    $html.removeClass('saturation-high');
    $(this).attr('aria-pressed', 'false');
    $('#accessibility-status').text('High Saturation disabled');
  } else {
    $html.addClass('saturation-high');
    $(this).attr('aria-pressed', 'true');
    $('#accessibility-status').text('High Saturation enabled');
  }

});

$('[data-accessibility="saturation-low"]').on('click', function () {

  const $html = $('html');
  const isActive = $html.hasClass('saturation-low');

  if (isActive) {
    $html.removeClass('saturation-low');
    $(this).attr('aria-pressed', 'false');
    $('#accessibility-status').text('Low Saturation disabled');
  } else {
    $html.addClass('saturation-low');
    $(this).attr('aria-pressed', 'true');
    $('#accessibility-status').text('Low Saturation enabled');
  }

});

$('[data-accessibility="underline"]').on('click', function () {
  $('a').toggleClass("underline");
  $('#accessibility-status').text('Links underline enabled');
});

$('[data-accessibility="reset"]').on('click', function () {
  const root = document.documentElement;
  const $html = $('html');

  root.style.setProperty('--accessibility-scale', 1);
  root.style.setProperty('--accessibility-line-scale', 1);
  root.style.setProperty('--accessibility-word-spacing', '0em');
  root.style.setProperty('--accessibility-letter-spacing', '0em');

 $html.removeClass(
    'accessibility-grey ' +
    'accessibility-contrast-dark ' +
    'accessibility-contrast-light ' +
    'saturation-high ' +
    'saturation-low'
  );

  $('a').removeClass('underline');

  $('[data-accessibility="greys"], ' +
    '[data-accessibility="contrast-dark"], ' +
    '[data-accessibility="contrast-light"], ' +
    '[data-accessibility="saturation-high"], ' +
    '[data-accessibility="saturation-low"], ' +
    '[data-accessibility="underline"]'
  ).attr('aria-pressed', 'false');

  $('#accessibility-status').text('Accessibility settings reset');
});
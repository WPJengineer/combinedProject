$(document).on("click", "#accessibility-btn", function () {
  $("#accessibility-panel").css("display", "flex");
});

$(document).on("click", "#btnCloseMenu", function () {
  $("#accessibility-panel").css("display", "none");
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
});

$('[data-accessibility="font-dec"]').on('click', function () {
  const root = document.documentElement;
  let currentScale = parseFloat(getComputedStyle(root)
    .getPropertyValue('--accessibility-scale'));
  let newScale = currentScale * 0.9;
  if (newScale < 0.8) {
    newScale = 0.8;
  }
  root.style.setProperty('--accessibility-scale', newScale)
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

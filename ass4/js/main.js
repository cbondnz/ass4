/**
 * Forces the page to reload so that the recently viewed birds section is refreshed
 * with new birds. If this is not done, then when clicking the back button the page
 * won't refresh, and any clicked on birds won't appear in the list
 * taken from https://stackoverflow.com/questions/43043113/how-to-force-reloading-a-page-when-using-browser-back-button
 */
window.addEventListener("pageshow", function (event) {
  var historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
  if (historyTraversal) {
    // Handle page restore.
    window.location.reload();
  }
});

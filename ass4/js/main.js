/**
 * Forces the page to reload so that the recently viewed birds section is refreshed
 * with new birds. If this is not done, then when clicking the back button the page
 * won't refresh, and any clicked on birds won't appear in the list
 */
if (!!window.performance) {
  window.location.reload();
}


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Svelte and other libraries. It is a great starting point when
 * building robust, powerful web applications using Svelte and Laravel.
 */

import App from "./components/App.svelte";
const app = new App({
  target: document.getElementById('app')
});

window.app = app;

export default app;

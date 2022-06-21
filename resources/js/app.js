require('./bootstrap');

window.Vue = require("vue");

// Register our components
Vue.component("drag-drop-board", require("./components/Board.vue").default);

const board = new Vue({
    el: "#board"
});

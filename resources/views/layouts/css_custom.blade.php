<style>
    .input-upper { text-transform: uppercase }
    .input-upper::-webkit-input-placeholder { text-transform: none }
    .input-upper::-moz-placeholder { text-transform: none }
    .input-upper:-moz-placeholder { text-transform: none }
    .input-upper:-ms-placeholder { text-transform: none }

    a {
  color: #69C;
  text-decoration: none;
}
a:hover {
  color: #F60;
}
h1 {
  font: 1.7em;
  line-height: 110%;
  color: #000;
}
p {
  margin: 0 0 20px;
}


input {
  outline: none;
}
input[type=search] {
  -webkit-appearance: textfield;
  -webkit-box-sizing: content-box;
  font-family: inherit;
  font-size: 100%;
}
input::-webkit-search-decoration,
input::-webkit-search-cancel-button {
  display: none; 
}


input[type=search] {
  background: #ededed url(https://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat 9px center;
  border: solid 1px #ccc;
  padding: 9px 10px 9px 32px;
  width: 55px;
  
  -webkit-border-radius: 10em;
  -moz-border-radius: 10em;
  border-radius: 10em;
  
  -webkit-transition: all .5s;
  -moz-transition: all .5s;
  transition: all .5s;
}
input[type=search]:focus {
  width: 130px;
  background-color: #fff;
  border-color: #66CC75;
  
  -webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
  -moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
  box-shadow: 0 0 5px rgba(109,207,246,.5);
}


input:-moz-placeholder {
  color: #999;
}
input::-webkit-input-placeholder {
  color: #999;
}

/*search_button_custom */
#search_button_custom input[type=search] {
  width: 15px;
  padding-left: 10px;
  color: transparent;
  cursor: pointer;
}
#search_button_custom input[type=search]:hover {
  background-color: #fff;
}
#search_button_custom input[type=search]:focus {
  width: 400px;
  padding-left: 32px;
  color: #000;
  background-color: rgb(255, 255, 255);
  cursor: auto;
}
#search_button_custom input:-moz-placeholder {
  color: transparent;
}
#search_button_custom input::-webkit-input-placeholder {
  color: transparent;
}
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
  </style>
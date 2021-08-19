<style>
  body {
    font-size: large;
  }
  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
  }
  /* Safari */
  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  .contenedor {
    display: flex;
    justify-content: center;
    padding: 20px;
  }
  .disabled {
    display: none;
  }

  #wrapper {
    font-family: "Arial";
    font-size: 1.5rem;
    text-align: center;
    box-sizing: border-box;
    color: #333;
  }
  #wrapper #dialog {
    border: solid 1px #ccc;
    margin: 10px auto;
    padding: 20px 30px;
    display: inline-block;
    box-shadow: 0 0 4px #ccc;
    background-color: #faf8f8;
    overflow: hidden;
    position: relative;
    max-width: 450px;
  }
  #wrapper #dialog h3 {
    margin: 0 0 10px;
    padding: 0;
    line-height: 1.25;
  }
  #wrapper #dialog span {
    font-size: 90%;
  }
  #wrapper #dialog #form {
    max-width: 240px;
    margin: 25px auto 0;
  }
  #wrapper #dialog #form input {
    margin: 0 5px;
    text-align: center;
    line-height: 80px;
    font-size: 50px;
    border: solid 1px #ccc;
    box-shadow: 0 0 5px #ccc inset;
    outline: none;
    width: 20%;
    transition: all 0.2s ease-in-out;
    border-radius: 3px;
  }
  #wrapper #dialog #form input:focus {
    border-color: purple;
    box-shadow: 0 0 5px purple inset;
  }
  #wrapper #dialog #form input::selection {
    background: transparent;
  }
  #wrapper #dialog #form button {
    margin: 30px 0 50px;
    width: 100%;
    padding: 6px;
    background-color: #b85fc6;
    border: none;
    text-transform: uppercase;
  }
  #wrapper #dialog button.close {
    border: solid 2px;
    border-radius: 30px;
    line-height: 19px;
    font-size: 120%;
    width: 22px;
    position: absolute;
    right: 5px;
    top: 5px;
  }
  #wrapper #dialog div {
    position: relative;
    z-index: 1;
  }
  #wrapper #dialog img {
    position: absolute;
    bottom: -70px;
    right: -63px;
  }
</style>
<body>
  <form id="formCode">
    <div id="wrapper">
      <div id="dialog">
        <h3>
          Por favor introduzca el código de 4 dígitos que le llego a su correo:
        </h3>
        <div id="form">
          <input
            id="p"
            type="text"
            maxLength="1"
            size="1"
            min="0"
            max="9"
            pattern="[0-9]{1}"
            required
          />
          <input
            id="num2"
            type="text"
            maxLength="1"
            size="1"
            min="0"
            max="9"
            pattern="[0-9]{1}"
            required
          /><input
            id="num3"
            type="text"
            maxLength="1"
            size="1"
            min="0"
            max="9"
            pattern="[0-9]{1}"
            required
          /><input
            id="num4"
            type="text"
            maxLength="1"
            size="1"
            min="0"
            max="9"
            pattern="[0-9]{1}"
            required
          />
          <button type="submit" id="" class="btn btn-primary btn-embossed">
            Verificar
          </button>
        </div>
      </div>
    </div>
  </form>
  <div id="loader" class="contenedor disabled">
    <div class="loader"></div>
  </div>
</div>
</body>
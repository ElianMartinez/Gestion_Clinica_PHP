<div class="col-xs-12">
  <div class="center-block">
    <p>Hola como estas</p>
  </div>
</div>

<script>
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const id = urlParams.get("id");
  console.log(id);
</script>

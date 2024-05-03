<!--Sweetalert -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script><!-- script do sweetalert -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet"><!-- folha de estilo do sweetalert -->
<script>
  function SwalSuccess($msg){
    Swal.fire({
      backdrop: false,
      icon: "success",
      title: $msg,
      showConfirmButton: false,
      timer: 1500
    });
  }
</script>
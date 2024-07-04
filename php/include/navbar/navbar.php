<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>
  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Pesquisar..." aria-label="Pesquisar..."/>
      </div>
    </div>
    <!-- /Search -->
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <li class="nav-item lh-1 me-3"></li>
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <?php include "navbar-dropdown.php"; ?>
      </li>
      <!--/ User -->
    </ul> 
  </div>
</nav>

<style>
.drawer {
  position: absolute;
  top: 70px; /* Ajuste baseado na altura da navbar */
  left: 0;
  width: 600px;
  max-height: calc(100vh - 70px); /* Ajuste baseado na altura da navbar */
  background: #fff;
  box-shadow: 2px 0 5px rgba(0,0,0,0.3);
  transform: translateX(100%);
  transition: transform 0.3s ease;
  overflow-y: auto;
  border-radius:10px;
  padding: 10px;
}
.drawer.open {
  transform: translateX(0);
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  function createDrawer() {
    var drawer = $('<div>', { id: 'resultDrawer', class: 'drawer' })
      .append($('<div>', { class: 'drawer-content' })
        .append($('<div>', { id: 'results' })));
    $('#layout-navbar').append(drawer);
  }

  function removeDrawer() {
    $('#resultDrawer').remove();
  }

  $("#searchInput").on("input", function() {
    var query = $(this).val();
    console.log(query);
    if (query.length > 2) { // Iniciar a pesquisa após 3 caracteres
      if ($('#resultDrawer').length === 0) {
        createDrawer();
      }
      $.ajax({
        url: "php/include/navbar/search.php",
        method: "POST",
        data: { query: query },
        success: function(data) {
          $("#results").html(data);
          $("#resultDrawer").addClass("open");
        }
      });
    } else {
      removeDrawer();
    }
  });

  $(document).click(function(event) {
    if (!$(event.target).closest("#resultDrawer, #searchInput").length) {
      removeDrawer();
    }
  });
});
</script>

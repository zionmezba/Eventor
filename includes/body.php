<head>
<title>Eventor</title>
<link rel="shortcut icon" type="image/x-icon" href="images/logo_v2.png" />
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap');

  .app-content {
    padding: 16px;
    background-color: #000000;
    height: 100%;
    flex: 1;
    max-height: 100%;
    display: flex;
    flex-direction: column;
  }

  .app-content-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 4px;
  }

  .app-content-actions-wrapper {
    display: flex;
    align-items: center;
    margin-left: auto;
  }

  @media screen and (max-width: 520px) {
    .app-content-actions {
      flex-direction: column;
    }

    .app-content-actions .search-bar {
      max-width: 100%;
      order: 2;
    }

    .app-content-actions .app-content-actions-wrapper {
      padding-bottom: 16px;
      order: 1;
    }
  }

  .action-button {
    border-radius: 8px;
    width: 100px;
    height: 32px;
    background-color: #000000;
    border: 1px solid;
    display: flex;
    align-items: center;
    color: #ddd;
    font-size: 12px;
    margin-left: 8px;
    cursor: pointer;
    padding-left: 25px;
  }

  .action-button span {
    margin-right: 4px;
  }

  .action-button:hover {
    border-color: blue;
  }

  .action-button:focus,
  .action-button.active {
    outline: none;
    color: #ddd;
    border-color: #ddd;
  }

  .filter-button-wrapper {
    position: relative;
  }

  .filter-menu {
    background-color: black;
    position: absolute;
    top: calc(100% + 36px);
    right: 1px;
    border-radius: 4px;
    padding: 8px;
    width: 220px;
    z-index: 200;
    box-shadow: gray;
    visibility: hidden;
    opacity: 0;
    transition: 0.2s;
  }

  .filter-menu:before {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid;
    bottom: 100%;
    left: 90%;
    transform: translatex(-50%);
  }

  .filter-menu.active {
    visibility: visible;
    opacity: 1;
    top: calc(100% + 8px);
  }

  .filter-menu label {
    display: block;
    font-size: 12px;
    color: #ddd;
    margin-bottom: 8px;
  }

  .filter-menu select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23fff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-down'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    padding: 8px 24px 8px 8px;
    background-position: right 4px center;
    border: 1px solid;
    border-radius: 4px;
    color: #ddd;
    font-size: 12px;
    background-color: transparent;
    margin-bottom: 16px;
    width: 100%;
  }

  .filter-menu select option {
    font-size: 14px;
  }

  .light .filter-menu select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%231f1c2e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-down'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  }

  .filter-menu select:hover {
    border-color: #ddd;
  }

  .filter-menu select:focus,
  .filter-menu select.active {
    outline: none;
    color: var(--action-color);
    border-color: var(--action-color);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%232869ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-down'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  }

  .filter-menu-buttons {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .filter-button {
    border-radius: 2px;
    font-size: 12px;
    padding: 4px 8px;
    cursor: pointer;
    border: none;
    color: #fff;
  }

  .filter-button.apply {
    background-color: #00bb11;
  }

  .filter-button.reset {
    background-color: #00aa11;
  }
</style>


<body>

  <div class="" style="background-color: black;">
    <section class="ftco-destination">
      <div class="container">
        <div class="row justify-content-start pb-3">
          <div class="col-md-7 heading-section ftco-animate">
            <br style="margin-top:20px">
            <h2 class="mb-4"><strong>Explore</strong></h2>
            <h2 class="">Events</h2>
          </div>
        </div>
        <?php
        include("filter.php");
        ?>
        <div class="event-cards" id="data-container">
          <?php
          include("backend/filter.php");
          ?>
        </div>
      </div>
    </section>
  </div>
<!-- Filter Menu -->
<style>
    .filter-button-wrapper {
        background-color: gray;
        align-items: right;
    }
</style>
<input type="text" name="user_id_s" id="user_id_s" value="<?php echo $_SESSION['user_id'] ?>" hidden>
<div class="app-content-actions">
    <div class="app-content-actions-wrapper">
        <div class="filter-button-wrapper">
            <input type="checkbox" id="personal" class="filter-button filter jsFilter"><span>Filter My
                Sessions</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-filter">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
            </svg>
        </div>
    </div>
</div>

<script>
    function filterData() {
        var checkbox = document.getElementById('personal');
        var category = document.getElementById('user_id_s').value;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "backend/filter-timeline.php?category=" + category, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("event-container").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
<!-- Filter Menu -->

<div class="app-content-actions">
    <div class="app-content-actions-wrapper">
        <div class="filter-button-wrapper">
            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg"
                    width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                </svg></button>
            <div class="filter-menu">
                <label>Paper Indexing</label>
                <select id="indexing">
                    <option value="all" selected>All</option>
                    <option value="IEEE Xplore">IEEE Xplore</option>
                    <option value="Scopus">Scopus</option>
                    <option value="SpringerLink">SpringerLink</option>
                    <option value="Web of Science">Web of Science</option>
                    <option value="ScienceDirect">ScienceDirect</option>
                    <option value="Directory of Open Access Journals (DOAJ)">Directory of Open Access Journals (DOAJ)
                    </option>
                    <option value="JSTOR">JSTOR</option>
                    <option value="ERIC">ERIC</option>
                    <option value="PubMed">PubMed</option>
                </select>
                <label>Status</label>
                <select id="status">
                    <option selected value="all">All</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Upcoming">Upcoming</option>
                </select>
                <div class="filter-menu-buttons">
                    <button class="filter-button apply" onclick="filterData()">
                        Apply
                    </button>
                    <button class="filter-button reset">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector(".jsFilter").addEventListener("click", function () {
        document.querySelector(".filter-menu").classList.toggle("active");
    });
    function filterData(category) {
        var category1 = document.getElementById('indexing').value;
        var category2 = document.getElementById('status').value;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "backend/filter.php?category1=" + category1 + "&category2=" + category2, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("data-container").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
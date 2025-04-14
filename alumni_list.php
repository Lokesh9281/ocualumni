<?php /* Connect to the database by including the connection script */
include 'admin/db_connect.php'; 
?>
<style> /* Styling for image inside portfolio */
#portfolio .img-fluid{
    width: 100%;
    height: 50vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.alumni-list {        /* Card styling for each alumni entry */
    cursor: pointer;
    border: unset;
    flex-direction: inherit;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    max-width: 350px;
    height: 450px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.alumni-img {          /* Container for alumni image */
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.alumni-img img {      /* Makes sure alumni image is round and fits nicely */
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.card-body {        /* Styling for the text section of the card */
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

.card-body p {
    font-size: 14px;
    margin-bottom: 5px;
}

.row-items {
    position: relative;
}
</style>

<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Alumnus/Alumnae List</h3>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">  <!-- Text input to type search terms -->
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="filter-field"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="filter" placeholder="Filter name, course, etc." aria-label="Filter" aria-describedby="filter-field">
                    </div>
                </div>    <!-- Button to trigger the search -->
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block btn-sm" id="search">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>  

<div class="container-fluid mt-3 pt-2">
    <div class="row-items">
        <div class="col-lg-12">
            <div class="row">
                <?php
                $fpath = 'admin/assets/uploads';
                $alumni = $conn->query("SELECT a.*, c.course, Concat(a.lastname, ', ', a.firstname, ' ', a.middlename) as name FROM alumnus_bio a INNER JOIN courses c ON c.id = a.course_id ORDER BY Concat(a.lastname, ', ', a.firstname, ' ', a.middlename) ASC");
                while($row = $alumni->fetch_assoc()):
                ?>
                <div class="col-md-4 item">
                    <div class="card alumni-list" data-id="<?php echo $row['id'] ?>">
                        <div class="alumni-img">
                            <img src="<?php echo $fpath.'/'.$row['avatar'] ?>" alt="">
                        </div>
                        <div class="card-body">
                            <p class="filter-txt"><b><?php echo $row['name'] ?></b></p>
                            <hr class="divider w-100">
                            <p class="filter-txt">Email: <b><?php echo $row['email'] ?></b></p>
                            <p class="filter-txt">Course: <b><?php echo $row['course'] ?></b></p>
                            <p class="filter-txt">Batch: <b><?php echo $row['batch'] ?></b></p>
                            <p class="filter-txt">Currently working in/as <b><?php echo $row['connected_to'] ?></b></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>   // When alumni image is clicked, open viewer modal
    $('.alumni-img img').click(function(){
        viewer_modal($(this).attr('src'))
    });
            // When Enter key is pressed in the search box, trigger the search
    $('#filter').keypress(function(e){
        if(e.which == 13)
            $('#search').trigger('click')
    });
            // Filter items based on the entered search keyword
    $('#search').click(function(){
        var txt = $('#filter').val().toLowerCase();
        if(txt === ''){
            $('.item').show();
            return false;
        }
        $('.item').each(function(){
            var content = "";
            $(this).find(".filter-txt").each(function(){
                content += ' ' + $(this).text();
            });           // Show or hide card based on if search text is found
            $(this).toggle(content.toLowerCase().includes(txt));
        });
    });
</script>